import { Link, useLocation } from "react-router-dom";
import Container from "../container/Container";
import { motion } from "framer-motion";
import * as IconFooter from "./svgImportFooter";

const Footer = () => {
  const location = useLocation();

  return (
    <footer>
      <nav className="footer__nav">
        <Container>
          <ul className="footer__nav-list">
            <motion.li
              className={`footer__nav-list-link ${
                location.pathname === "/chat" ? "footer__active" : ""
              }`}
              animate={{ opacity: 1, y: 0 }}
              initial={{ opacity: 0, y: 10 }}
              transition={{ duration: 0.3 }}
              layout
            >
              <Link to="/chat">
                <IconFooter.IconFooterChat />
              </Link>
            </motion.li>
            <motion.li
              className={`footer__nav-list-link ${
                location.pathname === "/home" ? "footer__active" : ""
              }`}
              animate={{ opacity: 1, y: 0 }}
              initial={{ opacity: 0, y: 10 }}
              transition={{ duration: 0.3 }}
              layout
            >
              <Link to="/home">
                <IconFooter.IconFooterHome />
              </Link>
            </motion.li>
            <motion.li
              className={`footer__nav-list-link ${
                location.pathname === "/profil" ? "footer__active" : ""
              }`}
              animate={{ opacity: 1, y: 0 }}
              initial={{ opacity: 0, y: 10 }}
              transition={{ duration: 0.3 }}
              layout
            >
              <Link to="/profil">
                <IconFooter.IconFooterProfil />
              </Link>
            </motion.li>
          </ul>
        </Container>
      </nav>
    </footer>
  );
};

export default Footer;
