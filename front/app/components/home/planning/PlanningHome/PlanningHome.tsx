import CtaCalendar from "~/src/assets/icon/home/CtaCalendar";
import PlanningItem from "../PlanningItemHome/PlanningItemHome";
import { getTimeFromRide } from "~/utils/datetime";
interface PlanningHomeProps {
  onClicks: {
    trajet: () => void;
    modal: () => void;
    choice: () => void;
  };
  planning: any;
}

const PlanningHome = ({ onClicks, planning }: PlanningHomeProps) => {

  return (
    <div className="home__planning">
      <div className="home__planning-header">
        <h2>Je recherche un covoitureur</h2>
        <div className="home__planning-header-cta" onClick={onClicks.trajet}>
          <CtaCalendar />
        </div>
      </div>

      <div className="home__planning-item">
        {planning.map((ride: Rides) => {
          const rideEnabled = ride.instances_status == "active"; // TODO gérer l'affichage si un trajet est désactivé mais permettre de le réactiver au besoin

          const { dateLabel, timeOnly } = getTimeFromRide(ride);

          return (
            <div key={ride.instances_id}>
              <div className="home__planning-item-day">
                <h4>{dateLabel}</h4>
                <PlanningItem
                  time={timeOnly}
                  ride={ride}
                  onClickModal={onClicks.modal}
                  onClickChoice={onClicks.choice}
                />
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default PlanningHome;
