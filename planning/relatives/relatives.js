document.addEventListener('DOMContentLoaded', () => {
  const contacts = [
    { name: 'John Doe', phone: '1234567890', img: '/img/contacts/john.jpg' },
    { name: 'Jane Smith', phone: '0987654321', img: '/img/contacts/jane.jpg' },
    // Add more contacts as needed
  ];

  const searchInput = document.getElementById('searchInput');
  const contactsList = document.getElementById('contactsList');

  function displayContacts(filteredContacts) {
    contactsList.innerHTML = '';
    filteredContacts.forEach(contact => {
      const contactItem = document.createElement('div');
      contactItem.classList.add('contact-item');
      contactItem.innerHTML = `
        <img src="${contact.img}" alt="${contact.name}">
        <div class="contact-info">
          <div class="contact-name">${contact.name}</div>
          <div class="contact-phone">${contact.phone}</div>
        </div>
      `;
      contactsList.appendChild(contactItem);
    });
  }

  searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredContacts = contacts.filter(contact =>
      contact.phone.includes(searchTerm)
    );
    displayContacts(filteredContacts);
  });

  // Display all contacts initially
  displayContacts(contacts);
});
