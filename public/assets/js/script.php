<script>

  const buttonsFrG = document.querySelectorAll('.btn-ldr');

// Function to handle the button click event
buttonsFrG.forEach(button => {
  // Create an image element
  const img = document.createElement('img');
  img.src = '<?= base_url('assets/images/logo.png') ?>';  // Replace with the path to your logo image
  img.alt = 'Logo';
  img.classList.add('unique-spinner');  // Add the class for spinning animation

  // Add click event listener to each button/link
  button.addEventListener('click', function(event) {
    // Prevent the default behavior if it's an <a> tag (i.e., page navigation)
    if (button.tagName === 'A') {
      event.preventDefault();
    }

    // Replace the text with 'Adding...'
    button.textContent = 'Adding...';
    
    // Append the image inside the button/link (before the text)
    button.prepend(img);  // Use prepend to add the image before the text
    
    // Add the 'loading' class to start the spinning animation
    button.classList.add('loading');
    
    // Optionally, remove the loading state and reset after a few seconds (e.g., 3 seconds)
    setTimeout(() => {
      button.classList.remove('loading');  // Stop the spinning animation
      button.textContent = 'Click me';     // Reset button text to original
      // Keep the image (optional, you can remove it if you want)
    }, 3000);  // Adjust the duration as needed
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
    }, 3000);  // Change 3000 (3 seconds) to however long you need
  });
});


</script>