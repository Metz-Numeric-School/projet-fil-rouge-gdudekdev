
import SendArrow from "~/src/assets/icon/chat/SendArrow";

interface ChatConversationInputProps {
  newMessage: string;
  setNewMessage: (message: string) => void;
}

const ChatConversationInput = ({ newMessage, setNewMessage }: ChatConversationInputProps) => {
  const sendMessage = () => {
    if (newMessage.trim() !== "") {
      console.log("Message envoyé:", newMessage);
      setNewMessage("");
    }
  };

  const handleKeyPress = (e: { key: string; }) => {
    if (e.key === "Enter") {
      sendMessage();
    }
  };

  return (
    <div className="conversation-input">
      <input
        type="text"
        placeholder="Envoyez un message..."
        value={newMessage}
        onChange={(e) => setNewMessage(e.target.value)}
        onKeyPress={handleKeyPress}
      />
      <button onClick={sendMessage}><SendArrow /></button>
    </div>
  );
};

export default ChatConversationInput;
