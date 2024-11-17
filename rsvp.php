<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are not empty
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['guests']) && !empty($_POST['attendance']) && !empty($_POST['message'])) {

        // Collect and sanitize the form data
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

        // Email recipient
        $to = "support@rixrod.co.uk";

        // Headers for HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: $email" . "\r\n";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Your RSVP has been submitted successfully!</p>";
        } else {
            echo "<p>Sorry, there was an error submitting your RSVP. Please try again later.</p>";
        }
    } else {
        // Missing fields
        echo "<p>Error: All fields are required. Please fill in all fields.</p>";
    }
} else {
    // Not a POST request
    echo "<p>Error: Invalid request method.</p>";
}
?>
