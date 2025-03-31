import Container from "~/components/main/container/Container";
import ChatItemContent from "~/components/chat/ChatItemContent/ChatItemContent";
import ChatConversationWindow from "~/components/chat/ChatConversationWindow/ChatConversationWindow";
import classNames from "~/utils/classNames";
import { useEffect, useState } from "react";

type ConversationContent = {
  header: string;
  messages: { sender: string; text: string; self: boolean }[];
};

const Chat = () => {
  const [selectedConversationId, setSelectedConversationId] = useState<number | null>(null);
  const [conversationContent, setConversationContent] = useState<ConversationContent | null>(null);
  const [newMessage, setNewMessage] = useState("");
  useEffect(() => {
    // Ajoute ou enlève la classe no-scroll sur le body quand la fenêtre de conversation est ouverte
    if (selectedConversationId) {
      document.body.classList.add('noscroll');
    } else {
      document.body.classList.remove('noscroll');
    }

    // Nettoyage de l'effet
    return () => {
      document.body.classList.remove('no-scroll');
    };
  }, [selectedConversationId]);
  useEffect(() => {
    if (selectedConversationId) {
      loadConversation(selectedConversationId);
    }
  }, [selectedConversationId]);
  useEffect(() => {
    // Écoute de l'événement de la touche "Échap"
    const handleEscapeKey = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        setSelectedConversationId(null); // Ferme la fenêtre en réinitialisant l'ID de la conversation
      }
    };

    window.addEventListener("keydown", handleEscapeKey);

    // Nettoyage de l'écouteur d'événements
    return () => {
      window.removeEventListener("keydown", handleEscapeKey);
    };
  }, []);


  const loadConversation = (conversationId: number) => {
    console.log(`Loading conversation with ID: ${conversationId}`);
    setConversationContent({
      header: "John Doe",
      messages: [
        { sender: "John Doe", text: "Hello, how are you?", self: false },
        { sender: "You", text: "I'm good, thanks! How about you?", self: true },
        { sender: "John Doe", text: "I'm doing well, thank you.", self: false },
      ],
    });
  };

  return (
    <>
      <div className="chat__content">
        {[1, 2, 3, 4, 5].map((id) => (
          <ChatItemContent
            key={id}
            id={id.toString()}
            selectedConversationId={selectedConversationId?.toString() || ""}
            setSelectedConversationId={(id: string) => setSelectedConversationId(Number(id))}
          />
        ))}
      </div>

      <div
        className={classNames("conversation-tab", {
          "conversation-tab--visible": !!selectedConversationId,
        })}
      >
        <Container>
          {conversationContent && (
            <ChatConversationWindow
              conversationContent={conversationContent}
              setSelectedConversationId={(id: string | null) => setSelectedConversationId(id ? Number(id) : null)}
              newMessage={newMessage}
              setNewMessage={setNewMessage}
            />
          )}
        </Container>
      </div>
    </>
  );
};

export default Chat;
