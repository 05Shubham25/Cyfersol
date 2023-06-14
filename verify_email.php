<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $enteredCode = $_POST['verificationCode'];
  $storedCode = $_SESSION['user_data']['verificationCode'];

  if ($enteredCode && $enteredCode === $storedCode) {
    // Email is verified
    // Retrieve user data from session
    $userData = $_SESSION['user_data'];

    // Perform further actions (e.g., store the user in the database)

    // Clear the stored user data from session
    unset($_SESSION['user_data']);

    echo 'Email is verified. Perform further actions here.';
  } else {
    // Verification code is invalid
    echo 'Invalid verification code. Please try again.';
  }
} else {
  // Redirect to the verification page if accessed directly
  header('Location: verify_email.html');
  exit;
}
?>
