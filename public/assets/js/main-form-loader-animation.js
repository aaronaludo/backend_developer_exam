document.getElementById('main-form').addEventListener('submit', function(e) {
    const submitButton = document.getElementById('submitButton');
    const loader = document.getElementById('loader');

    submitButton.disabled = true;
    loader.classList.remove('d-none');
});
