<?php

function sendMail($template = "templates/email/email-template", $data = [], $fromEmail = 'teste@teste.com', $fromName = 'Teste', $toEmail = 'casjunior93@gmail.com', $toSubject = 'Test')
{
  $email = \Config\Services::email();

  $config['SMTPHost'] = $_ENV['SMTP_HOST'];
  $config['SMTPUser'] = $_ENV['SMTP_USER'];
  $config['SMTPPass']  = $_ENV['SMTP_PASSWORD'];
  $config['SMTPPort'] = $_ENV['SMTP_PORT'];
  $config['fromEmail'] = $fromEmail;
  $config['fromName'] = $fromName;

  $email->initialize($config);

  $email->setTo($toEmail);

  $email->setSubject($toSubject);

  // Using a custom template
  $template = view($template, $data);

  $email->setMessage($template);

  // Send email
  if ($email->send()) {
    return true;
  } else {
    $data = $email->printDebugger(['headers']);
    print_r($data);
    exit();
  }
}
