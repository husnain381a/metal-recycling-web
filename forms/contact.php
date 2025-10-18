<?php
// Replace with your real receiving email address
$receiving_email_address = 'info@metalconsultandrecycling.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags(trim($_POST['subject'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address!');
    }

    // Email content
    $email_content = "From: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email using PHP mail function
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Error sending email!";
    }
} else {
    die('Invalid request method!');
}
?>
