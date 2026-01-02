<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize event title
    $event_title = $conn->real_escape_string(trim($_POST['event_title'] ?? ''));

    if (empty($event_title)) {
        echo "Event Title is required!";
    } else {
        // Insert event and get its ID
        $conn->query("INSERT INTO events (title) VALUES ('$event_title')");
        $event_id = $conn->insert_id;

        // Save form fields linked to this event
        if (!empty($_POST['fields'])) {
            foreach ($_POST['fields'] as $order => $field) {
                $label = $conn->real_escape_string($field['label']);
                $type = $conn->real_escape_string($field['type']);
                $required = isset($field['required']) ? 1 : 0;
                $order = intval($order);

                $conn->query("INSERT INTO event_form_fields (event_id, field_label, field_type, is_required, field_order) 
                              VALUES ($event_id, '$label', '$type', $required, $order)");
            }
        }

        echo "Event and form fields saved successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Event Form Builder</title>
    <style>
        .field-row { margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Build Event Registration Form</h2>

<form method="POST" id="formBuilder">
    <label for="event_title">Event Title:</label><br>
    <input type="text" id="event_title" name="event_title" required placeholder="Enter Event Title" style="width: 300px; margin-bottom: 20px;"><br>

    <div id="fieldsContainer"></div>

    <button type="button" onclick="addField()">Add Field</button>
    <br><br>
    <button type="submit">Save Form</button>
</form>

<script>
    function addField(label = '', type = 'text', required = true) {
        const container = document.getElementById('fieldsContainer');
        const index = container.children.length;

        const fieldRow = document.createElement('div');
        fieldRow.className = 'field-row';
        fieldRow.innerHTML = `
            <input type="text" name="fields[${index}][label]" placeholder="Field Label" required value="${label}"/>
            <select name="fields[${index}][type]">
                <option value="text" ${type === 'text' ? 'selected' : ''}>Text</option>
                <option value="email" ${type === 'email' ? 'selected' : ''}>Email</option>
                <option value="number" ${type === 'number' ? 'selected' : ''}>Number</option>
                <option value="textarea" ${type === 'textarea' ? 'selected' : ''}>Textarea</option>
            </select>
            <label>
                Required
                <input type="checkbox" name="fields[${index}][required]" ${required ? 'checked' : ''} />
            </label>
            <button type="button" onclick="this.parentElement.remove()">Remove</button>
        `;
        container.appendChild(fieldRow);
    }

    // Load default one field on page load
    addField();
</script>

</body>
</html>
