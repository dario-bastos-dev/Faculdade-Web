async function fetchAndDisplayUsers() {
  try {
    const response = await fetch('php/user.php', {
      method: 'GET',
    });
    const users = await response.json();

    console.log(users);

    const userList = document.getElementById('user-list');

    users.forEach((user) => {
      const userElement = document.createElement('div');
      userElement.className = 'task';
userElement.innerHTML = `
 <h2>${user.username}</h2>
 <p>Email: ${user.email}</p>
 <p>Criado: ${new Date(user.created_at).toLocaleDateString('pt-BR')}</p>
 `;
      userList.appendChild(userElement);
    });
  } catch (error) {
    console.error('Error fetching users:', error);
  }
}

document.addEventListener('DOMContentLoaded', fetchAndDisplayUsers);
