<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - Support</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/css/cyborg-gaming.css">
    <link rel="stylesheet" href="/assets/css/owl.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <style>
      .success-message {
          display: none;
          padding: 0;
          color: green;
      }

      .loading {
          animation: spin 1s infinite linear;
          -webkit-animation: spin 1s infinite linear;
          -moz-animation: spin 1s infinite linear;
          -o-animation: spin 1s infinite linear;
      }

      @keyframes spin {
          100% {
              transform: rotate(360deg);
          }
      }
      /* header{
          width: 80%;
          margin-left: 100px;
      } */
      #contactForm{
        width: 50rem;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 1rem;
        padding: 1.5rem;
      }
      input.loading{
        width: 50rem;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 1rem;
        padding: 1.5rem;
      }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="browse.html">Browse</a></li>
                        <li><a href="details.html">Details</a></li>
                        <li><a href="streams.html">Streams</a></li>
                        <li><a href="#" class="active">Support</a></li>
                        <li><a href="profile.html">Profile <img src="assets/images/profile-header.jpg" alt=""></a></li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Banner Start ***** -->
          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Contact Cyborg Teams</h6>
                  <h4><em>Leave</em> To Us What do you want!</h4>
                  <div class="main-button">
                    <a href="#">Contact Now!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

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

        // Display a success message
        echo "<div class='container mt-4'>
                  <div id='successMessage' class='alert alert-success'>Thank you for your message! We will get back to you soon.</div>
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
<div class="container mx-auto my-8">
    <form id="contactForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <!-- <label for="name">First Name:</label> --></br>
            <input type="text" name="name" id="name" class="form-control" placeholder="First name.." required>
            <span class="text-red-500"><?php echo $nameErr; ?></span>
        </div>

        <div class="form-group">
            <!-- <label for="last_name">Last Name:</label> --></br>
            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name.." required>
        </div>

        <div class="form-group">
            <!-- <label for="email">Email:</label> --></br>
            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email.." required>
            <span class="text-red-500"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <!-- <label for="phone">Phone Number:</label> --></br>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number..">
            <span class="text-red-500"><?php echo $phoneErr; ?></span>
        </div>

        <div class="form-group">
            <!-- <label for="subject">Subject:</label> --></br>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject.." required>
        </div>

        <div class="form-group">
            <!-- <label for="message">Message:</label> --></br>
            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Your Message.." required ></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-outline-warning">Submit</button>
    </form>
</div>


        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2023 <a href="#">Cyborg Gaming</a> Company. All rights reserved. 
          </p>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>


  </body>

</html>
