<?php
include 'connection.php';

// Handle delete request
if (isset($_GET['delete_event_id'])) {
    $delete_id = intval($_GET['delete_event_id']);
    // Delete event and cascade delete fields and registrations
    $conn->query("DELETE FROM registration_events WHERE id = $delete_id");
    
    // Redirect to avoid resubmission
    header("Location: event_registration.php");
    exit();
}

// Fetch all registration events
$events = [];
$result = $conn->query("SELECT * FROM registration_events ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Selected event
$selected_event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : ($events[0]['id'] ?? 0);

// Fetch fields for selected event
$fields = [];
if ($selected_event_id) {
    $stmt = $conn->prepare("SELECT * FROM event_form_fields WHERE registration_event_id = ? ORDER BY field_order ASC");
    $stmt->bind_param("i", $selected_event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $fields[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>
</head>
<body>

<h2>Event Registration Form</h2>

<form method="GET">
    <label for="event_id">Select Event:</label>
    <select name="event_id" id="event_id" onchange="this.form.submit()">
        <?php foreach ($events as $event): ?>
            <option value="<?php echo $event['id']; ?>" <?php if ($event['id'] == $selected_event_id) echo 'selected'; ?>>
                <?php echo htmlspecialchars($event['title']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    &nbsp;&nbsp;
    <?php if ($selected_event_id): ?>
        <a href="event_registration.php?delete_event_id=<?php echo $selected_event_id; ?>" 
           onclick="return confirm('Are you sure you want to delete this event and all its registrations?');"
           style="color:red;">Delete This Event</a>
    <?php endif; ?>
</form>

<?php if ($selected_event_id && count($fields) > 0): ?>
    <form method="POST" action="submit_registration.php?event_id=<?php echo $selected_event_id; ?>">
        <?php foreach ($fields as $field): ?>
            <label>
                <?php echo htmlspecialchars($field['field_label']); ?><?php if ($field['is_required']) echo '*'; ?>
            </label><br>

            <?php if ($field['field_type'] === 'textarea'): ?>
                <textarea name="field_<?php echo $field['id']; ?>" <?php if ($field['is_required']) echo 'required'; ?>></textarea>
            <?php else: ?>
                <input
                    type="<?php echo htmlspecialchars($field['field_type']); ?>"
                    name="field_<?php echo $field['id']; ?>"
                    <?php if ($field['is_required']) echo 'required'; ?>
                >
            <?php endif; ?>

            <br><br>
        <?php endforeach; ?>

        <button type="submit">Submit Registration</button>
    </form>
<?php elseif ($selected_event_id): ?>
    <p>No fields defined for this event yet.</p>
<?php endif; ?>

</body>
</html>
