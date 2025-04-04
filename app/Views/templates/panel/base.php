<?php
$user = getLoggedInUser();
?>
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
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logo.png') ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>


  <div class="penel-body">

    <div id="loader" class="loader" style="display: none;">
      <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="spinner">
    </div>

    <div id="web-loader" class="loader">
      <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="spinner">
    </div>

    <div class="sidebar" id="sidebar">
      <div class="logo-sidBar mb-2">
        <a href="#">
          <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
        </a>
      </div>
      <!-- <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button> -->
      <nav class="nav flex-column">
        <?php
        $uri = service('uri'); // Get current URI
        ?>

        <a href="<?= base_url('joinpunjabpolice/admin/dashboard') ?>"
          class="nav-link <?= ($uri->getSegment(1) == 'dashboard') ? 'active' : '' ?>">
          <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>

        <a href="<?= base_url('joinpunjabpolice/admin/candidates-list') ?>"
          class="nav-link <?= ($uri->getSegment(3) == 'candidates-list') ? 'active' : '' ?>">
          <i class="fa-solid fa-list-ol"></i> <span>Candiates List</span>
        </a>

        <a href="<?= base_url('joinpunjabpolice/admin/create-user') ?>"
          class="nav-link <?= ($uri->getSegment(3) == 'create-user') ? 'active' : '' ?>">
          <i class="fa-solid fa-user-plus"></i> <span>Create New User</span>
        </a>

        <a href="<?= base_url('joinpunjabpolice/admin/users-list') ?>"
          class="nav-link <?= ($uri->getSegment(3) == 'users-list') ? 'active' : '' ?>">
          <i class="fas fa-user-tie"></i> <span>User List</span>
        </a>


        <a href="<?= base_url('joinpunjabpolice/admin/create-job') ?>"
          class="nav-link <?= ($uri->getSegment(3) == 'create-job') ? 'active' : '' ?>">
          <i class="fas fa-user-tie"></i> <span>Create New Job</span>
        </a>
        <a href="<?= base_url('joinpunjabpolice/admin/job-list') ?>"
          class="nav-link <?= ($uri->getSegment(3) == 'job-list') ? 'active' : '' ?>">
          <i class="fas fa-user-tie"></i> <span>Vacancies</span>
        </a>

      </nav>
    </div>


    <div class="content" id="content">

      <!-- Top Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light navBAR shadow-sm px-3">
        <!-- Left: Sidebar Toggle Button -->
        <button class="btn btn-outline-secondary me-2" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Center: Search Bar -->
        <div class="me-auto">

          <form class="d-flex frm_search" action="<?= base_url('search') ?>" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search..." aria-label="Search">
            
          </form>
        </div>


        <!-- Right: User Info -->
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- <img src="<?= base_url('assets/images/user.png') ?>" alt="User Avatar" class="rounded-circle" width="30" height="30"> -->
            <span class="ms-2"><?= $user['user_name'] ?></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="fas fa-user"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?= base_url('settings') ?>"><i class="fas fa-cog"></i> Settings</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="<?= base_url('joinpunjabpolice/admin/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </div>
      </nav>
      <?= $this->renderSection('content'); ?>
    </div>
  </div>
  <script>
    function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("collapsed");
      document.getElementById("content").classList.toggle("collapsed");
    }


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

    document.addEventListener("DOMContentLoaded", function() {
      const links = document.querySelectorAll(".nav-link");

      links.forEach(link => {
        link.addEventListener("click", function() {
          // Remove 'active' class from all links
          links.forEach(l => l.classList.remove("active"));
          // Add 'active' class to the clicked link
          this.classList.add("active");
        });
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>

</html>