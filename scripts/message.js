const messages = document.querySelectorAll('.message__item');
const conversationTab = document.querySelector('.conversation-tab');

const closeBtn = document.createElement('button');
closeBtn.classList.add('close-btn');
closeBtn.innerHTML = '&times;';
closeBtn.addEventListener('click', () => {
  conversationTab.classList.remove('conversation-tab--visible');
});

messages.forEach((message) => {
  message.addEventListener('click', () => {
    // Toggle the selected class on the message
    message.classList.toggle('message__item--selected');
    
    // Display the conversation tab
    conversationTab.classList.add('conversation-tab--visible');
    
    // Load the conversation content (you can customize this part)
    const conversationId = message.dataset.conversationId;
    loadConversation(conversationId);
  });
});

function loadConversation(conversationId) {
  // Logic to load the conversation content based on the conversationId
  // This can be an AJAX request or any other method to fetch the conversation data
  console.log(`Loading conversation with ID: ${conversationId}`);
  // Example content loading
  conversationTab.innerHTML = `
    <div class="conversation-header">
      <h3>John Doe</h3>
    </div>
    <div class="conversation-messages">
      <div class="conversation-message conversation-message--other">
        <div class="conversation-message-content">
          <p><strong>John Doe:</strong> Hello, how are you?</p>
        </div>
      </div>
      <div class="conversation-message conversation-message--self">
        <div class="conversation-message-content">
          <p><strong>You:</strong> I'm good, thanks! How about you?</p>
        </div>
      </div>
      <div class="conversation-message conversation-message--other">
        <div class="conversation-message-content">
          <p><strong>John Doe:</strong> I'm doing well, thank you.</p>
        </div>
      </div>
    </div>
    <div class="conversation-input">
      <input type="text" placeholder="Type a message...">
      <button>Send</button>
    </div>
  `;
  conversationTab.querySelector('.conversation-header').appendChild(closeBtn);
}