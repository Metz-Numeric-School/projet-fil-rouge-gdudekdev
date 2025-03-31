import sections from "../../../../import/ProfilSectionList";
import ProfilSectionItem from "../ProfilSectionItem/ProfilSectionItem";

const ProfilSectionList: React.FC<{ onSelect: (href: string) => void }> = ({ onSelect }) => (
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
    export default ProfilSectionList;