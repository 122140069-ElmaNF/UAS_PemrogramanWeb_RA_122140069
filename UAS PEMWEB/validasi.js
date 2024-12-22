document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const loginBtn = document.getElementById('loginBtn');

    form.addEventListener('submit', function(event) {
        let valid = true;

        // Validasi username tidak boleh kosong
        if (username.value.trim() === '') {
            valid = false;
            alert('Username tidak boleh kosong');
        }

        // Validasi password tidak boleh kosong
        if (password.value.trim() === '') {
            valid = false;
            alert('Password tidak boleh kosong');
        }

        // Jika tidak valid, hentikan pengiriman form
        if (!valid) {
            event.preventDefault();
        }
    });
});