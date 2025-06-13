import { Outlet } from "react-router-dom";
import { motion, AnimatePresence, easeInOut } from "framer-motion";
import Footer from "../components/main/footer/Footer";
import Container from "~/components/main/container/Container";
import { AuthGuard } from "~/context/AuthGuard";

const pageVariants = {
  initial: {
    opacity: 0,
  },
  enter: {
    opacity: 1,
    transition: {
      duration: 0.6,
      easeInOut,
      delay: 0.2,
    },
  },
};

const ProtectedLayout = () => {

  return (
    <AuthGuard>
      <Container>
        <AnimatePresence mode="wait">
          <motion.div
            variants={pageVariants}
            initial="initial"
            animate="enter"
            exit="exit"
          >
            <Outlet />
          </motion.div>
        </AnimatePresence>

        <Footer />
      </Container>
    </AuthGuard>
  );
};

export default ProtectedLayout;
