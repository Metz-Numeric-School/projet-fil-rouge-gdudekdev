import React, { useEffect } from "react";

const Faq = () => {
  // JavaScript code for FAQ page functionality
  useEffect(() => {
    const acc = document.getElementsByClassName("faq__accordion");
    const toggleAccordion = function (this: HTMLElement) {
      this.classList.toggle("faq__active");
      const panel = this.nextElementSibling as HTMLElement;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = "";
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    };
    for (let i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", toggleAccordion);
    }
    return () => {
      for (let i = 0; i < acc.length; i++) {
        acc[i].removeEventListener("click", toggleAccordion);
      }
    };
  }, []);

  return (
    <div>
      <div className="faq">
        <h2>Questions Fréquentes</h2>
        <div className="faq__content">
          <p>
            Retrouvez ici les réponses aux questions les plus fréquemment
            posées.
          </p>
          <div className="faq__main">
            <div className="faq__main-item">
              <button className="faq__accordion">
                Comment fonctionne le covoiturage sur ce site ?
              </button>
              <div className="faq__panel">
                <p>
                  Ce site met en relation des conducteurs et des passagers pour
                  partager un trajet en voiture. L'inscription est gratuite et
                  chacun peut proposer ou rechercher un trajet.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Le service est-il vraiment gratuit ?
              </button>
              <div className="faq__panel">
                <p>
                  Oui, ce service est entièrement gratuit et participatif. Aucun
                  paiement n'est requis, l'idée est de partager les frais de
                  déplacement de manière conviviale.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Comment contacter un conducteur ou un passager ?
              </button>
              <div className="faq__panel">
                <p>
                  Une fois un trajet trouvé, vous pouvez contacter le conducteur
                  ou le passager via la messagerie interne du site pour convenir
                  des détails du voyage.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Comment puis-je proposer un trajet ?
              </button>
              <div className="faq__panel">
                <p>
                  Vous pouvez proposer un trajet en remplissant un formulaire
                  simple avec les informations de votre voyage : point de
                  départ, destination, date et heure.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Que faire en cas d'annulation de dernière minute ?
              </button>
              <div className="faq__panel">
                <p>
                  Si vous devez annuler un trajet, prévenez rapidement les
                  autres participants via la messagerie pour éviter tout
                  désagrément.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Le site propose-t-il une assurance pour les trajets ?
              </button>
              <div className="faq__panel">
                <p>
                  Non, les trajets sont basés sur un engagement participatif.
                  Nous conseillons aux conducteurs de vérifier que leur
                  assurance couvre le covoiturage sans échange d'argent.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">
                Puis-je emmener des animaux de compagnie ?
              </button>
              <div className="faq__panel">
                <p>
                  Cela dépend du conducteur. Avant de réserver un trajet,
                  contactez-le pour savoir s'il accepte les animaux dans son
                  véhicule.
                </p>
              </div>
            </div>
            <div className="faq__main-item">
              <button className="faq__accordion">Le site est-il sécurisé ?</button>
              <div className="faq__panel">
                <p>
                  Nous encourageons chaque utilisateur à vérifier les profils et
                  les avis avant de s'engager dans un trajet. La messagerie
                  interne permet de communiquer sans partager de données
                  personnelles.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Faq;
