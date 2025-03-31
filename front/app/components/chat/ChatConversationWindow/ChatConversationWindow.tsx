import ChatConversationInput from "../ChatConversationInput/ChatConversationInput";

interface Message {
  sender: string;
  text: string;
  self: boolean;
}

interface ConversationContent {
  header: string;
  messages: Message[];
}

interface ChatConversationWindowProps {
  conversationContent: ConversationContent;
  setSelectedConversationId: (id: string | null) => void;
  newMessage: string;
  setNewMessage: (message: string) => void;
}

const ChatConversationWindow: React.FC<ChatConversationWindowProps> = ({ conversationContent, setSelectedConversationId, newMessage, setNewMessage }) => (
  <div className="conversation-content">
    <div className="conversation-header">
      <h3>{conversationContent.header}</h3>
      <button className="close-btn" onClick={() => setSelectedConversationId(null)}>&times;</button>
    </div>
    <div className="conversation-chats">
      {conversationContent.messages.map((msg, index) => (
        <div
          key={index}
          className={`conversation-chat ${msg.self ? "conversation-chat--self" : "conversation-chat--other"}`}
        >
          <p><strong>{msg.sender}:</strong> {msg.text}</p>
        </div>
      )).reverse()}
    </div>
    <ChatConversationInput newMessage={newMessage} setNewMessage={setNewMessage} />
  </div>
);

export default ChatConversationWindow;
