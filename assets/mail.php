<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the inputs
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Email configuration
        $to = "adeseghacyril@gmail.com"; // Replace with your email address
        $email_subject = "Contact Form Submission: $subject";
        $email_body = "You have received a new message from the contact form on your website.\n\n".
                      "Here are the details:\n\n".
                      "Name: $name\n".
                      "Email: $email\n".
                      "Phone: $phone\n".
                      "Subject: $subject\n".
                      "Message:\n$message";
        $headers = "From: $email\n";
        $headers .= "Reply-To: $email";

        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "<p>Thank you for your message, $name. Your message has been sent successfully.</p>";
        } else {
            echo "<p>There was a problem sending your message. Please try again later.</p>";
        }
    }
} else {
    echo "Invalid request method.";
}
?>
