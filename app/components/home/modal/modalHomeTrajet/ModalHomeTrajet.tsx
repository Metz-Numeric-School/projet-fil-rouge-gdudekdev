import { motion } from "framer-motion";
import { useEffect, useRef } from "react";
import Container from "~/components/main/container/Container";

interface ModalHomeTrajetProps {
  isVisibleModalHomeTrajet: boolean;
  onCloseModalHomeTrajet: () => void;
}

const ModalHomeTrajet = ({
  isVisibleModalHomeTrajet,
  onCloseModalHomeTrajet,
}: ModalHomeTrajetProps) => {
  const modalRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        onCloseModalHomeTrajet();
      }
    };

    if (isVisibleModalHomeTrajet) {
      document.addEventListener("keydown", handleKeyDown);
    } else {
      document.removeEventListener("keydown", handleKeyDown);
    }

    return () => {
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [isVisibleModalHomeTrajet, onCloseModalHomeTrajet]);

  useEffect(() => {
    document.body.style.overflow = isVisibleModalHomeTrajet ? "hidden" : "auto";
    return () => {
      document.body.style.overflow = "auto";
    };
  }, [isVisibleModalHomeTrajet]);

  if (!isVisibleModalHomeTrajet) return null;

  return (
    <Container>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        transition={{ duration: 0.5, ease: "easeInOut" }}
        className="modal__home-trajet"
        onClick={onCloseModalHomeTrajet}
      >
        <div
          ref={modalRef}
          className="modal__home-trajet-content"
          onClick={(e) => e.stopPropagation()}
        >
          <div className="modal__home-trajet-action">
            <ul>
              <li className="modal__home-trajet-action-item">Je suis conducteur</li>
              <li className="modal__home-trajet-action-item">Voir mon itinéraire</li>
              <li className="modal__home-trajet-action-item">Modifier l'heure de ce trajet</li>
              <li className="modal__home-trajet-action-item">Ne pas proposer ce trajet</li>
            </ul>
          </div>
        </div>
      </motion.div>
    </Container>
  );
};

export default ModalHomeTrajet;
