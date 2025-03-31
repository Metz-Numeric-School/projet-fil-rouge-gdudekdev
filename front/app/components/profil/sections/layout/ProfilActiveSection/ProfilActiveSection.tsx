import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import { motion } from "framer-motion";
import Container from "~/components/main/container/Container";
import profilSections from "./profilSections";
import Nav from "~/components/main/nav/Nav";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";

const ProfilActiveSection: React.FC<{
  activeComponent: string | null;
  onClose: () => void;
}> = ({ activeComponent, onClose }) => {
  if (!activeComponent) return null;

  const Component = profilSections[activeComponent];

  return (
   <FSOverlay onClose={onClose} children={<Component />}/>
  );
};
export default ProfilActiveSection;
