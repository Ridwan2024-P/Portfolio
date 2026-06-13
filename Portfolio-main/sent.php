<?php
// PHPMailer import
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = "mail.voiceofbangladesh.online"; // Your domain mail server
        $mail->SMTPAuth = true;

        // ⚠ CHANGE THESE (your actual email + password)
        $mail->Username = "contact@voiceofbangladesh.online";
        $mail->Password = "YOUR_EMAIL_PASSWORD";

        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        // Sender
        $mail->setFrom("contact@voiceofbangladesh.online", "Portfolio Contact");

        // Receiver (Your email where messages will arrive)
        $mail->addAddress("contact@voiceofbangladesh.online");

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message: $subject";

        $mail->Body = "
            <h2>New Message from Portfolio Contact Form</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br> $message</p>
            <br>
            <small>Sent from Portfolio Website</small>
        ";

        // Send email
        $mail->send();

        // Redirect with success message
        echo "<script>
                alert('Your message has been sent successfully!');
                window.location.href='index.html';
              </script>";

    } catch (Exception $e) {
        echo "<script>
                alert('Error sending message. Please try again.');
                window.location.href='index.html';
              </script>";
    }

} else {
    echo "Invalid Request!";
}
?>
