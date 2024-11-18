<?php
// Database configuration
$host = 'localhost';
$dbname = 'rixrodco_rsvpDb';
$username = 'rixrodco_rsvpUsr';
$password = 'u7OEs_)9GxXv';

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $attendance = $_POST['attendance'];
    $message = trim($_POST['message']);

    // Check if the name exists in the database
    $stmt = $pdo->prepare("SELECT * FROM guests WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $guest = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($guest) {
        // If name exists, send an email
        $to = 'michaelattoh@rixrod.com';
        $subject = 'RSVP Submission';
        $emailMessage = "RSVP Details:\n\n";
        $emailMessage .= "Name: $name\n";
        $emailMessage .= "Email: $email\n";
        $emailMessage .= "Attendance: $attendance\n";
        $emailMessage .= "Message: $message\n";

        $headers = "From: no-reply@yourdomain.com\r\n";

        if (mail($to, $subject, $emailMessage, $headers)) {
            echo "Thank you for your RSVP, $name. We have received your response.";
        } else {
            echo "Failed to send RSVP email. Please try again later.";
        }
    } else {
        // If name does not exist
        echo "Sorry, your name is not on the guest list.";
    }
}
?>
