<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get event_id from GET param
    $event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

    if (!$event_id) {
        die("Invalid event.");
    }

    // Insert new registration with event_id
    $stmt = $conn->prepare("INSERT INTO event_registrations (event_id) VALUES (?)");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $registration_id = $stmt->insert_id;
    $stmt->close();

    // Loop through POST fields and save values
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'field_') === 0) {
            $field_id = intval(str_replace('field_', '', $key));
            $field_value = $conn->real_escape_string(trim($value));

            $conn->query("INSERT INTO event_registration_values (registration_id, field_id, field_value) VALUES ($registration_id, $field_id, '$field_value')");
        }
    }

    echo "Registration submitted successfully!";
} else {
    echo "Invalid request.";
}
