import { Outlet, useLocation } from "react-router-dom";
import { motion, AnimatePresence, easeInOut } from "framer-motion";
import Footer from "../components/main/footer/Footer";
import Container from "~/components/main/container/Container";

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

const MainLayout = () => {
  const location = useLocation();

  return (
    <Container>
      <AnimatePresence mode="wait">
        <motion.div
          key={location.pathname}
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
  );
};

export default MainLayout;
