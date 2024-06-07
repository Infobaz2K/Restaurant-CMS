document.getElementById('addToCartBtn').addEventListener('click', function() {
    var popup = document.getElementById('popup');
    popup.classList.add('show');

    popup.classList.remove('hide');

    setTimeout(function() {
        popup.classList.remove('show'); 
        popup.classList.add('hide'); 
    }, 1500);

    popup.addEventListener('transitionend', function() {
        if (!popup.classList.contains('show')) {
            popup.classList.remove('hide');
        }
    }, { once: true });
});
