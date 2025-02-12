document
  .getElementById('login-form')
  .addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    console.log(formData);

    fetch('validate.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then(function (response) {
        console.log(response);
        if (response.status === 'error') {
          alert(response.message);
        } else {
          alert('Login efetuado com sucesso!');
        }

      })
      .catch((error) => console.error(error));
  });
