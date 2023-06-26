<!DOCTYPE html>
<html>
<head>
    <title>Cyborg - Support</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php
// Define variables and set to empty values
$name = $last_name = $email = $phone = $subject = $message = "";
$nameErr = $emailErr = $phoneErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = test_input($_POST["name"]);
    $last_name = test_input($_POST["last_name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $subject = test_input($_POST["subject"]);
    $message = test_input($_POST["message"]);

    // Validate name
    if (empty($name)) {
        $nameErr = "Le nom est requis";
    }

    // Validate email
    if (empty($email)) {
        $emailErr = "L'e-mail est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format d'email invalide";
    }

    // Validate phone number (optional)
    if (!empty($phone) && !preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneErr = "Format de numéro de téléphone invalide";
    }

    // If there are no validation errors, send the email
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr)) {
        // Prepare email content
        $to = "support@cyborg.com";
        $subject = "Soumission d'un nouveau formulaire de contact";
        $message = "Nom: $name $last_name\n"
                 . "Email: $email\n"
                 . "Phone: $phone\n\n"
                 . "Subject: $subject\n"
                 . "Message: $message";

        // Send the email
        mail($to, $subject, $message);

        ////////////////SMTP
        
        // public $SMTPHost = 'smtp.googlemail.com';
        // public $SMTPUser = 'YOUR_EMAIL';
        // public $SMTPPass = 'EMAIL_ACCOUNT_PASSWORD';
        // public $SMTPPort = 465/587;
        // public $SMTPTimeout = 60;
        // public $SMTPCrypto = 'ssl/tls';
        // public $mailType = 'html';
        
        // Display a success message
        echo "<div class='container mt-4'>
                  <div class='alert alert-success'>Thank you for your message! We will get back to you soon.</div>
              </div>";
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<div class="container mt-4">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <span class="text-danger"><?php echo $nameErr; ?></span>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
            <span class="text-danger"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" class="form-control">
            <span class="text-danger"><?php echo $phoneErr; ?></span>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
