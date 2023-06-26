<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Validate form data
  if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all fields.";
    exit;
  }

  // Additional form validation and email handling logic here
  // ...

  // Simulate successful submission with a delay
  sleep(2);

  // Return a success message
  echo "success";
}
?>
