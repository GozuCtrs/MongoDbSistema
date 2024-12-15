const form = document.querySelector('#login-Form');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
        const response = await fetch('/controllers/controladorLogin.php', {
            method: 'POST',
            body: formData,
            
        });

        const result = await response.json();

        if (result.success) {
            window.location.replace("http://MongoDbSistema.test/controllers/controladorDashboard.php");
 // Redirigir al usuario
        } else {
            alert(result.message || 'Error en el login.');
        }   
    } catch (error) {
        console.error('Error en la solicitud:', error);
        alert('Ocurrió un error inesperado.');
    }
});
