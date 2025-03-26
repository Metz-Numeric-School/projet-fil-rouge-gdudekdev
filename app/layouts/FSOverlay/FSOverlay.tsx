import { motion } from "framer-motion";
import Nav from "../../components/main/nav/Nav";
import Container from "~/components/main/container/Container";

interface FSOverlayProps{
  children : React.ReactNode;
  onClose : () => void
}
const FSOverlay = ({children,onClose} : FSOverlayProps) => {
  return (
    <div className="profil__fullscreen-overlay">
      <Nav onClose={onClose} />
      <motion.div
        initial={{ opacity: 0, x: 100 }}
        animate={{ opacity: 1, x: 0 }}
        exit={{ opacity: 0, x: -100 }}
        transition={{ duration: 0.5 }}
      >
        <div className="profil__fullscreen-content">
          <Container>
            {children}
          </Container>
        </div>
      </motion.div>
    </div>
  );
};
export default FSOverlay;
