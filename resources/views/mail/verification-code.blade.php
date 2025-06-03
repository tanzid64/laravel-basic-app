<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification Code</title>
</head>
<body>
  <p> Hello, </p>
  <p> Your verification code is: <strong> {{ $verificationCode }} </strong> </p>
  <p> Please enter this code to login to your account. </p>
  <p> If you did not request this code, please ignore this email. </p>
  <p> Best regards, </p>
  <p> The {{ config('app.name') }} Team </p>
</body>
</html>