import { motion } from "framer-motion";
import { useEffect, useRef } from "react";
import Container from "~/components/main/container/Container";

interface ModalHomeTrajetProps {
  close: () => void;
}

const ModalHomeTrajet = ({ close }: ModalHomeTrajetProps) => {
  const modalRef = useRef<HTMLDivElement>(null);

  return (
    <Container>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        transition={{ duration: 0.5, ease: "easeInOut" }}
        className="modal__home-trajet"
        onClick={close}
      >
        <div
          ref={modalRef}
          className="modal__home-trajet-content"
          onClick={(e) => e.stopPropagation()}
        >
          <div className="modal__home-trajet-action">
            <ul>
              <li className="modal__home-trajet-action-item">
                Voir mon itinéraire
              </li>
              <li className="modal__home-trajet-action-item">
                Modifier l'heure de ce trajet
              </li>
              <li className="modal__home-trajet-action-item">
                Ne pas proposer ce trajet
              </li>
            </ul>
          </div>
        </div>
      </motion.div>
    </Container>
  );
};

export default ModalHomeTrajet;
