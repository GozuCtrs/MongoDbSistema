const LOGIN_URL = 'http://MC_Contreras_Coronel.test/controllers/controladorLogin.php';

document.querySelector('.btn_enviar').addEventListener('click', async (e) => {
    e.preventDefault();

    const username = document.querySelector('[name="txtusername"]').value.trim();
    const password = document.querySelector('[name="txtpassword"]').value.trim();
    const output = document.querySelector('.mensaje_error');

    if (!username || !password) {
        output.textContent = 'Por favor, completa ambos campos.';
        output.style.color = 'red';
        return;
    }

    try {
        const response = await fetch(LOGIN_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: new URLSearchParams({
                txtusername: username,
                txtpassword: password,
            }),
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = result.redirect;
        } else {
            output.textContent = result.message || 'Error en las credenciales.';
            output.style.color = 'red';
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
        output.textContent = 'Ocurrió un error inesperado. Inténtalo más tarde.';
        output.style.color = 'red';
    }
});
