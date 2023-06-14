<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $mobile = $_POST["mobile"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $pincode = $_POST["pincode"];
  $source = $_POST["source"];

  // Generate verification code
  $verificationCode = generateVerificationCode();

  // Save user data and verification code in a session
  saveUserData($name, $email, $username, $password, $mobile, $address, $city, $pincode, $source, $verificationCode);

  // Send verification code via email
  sendVerificationCode($email, $verificationCode);

  // Redirect the user to the verification page
  header("Location: verify_email.php");
  exit();
}

function generateVerificationCode() {
  // Generate a random verification code
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $verificationCode = substr(str_shuffle($characters), 0, 6);
  return $verificationCode;
}

function sendVerificationCode($email, $verificationCode) {
  $subject = 'Email Verification';
  $message = 'Your verification code is: ' . $verificationCode;
  $headers = 'From: your-email@example.com' . "\r\n" .
    'Reply-To: your-email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  $success = mail($email, $subject, $message, $headers);

  if ($success) {
    echo 'Verification code has been sent to your email.';
  } else {
    echo 'Failed to send the verification code. Please try again.';
  }
}

function saveUserData($name, $email, $username, $password, $mobile, $address, $city, $pincode, $source, $verificationCode) {
  // Save the user data and verification code in a session
  $_SESSION['user_data'] = array(
    'name' => $name,
    'email' => $email,
    'username' => $username,
    'password' => $password,
    'mobile' => $mobile,
    'address' => $address,
    'city' => $city,
    'pincode' => $pincode,
    'source' => $source,
    'verificationCode' => $verificationCode
  );
}
?>
