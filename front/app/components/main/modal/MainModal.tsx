import { useRef, type JSX, type ReactNode } from "react";
import Container from "../container/Container";
import { motion } from "framer-motion";

const MainModal = ({
  children,
  close,
}: {
  children: JSX.Element;
  close: () => void;
}) => {
  const modalRef = useRef<HTMLDivElement>(null);
  return (
    <Container>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        transition={{ duration: 0.5, ease: "easeInOut" }}
        className="modal"
        onClick={close}
      >
        <div
          ref={modalRef}
          className="modal__content"
          onClick={(e) => e.stopPropagation()}
        >{children}</div>
      </motion.div>
    </Container>
  );
};

export default MainModal;