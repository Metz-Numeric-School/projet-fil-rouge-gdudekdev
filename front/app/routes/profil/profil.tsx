import { useNavigate } from "react-router";
import type { JSX } from "react";
import IconProfilAttestation from "~/src/assets/icon/profil/sections/IconProfilAttestation";
import IconProfilBlock from "~/src/assets/icon/profil/sections/IconProfilBlock";
import IconProfilCgu from "~/src/assets/icon/profil/sections/IconProfilCgu";
import IconProfilCookies from "~/src/assets/icon/profil/sections/IconProfilCookies";
import IconProfilFaq from "~/src/assets/icon/profil/sections/IconProfilAttestation";
import IconProfilHistorique from "~/src/assets/icon/profil/sections/IconProfilHistorique";
import IconProfilInfo from "~/src/assets/icon/profil/sections/IconProfilInfo";
import IconProfilPrivacy from "~/src/assets/icon/profil/sections/IconProfilPrivacy";
import IconProfilStats from "~/src/assets/icon/profil/sections/IconProfilStats";
import IconProfilTrajet from "~/src/assets/icon/profil/sections/IconProfilTrajet";
import IconProfilVehicule from "~/src/assets/icon/profil/sections/IconProfilVehicule";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import IconPlus from "~/src/assets/icon/general/IconPlus";

const sections = [
  {
    title: "Vos trajets",
    items: [
      {
        href: "trajet",
        icon: <IconProfilTrajet />,
        alt: "Horloge",
        title: "Trajet de covoiturage",
      },
      {
        href: "historique",
        icon: <IconProfilHistorique />,
        alt: "Horloge",
        title: "Historique de covoiturage",
      },
      {
        href: "attestation",
        icon: <IconProfilAttestation />,
        alt: "Feuille",
        title: "Attestation de covoiturage",
      },
      {
        href: "vehicule",
        icon: <IconProfilVehicule />,
        alt: "Voiture",
        title: "Véhicule",
        description:
          "Ajoutez-le pour faciliter la rencontre avec vos passagers",
        cta: "Ajouter",
      },
    ],
  },
  {
    title: "Préférences",
    items: [
      {
        href: "info",
        icon: <IconProfilInfo />,
        alt: "Personne",
        title: "Infos personnelles",
      },
      {
        href: "stats",
        icon: <IconProfilStats />,
        alt: "Statistiques",
        title: "Vos statistiques",
      },
      {
        href: "block",
        icon: <IconProfilBlock />,
        alt: "Stop",
        title: "Membres bloqués",
      },
    ],
  },
  {
    title: "Aide",
    items: [
      {
        href: "faq",
        icon: <IconProfilFaq />,
        alt: "Questions",
        title: "Questions fréquentes",
      },
      {
        href: "cgu",
        icon: <IconProfilCgu />,
        alt: "Formulaire",
        title: "Conditions Générales",
      },
      {
        href: "privacy",
        icon: <IconProfilPrivacy />,
        alt: "Cadenas",
        title: "Protection des Données",
      },
      {
        href: "cookies",
        icon: <IconProfilCookies />,
        alt: "Cookie",
        title: "Paramètre des cookies",
      },
    ],
  },
];
const Profil = () => {
  const navigate = useNavigate();
  const onSelectSection = (e: string) => {
    navigate(`/profil/${e}`);
  };
  return (
    <div className="profil">
      <UserProfil />
      <ProfilSectionList onSelect={onSelectSection} />
    </div>
  );
};
const UserProfil: React.FC = () => (
  <section className="profil__user">
    <div className="profil__user-img-container">
      <form
        action="#"
        method="post"
        encType="multipart/form-data"
        className="profil__user-img-form"
      >
        <label htmlFor="user_img-form" className="profil__user-input-img">
          <IconPlus />
        </label>
        <input
          type="file"
          name="user_img-form"
          id="user_img-form"
          className="hidden"
        />
      </form>
      <div className="profil__user-img">
        <img src="app/src/assets/img/chat/dummyChatProfil.png" alt="Profil" />
      </div>
    </div>
    <div className="profil__user-info">
      <p>Gauthier, 23 ans</p>
    </div>
  </section>
);

const ProfilSectionItem = ({
  item,
  onClick,
}: {
  item: {
    href: string;
    icon: string | JSX.Element;
    alt: string;
    title: string;
    description?: string;
    cta?: string;
  };
  onClick: (href: string) => void;
}) => (
  <div className="profil__item" onClick={() => onClick(item.href)}>
    <div className="profil__item-icon">
      {typeof item.icon === "string" ? (
        <img src={item.icon} alt={item.alt} />
      ) : (
        item.icon
      )}
    </div>
    <div className="profil__item-content">
      <h5>{item.title}</h5>
      {item.description && <p>{item.description}</p>}
    </div>
    <div className="profil__item-cta">
      {item.cta ? <span>{item.cta}</span> : <CtaRightArrow />}
    </div>
  </div>
);

const ProfilSectionList: React.FC<{ onSelect: (href: string) => void }> = ({
  onSelect,
}) => (
  <>
    {sections.map((section, index) => (
      <section key={index} className="profil__section">
        <h2 className="profil__section-title">{section.title}</h2>
        <div className="profil__section-content">
          {section.items.map((item, idx) => (
            <ProfilSectionItem key={idx} item={item} onClick={onSelect} />
          ))}
        </div>
      </section>
    ))}
  </>
);

export default Profil;
