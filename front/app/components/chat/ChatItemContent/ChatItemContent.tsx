interface ChatItemContentProps {
  id: string;
  selectedConversationId: string;
  setSelectedConversationId: (id: string) => void;
}

const ChatItemContent: React.FC<ChatItemContentProps> = ({ id, selectedConversationId, setSelectedConversationId }) => (
  <div
    key={id}
    className={`chat__item ${selectedConversationId === id ? "chat__item--selected" : ""}`}
    data-conversation-id={id}
    onClick={() => setSelectedConversationId(id)}
  >
    <div className="chat__item-content">
      <div className="chat__item-content-container">
        <div className="chat__item-sender-img">
          <img src="app/src/assets/img/chat/dummyChatProfil.png" alt="sender-img" />
        </div>
        <div className="chat__item-maincontent">
          <h3 className="chat__item-sender-name">John Doe</h3>
          <p className="chat__item-preview">Dernier message reçu...</p>
        </div>
      </div>
      <p className="chat__item-date">12/12/2020</p>
    </div>
  </div>
);

export default ChatItemContent;
