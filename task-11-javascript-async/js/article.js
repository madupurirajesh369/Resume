async function fetchUserData() {
    const response = await fetch('https://gorest.co.in/public/v2/users');
    const data = await response.json();
    return data.data;
  }
  
  async function fetchProjects(userId) {
    const response = await fetch(`https://fake-server-production.up.railway.app/users/${userId}/projects`);
    const data = await response.json();
    return data;
  }
  
  function createUserListItem(user) {
    const listItem = document.createElement('div');
    listItem.classList.add('user-item');
    listItem.innerHTML = `
      <div class="user-name">${user.name}</div>
      <button class="view-more" data-user-id="${user.id}">View More</button>
    `;
    return listItem;
  }
  
  async function displayUserDetails(userId) {
    const user = await fetchUserDataById(userId);
    const projects = await fetchProjects(userId);
  
    const userDetails = document.querySelector('.user-details');
    userDetails.innerHTML = `
      <h2>${user.name}</h2>
      <p>Email: ${user.email}</p>
      <p>Phone: ${user.phone}</p>
      <h3>Projects:</h3>
      <ul>
        ${projects.map(project => `<li>${project.name}</li>`).join('')}
      </ul>
    `;
  
    const modal = document.getElementById('userModal');
    modal.style.display = 'block';
  
    const closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  }
  
  document.addEventListener('DOMContentLoaded', async () => {
    const userList = document.querySelector('.user-list');
    const users = await fetchUserData();
  
    users.forEach(user => {
      const listItem = createUserListItem(user);
      userList.appendChild(listItem);
    });
  
    const viewMoreButtons = document.querySelectorAll('.view-more');
    viewMoreButtons.forEach(button => {
      button.addEventListener('click', () => {
        const userId = button.getAttribute('data-user-id');
        displayUserDetails(userId);
      });
    });
  });
  