document
  .getElementById('register-form')
  .addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('php/register.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then(function (response) {
        if (response.status === 'error') {
          alert('Erro ao cadastrar usuário!');
        } else {
          alert(response.message);
          setTimeout(() => {
            window.location.href = 'index.html';
          }, 1200);
        }
      })
      .catch((error) => console.error(error));
  });
