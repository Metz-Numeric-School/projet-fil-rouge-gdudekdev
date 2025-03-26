import { useEffect } from "react";
import { IconProfilBlock } from "~/components/profil/import/profilSvgImport";

const Block = () => {
  useEffect(() => {
    const unblockButtons = document.getElementsByClassName("block__unblock-button");
    const handleUnblockClick = (event: Event) => {
      const memberItem = (event.target as Element).closest(".block__main-item");
      if (memberItem) {
        (memberItem as HTMLElement).style.display = "none";
      }
      // Add AJAX request here to update the server about the unblock action
    };

    for (let i = 0; i < unblockButtons.length; i++) {
      unblockButtons[i].addEventListener("click", handleUnblockClick);
    }

    return () => {
      for (let i = 0; i < unblockButtons.length; i++) {
        unblockButtons[i].removeEventListener("click", handleUnblockClick);
      }
    };
  }, []);

  return (
    <div>
      <div className="block">
        <h2>Liste des membres bloqués</h2>
        <div className="block__content">
          <p>Vous pouvez gérer les membres que vous avez bloqués ici.</p>
          <div className="block__main">
            <div className="block__main-item">
              <div className="block__item-icon">
                <IconProfilBlock />
              </div>
              <div className="block__item-content">
                <h5>Nom du membre</h5>
                <p>Date de blocage: 01/01/2023</p>
              </div>
              <div className="block__item-cta">
                <button className="block__unblock-button">Débloquer</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Block;
