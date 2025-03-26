import { useEffect } from "react";
import { motion } from "framer-motion";
import { Trajet } from "~/components/profil/import/ProfilSectionImport";
import Container from "~/components/main/container/Container";
import Nav from "~/components/main/nav/Nav";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";
import TrajetDay from "~/components/profil/sections/component/trajet/TrajetDay/TrajetDay";

interface HomeOverlayTrajetProps {
  isVisibleCalendar: boolean;
  onCloseCalendar: () => void;
}

const HomeOverlayTrajet = ({ isVisibleCalendar, onCloseCalendar }: HomeOverlayTrajetProps) => {
  // Ajoute un écouteur d'événements pour fermer l'overlay avec "Échap"
  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        onCloseCalendar();
      }
    };

    if (isVisibleCalendar) {
      // Désactive le scroll du body lorsque l'overlay est visible
      document.body.style.overflow = "hidden";
      document.addEventListener("keydown", handleKeyDown);
    } else {
      // Réactive le scroll du body lorsque l'overlay est caché
      document.body.style.overflow = "auto";
      document.removeEventListener("keydown", handleKeyDown);
    }

    return () => {
      // Nettoyage des effets pour éviter les fuites de mémoire
      document.body.style.overflow = "auto";
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [isVisibleCalendar, onCloseCalendar]);

  return (
    <FSOverlay onClose={onCloseCalendar} children={<Trajet />}/>
  );
};

export default HomeOverlayTrajet;
