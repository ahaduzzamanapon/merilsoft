<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    // $email = "info@merilsoft.com";
    $emailRecipients = ["shakil4014008@gmail.com", "info@merilsoft.com", "mdshakilahamed.fiu@gmail.com"];
    $emailTo = implode(",", $emailRecipients);
    
    $name = htmlspecialchars($_POST['user_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $attachment = $_FILES['cv']['tmp_name'];
    $attachment_name = $_FILES['cv']['name'];
    $contact = "<b>Name:</b> " . $name . "<br><b>Email:</b> " . $sender_email . "<br><b>Phone:</b> " . $phone . "<br><br>";
    $message = htmlspecialchars($_POST['message']);
    $fullMessage = $contact . $message; 
    // Read the file content
    $file = fopen($attachment, 'rb');
    $data = fread($file, filesize($attachment));
    fclose($file);

    // Encode & format the data for the email
    $encoded = chunk_split(base64_encode($data));

    // Prepare headers
    $boundary = md5(uniqid(time()));
    $headers = "From: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\r\n";
    
    // Prepare message
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($fullMessage)) . "\r\n";
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/octet-stream; name=\"$attachment_name\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$attachment_name\"\r\n\r\n";
    $body .= $encoded . "\r\n";
    $body .= "--$boundary--";

    // Send email
    if(mail($emailTo, 'New CV Submission', $body, $headers)) {
        // echo 'Email sent successfully.';
        header("Location: career_page.html?emailsent=true");
    } else {
        // echo 'Email sending failed.';
        header("Location: career_page.html?emailsent=false");

    }
}
?>
