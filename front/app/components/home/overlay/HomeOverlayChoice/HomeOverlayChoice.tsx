import { useEffect } from "react";
import TrajetChoice from "~/components/profil/sections/component/trajet/TrajetChoice/TrajetChoice";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";
interface HomeOverlayTrajetProps {
  isVisibleChoice: boolean;
  onCloseChoice: () => void;
}

const HomeOverlayChoice = ({ isVisibleChoice, onCloseChoice }: HomeOverlayTrajetProps) => {
  // Ajoute un écouteur d'événements pour fermer l'overlay avec "Échap"
  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        onCloseChoice();
      }
    };

    if (isVisibleChoice) {
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
  }, [isVisibleChoice, onCloseChoice]);

  return (
    <FSOverlay onClose={onCloseChoice} children={<TrajetChoice />} />
  );
};

export default HomeOverlayChoice;
