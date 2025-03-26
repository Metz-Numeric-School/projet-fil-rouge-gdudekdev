import { useEffect } from "react";
import TrajetOverview from "~/components/profil/sections/component/trajet/TrajetOverview/TrajetOverview";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";

interface HomeOverlayTrajetProps {
  isVisibleChosen: boolean;
  onCloseChosen: () => void;
}

const HomeOverlayChosen = ({ isVisibleChosen, onCloseChosen }: HomeOverlayTrajetProps) => {
  // Ajoute un écouteur d'événements pour fermer l'overlay avec "Échap"
  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        onCloseChosen();
      }
    };

    if (isVisibleChosen) {
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
  }, [isVisibleChosen, onCloseChosen]);

  return (
    <FSOverlay onClose={onCloseChosen} children={<TrajetOverview />} />
  );
};

export default HomeOverlayChosen;
