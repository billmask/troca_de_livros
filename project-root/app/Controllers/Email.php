<?php

namespace App\Controllers;

class Email extends BaseController
{
  public function sendMail($template = "templates/email/email-template", $data = [])
  {
    $email = \Config\Services::email();

    $email->setTo("casjunior93@gmail.com");

    $email->setSubject("Test Mail with Template");

    // Using a custom template
    $template = view($template, []);

    $email->setMessage($template);

    // Send email
    if ($email->send()) {
      echo 'Email successfully sent, please check.';
    } else {
      $data = $email->printDebugger(['headers']);
      print_r($data);
    }
  }
}
