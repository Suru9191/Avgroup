<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tax.avassociates@gmail.com'; // Replace with your email
        $mail->Password = 'fhkjuqjhoywpaxhz';           // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($_POST["email"], $_POST["first_name"] . ' ' . $_POST["last_name"]);
        $mail->addAddress('example@gmail.com'); // Replace with your recipient email
        $mail->addReplyTo($_POST["email"], $_POST["first_name"]);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><b>First Name:</b> {$_POST['first_name']}</p>
            <p><b>Last Name:</b> {$_POST['last_name']}</p>
            <p><b>Phone:</b> {$_POST['phone']}</p>
            <p><b>Email:</b> {$_POST['email']}</p>
            <p><b>Message:</b><br>{$_POST['message']}</p>
        ";

        $mail->send();
        echo "<script>
                alert('Message sent successfully!');
                document.location.href = 'index.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
              </script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get In Touch</title>
  <style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    .contact {
      width: 400px;
      margin: 50px auto;
      background: #ffffff;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .contact h2 {
      text-align: center;
      color: #a37d50;
      margin-bottom: 20px;
    }

    .contact form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .contact input, .contact textarea, .contact select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    .contact textarea {
      resize: none;
      height: 100px;
    }

    .contact button {
      padding: 10px;
      background: #a37d50;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .contact button:hover {
      background: #8c693b;
    }

    .disclaimer {
      font-size: 12px;
      color: #777;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="contact">
    <h2>GET IN TOUCH</h2>
    <form action="" method="post">
      <input type="text" name="first_name" placeholder="First name*" required>
      <input type="text" name="last_name" placeholder="Last name*" required>
      <select name="country_code" required>
        <option value="+91">India (+91)</option>
        <option value="+1">USA (+1)</option>
        <!-- Add other countries as needed -->
      </select>
      <input type="text" name="phone" placeholder="Phone*" required>
      <input type="email" name="email" placeholder="Email*" required>
      <textarea name="message" placeholder="Message*" required></textarea>
      <div class="disclaimer">
        Disclaimer: By clicking the submit button, you consent to our agents contacting you via phone, email, and WhatsApp.
      </div>
      <button type="submit" name="send">SUBMIT</button>
    </form>
  </div>
</body>

</html>
