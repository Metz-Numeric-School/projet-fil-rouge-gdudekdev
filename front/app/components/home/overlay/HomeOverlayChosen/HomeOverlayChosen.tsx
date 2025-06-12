import { useEffect } from "react";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";

interface HomeOverlayTrajetProps {
  isVisibleChosen: boolean;
  onCloseChosen: () => void;
}

const HomeOverlayChosen = ({ isVisibleChosen, onCloseChosen }: HomeOverlayTrajetProps) => {
  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        onCloseChosen();
      }
    };

    if (isVisibleChosen) {
      document.body.style.overflow = "hidden";
      document.addEventListener("keydown", handleKeyDown);
    } else {
      document.body.style.overflow = "auto";
      document.removeEventListener("keydown", handleKeyDown);
    }

    return () => {
      document.body.style.overflow = "auto";
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [isVisibleChosen, onCloseChosen]);

  return (
    // <FSOverlay onClose={onCloseChosen} children={<TrajetOverview />} />
    <></>
  );
};

export default HomeOverlayChosen;
