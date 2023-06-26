document.getElementById("contactForm").addEventListener("submit", function(event) {
    event.preventDefault();
  
    // Display loading animation
    document.getElementById("submitBtn").classList.add("hidden");
    document.getElementById("loader").classList.remove("hidden");
  
    // Get form data
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;
  
    // Create an AJAX request to submit the form data to the PHP file
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_form.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // On successful submission, display success message and reset form after a delay
          document.getElementById("loader").classList.add("hidden");
          document.getElementById("successMessage").classList.remove("hidden");
          setTimeout(function() {
            document.getElementById("successMessage").classList.add("hidden");
            document.getElementById("submitBtn").classList.remove("hidden");
            document.getElementById("contactForm").reset();
          }, 2000);
        } else {
          // Handle errors if any
          alert("An error occurred. Please try again later.");
          document.getElementById("submitBtn").classList.remove("hidden");
          document.getElementById("loader").classList.add("hidden");
        }
      }
    };
    xhr.send("name=" + name + "&email=" + email + "&message=" + message);
  });
  