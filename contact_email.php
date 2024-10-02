<?php

$errors = [];

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
 
  if (empty($name)) {
      $errors[] = 'Name is empty';
  }

  if (empty($email)) {
      $errors[] = 'Email is empty';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Email is invalid';
  }

  if (empty($message)) {
      $errors[] = 'Message is empty';
  }
  
   
   
     // Pear Mail Library
            require_once "Mail.php";
            
            $from = '<mdshakilahamed.fiu@gmail.com>';
            $to = '<shakil4014008@gmail.com>';
            $subject = 'Hi!';
            $body = "Hi,\n\nHow are you?";
            
            $headers = array(
                'From' => $from,
                'To' => $to,
                'Subject' => $subject
            );
            
            $smtp = Mail::factory('smtp', array(
                    'host' => 'ssl://smtp.gmail.com',
                    'port' => '465',
                    'auth' => true,
                    'username' => 'shakil4014008@gmail.com',
                    'password' => '$SJobe36'
                ));
            
            $mail = $smtp->send($to, $headers, $body);
            
  echo '<script type="text/javascript">alert("Your test was sent User!");</script>';
  
  if (isset($_POST['submit']))
    {
        // $to = "shakil4014008@gmail.com"; // Your email address
        // $name = $_POST['name'];
        // $from = $_POST['email'];
        // $message = $_POST['message'];
        // $subject = "Contact Form Submission";
        // $headers = "From:" . $from;
        // $result = mail($to, $subject, $message, $headers);
    
        // if ($result)
        // {
        //     echo '<script type="text/javascript">alert("Your message was sent!");</script>';
        //     echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
    
        // }
        // else
        // {
        //     echo '<script type="text/javascript">alert("Oops! Your message wasn’t sent. Try again later.");</script>';
        //     echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
        // }
        
        
            // Pear Mail Library
            require_once "Mail.php";
            
            $from = 'mdshakilahamed.fiu@gmail.com';
            $to = 'shakil4014008@gmail.com';
            $subject = 'Hi!';
            $body = "Hi,\n\nHow are you?";
            
            $headers = array(
                'From' => $from,
                'To' => $to,
                'Subject' => $subject
            );
            
            $smtp = Mail::factory('smtp', array(
                    'host' => 'ssl://smtp.gmail.com',
                    'port' => '465',
                    'auth' => true,
                    'username' => 'shakil4014008@gmail.com',
                    'password' => '$SJobe36'
                ));
            
            $mail = $smtp->send($to, $headers, $body);
            
             echo '<script type="text/javascript">alert("Your message was sent!");</script>';
            // if (PEAR::isError($mail)) {
            //     echo('<p>' . $mail->getMessage() . '</p>');
            // } else {
            //     echo('<p>Message successfully sent!</p>');
            // }
    }
}