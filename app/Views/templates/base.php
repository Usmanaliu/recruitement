<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Join Punjab Police</title>
  <meta name="description" content="Join Punjab Police">
  <meta name="author" content="Punjab Police">
  <meta name="generator" content="Hugo 0.88.1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#000000">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then load Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Select2 CSS (for styling) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

  
  
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logo2.png') ?>">

</head>

<body>
  <div id="loader" class="loader" style="display: none;">
    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="spinner">
  </div>

  <div id="web-loader" class="loader">
    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="spinner">
  </div>

  <div>
    <?= $this->renderSection('content');  ?>
  </div>
  <script>



    window.onload = function() {
      document.getElementById("web-loader").style.display = "none";
    };




    const buttonsFrG = document.querySelectorAll('.btn-ldr');

    // Function to handle the button click event
    buttonsFrG.forEach(button => {
      // Create an image element
      const img = document.createElement('img');
      img.src = '<?= base_url('assets/images/logo.png') ?>'; // Replace with the path to your logo image
      img.alt = 'Logo';
      img.classList.add('unique-spinner'); // Add the class for spinning animation

      // Add click event listener to each button/link
      button.addEventListener('click', function(event) {
        // Prevent the default behavior if it's an <a> tag (i.e., page navigation)
        if (button.tagName === 'A') {
          event.preventDefault();
        }

        // Replace the text with 'Adding...'
        button.textContent = 'Adding...';

        // Append the image inside the button/link (before the text)
        button.prepend(img); // Use prepend to add the image before the text

        // Add the 'loading' class to start the spinning animation
        button.classList.add('loading');

        // Optionally, remove the loading state and reset after a few seconds (e.g., 3 seconds)
        setTimeout(() => {
          button.classList.remove('loading'); // Stop the spinning animation
          button.textContent = 'Click me'; // Reset button text to original
          // Keep the image (optional, you can remove it if you want)
        }, 3000); // Adjust the duration as needed
      });
    });


    // Select all buttons with the 'show-loader' class
    const buttons = document.querySelectorAll('.show-loader');

    // Loop through all buttons and add event listeners
    buttons.forEach(button => {
      button.addEventListener('click', function() {
        // Show the loader
        document.getElementById('loader').style.display = 'flex';

        // Optionally hide the loader after a few seconds
        setTimeout(function() {
          // Hide the loader after 3 seconds
          document.getElementById('loader').style.display = 'none';
        }, 3000); // Change 3000 (3 seconds) to however long you need
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>