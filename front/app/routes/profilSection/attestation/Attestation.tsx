import { useState } from "react";
import Notif from "./notif/Notif";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import ToggleBtn from "~/components/main/button/ToggleBtn/ToggleBtn";
import IconAttestationMail from "~/src/assets/icon/profil/attestation/IconAttestationMail";
import IconAttestationCalendar from "~/src/assets/icon/profil/attestation/IconAttestationCalendar";

const Attestation = () => {
  const [showNotif, setShowNotif] = useState(false);
  const [isRotated, setIsRotated] = useState(false);

  const handleNotifClick = () => {
    setShowNotif(!showNotif);
    setIsRotated(!isRotated);
  };

  return (
    <div>
      <div className="attestation">
        <h2>Recevez votre attestation de covoiturage par email</h2>
        <div className="attestation__content"></div>
        <p>
          Cette attestation justifie vos trajets dans le cadre du Forfait
          Mobilités Durables. Elle vous sera transmise à monadresse@email.com
        </p>
        <div className="attestation__main">
          <div className="attestation__main-item">
            <div className="attestation__item-icon">
              <IconAttestationMail />
            </div>
            <div className="attestation__item-content">
              <h5>Recevez votre attestation automatiquement chaque mois</h5>
              <p>Envoyée le 6 du mois</p>
            </div>
            <div className="attestation__item-cta">
              <ToggleBtn />
            </div>
          </div>
          <div className="attestation__main-item" onClick={handleNotifClick}>
            <div className="attestation__item-icon">
              <IconAttestationCalendar />
            </div>
            <div className="attestation__item-content">
              <h5>Recevez votre attestation pour une période précise</h5>
            </div>
            <div className="attestation__item-cta">
              <CtaRightArrow className={`transform transition-transform duration-300 ${isRotated ? 'rotate-90' : ''}`} />
            </div>
          </div>
          {showNotif && <Notif />}
        </div>
      </div>
    </div>
  );
};

export default Attestation;
