<?php
// Replace with your real receiving email address
$receiving_email_address = 'your-email@example.com';

// Check if email is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    // Sanitize and validate email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address!');
    }

    // Load the PHP Email Form library
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }

    // Create new PHP_Email_Form instance
    $contact = new PHP_Email_Form;
    $contact->ajax = true;
    $contact->to = $receiving_email_address;
    $contact->from_name = "Subscriber";
    $contact->from_email = $email;
    $contact->subject = "New Subscription: $email";

    // Email content
    $contact->add_message($email, 'Email');

    // Send email and return response
    echo $contact->send();
} else {
    die('Invalid request!');
}
?>
