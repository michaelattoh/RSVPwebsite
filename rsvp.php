<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $guests = htmlspecialchars($_POST['guests']);
    $attendance = htmlspecialchars($_POST['attendance']);
    $message = htmlspecialchars($_POST['message']);
    
    // Prepare email content
    $subject = "RSVP Submission";
    $body = "
        <h2>RSVP Details</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Number of Guests:</strong> $guests</p>
        <p><strong>Attendance:</strong> $attendance</p>
        <p><strong>Message:</strong> $message</p>
    ";

    // Email to send to
    $to = "support@rixrod.co.uk";

    // Headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Your RSVP has been submitted successfully!</p>";
    } else {
        echo "<p>Sorry, there was an error. Please try again later.</p>";
    }
}
?>
