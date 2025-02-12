document
  .getElementById('login-form')
  .addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('php/validate.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then(function (response) {
        if (response.status === 'error') {
          alert(response.message);
        } else {
          alert('Login efetuado com sucesso!');
          setTimeout(() => {
            window.location.href = 'home.html';
          }, 1200);
        }
      })
      .catch((error) => console.error(error));
  });