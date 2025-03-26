import type { JSX } from "react";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";

interface ProfilSectionItemProps {
  item: {
    href: string;
    icon: string | JSX.Element;
    alt: string;
    title: string;
    description?: string;
    cta?: string;
  };
  onClick: (href: string) => void;
}

const ProfilSectionItem: React.FC<ProfilSectionItemProps> = ({ item, onClick }) => (
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
export default ProfilSectionItem;
