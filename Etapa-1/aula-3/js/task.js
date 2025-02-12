document
  .getElementById('task-form')
  .addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('php/task.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then(function (response) {
        if (response.status === 'error') {
          alert(response.message);
        } else {
          alert('Tarefa criada!');
          setTimeout(() => {
            window.location.reload();
          }, 700);
        }
      })
      .catch((error) => console.error(error));
  });

function fetchTasks() {
  fetch('php/task.php', {
    method: 'GET',
  })
    .then((response) => response.json())
    .then((tasks) => {
      const taskList = document.getElementById('task-list');
      taskList.innerHTML = tasks.data
        .map(
          (task) => `
        <div class="task">
          <h3>${task.title}</h3>
          <p>${task.description}</p>
        </div>
      `
        )
        .join('');
    })
    .catch((error) => console.error(error));
}

document.addEventListener('DOMContentLoaded', fetchTasks);
