<?php
session_start();

// Validate the captcha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $enteredCaptcha = $_POST['captcha'];
  $storedCaptcha = $_SESSION['captcha'];

  if ($enteredCaptcha && strtolower($enteredCaptcha) === strtolower($storedCaptcha)) {
    // Captcha is valid
    // Perform further actions (e.g., authentication)

    // Clear the stored captcha from session
    unset($_SESSION['captcha']);

    echo 'Captcha is valid. Perform further actions here.';
  } else {
    // Captcha is invalid
    echo 'Invalid captcha. Please try again.';
  }
} else {
  // Redirect to the login page if accessed directly
  header('Location: index.html');
  exit;
}
?>
