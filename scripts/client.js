document.getElementById('addToCartBtn').addEventListener('click', function() {
    var popup = document.getElementById('popup');
    popup.classList.add('show'); // Show the popup

    // Remove 'hide' class if it exists
    popup.classList.remove('hide');

    // Hide the popup after 4 seconds
    setTimeout(function() {
        popup.classList.remove('show'); // Remove the show class
        popup.classList.add('hide'); // Add the hide class
    }, 1500); // Adjusted time to 4 seconds (4000 milliseconds)

    // Ensure 'hide' class is removed after transition ends
    popup.addEventListener('transitionend', function() {
        if (!popup.classList.contains('show')) {
            popup.classList.remove('hide');
        }
    }, { once: true });
});
