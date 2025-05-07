<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form Submission</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f7;
      margin: 0;
      padding: 0;
    }
    .email-wrapper {
      max-width: 600px;
      margin: 30px auto;
      background: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
    }
    .email-header {
      background: #0d6efd;
      color: white;
      padding: 20px 30px;
      text-align: center;
    }
    .email-header h1 {
      margin: 0;
      font-size: 24px;
    }
    .email-body {
      padding: 30px;
      color: #333;
    }
    .email-body h2 {
      font-size: 20px;
      margin-bottom: 20px;
      color: #0d6efd;
    }
    .email-body p {
      line-height: 1.6;
      margin: 10px 0;
    }
    .email-body .label {
      font-weight: bold;
    }
    .email-footer {
      background: #f1f1f1;
      text-align: center;
      padding: 15px;
      font-size: 12px;
      color: #777;
    }
    @media (max-width: 600px) {
      .email-body, .email-header, .email-footer {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="email-header">
      <h1>New Contact Message</h1>
    </div>
    <div class="email-body">
        <h2>New Message from {{ $name }}</h2>
        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Phone:</strong> {{ $phone }}</p>
        <p><strong>Company:</strong> {{ $company }}</p>
        <p><strong>Subject:</strong> {{ $subject }}</p>
        <hr>
        <p>{{ $messageBody }}</p>

    </div>
    <div class="email-footer">
      &copy; {{ date('Y') }} Ela Kali Name. All rights reserved.
    </div>
  </div>
</body>
</html>
