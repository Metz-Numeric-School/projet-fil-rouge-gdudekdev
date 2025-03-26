import CtaCalendar from "~/src/assets/icon/home/CtaCalendar";
import PlanningItem from "../PlanningItemHome/PlanningItemHome";

interface PlanningHomeProps {
  onClickTrajet: () => void;
  onClickModal: () => void;
  onClickChoice: () => void;
}

const PlanningHome = ({
  onClickTrajet,
  onClickModal,
  onClickChoice,
}: PlanningHomeProps) => (
  <div className="home__planning">
    <div className="home__planning-header">
      <h2>Je recherche un covoitureur</h2>
      <div className="home__planning-header-cta" onClick={onClickTrajet}>
        <CtaCalendar />
      </div>
    </div>
    {/* REFACTO faire un composant home planning list item */}
    <div className="home__planning-item">
      <div className="home__planning-item-day">
        <h3>Aujourd'hui</h3>
      </div>
      <PlanningItem
        time="09:00"
        direction="Travail -> Domicile"
        onClickModal={onClickModal}
        onClickChoice={onClickChoice}
      />
      <PlanningItem
        time="17:00"
        direction="Domicile -> Travail"
        onClickModal={onClickModal}
        onClickChoice={onClickChoice}
      />
    </div>
    <div className="home__planning-item">
      <div className="home__planning-item-day">
        <h3>Demain</h3>
      </div>
      <PlanningItem
        time="10:00"
        direction="Travail -> Domicile"
        onClickModal={onClickModal}
        onClickChoice={onClickChoice}
      />
      <PlanningItem
        time="17:00"
        direction="Domicile -> Travail"
        onClickModal={onClickModal}
        onClickChoice={onClickChoice}
      />
    </div>
  </div>
);
export default PlanningHome;
