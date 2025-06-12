import BtnPrimary from "~/components/main/button/BtnPrimary/BtnPrimary";
import CtaVerticalDots from "~/src/assets/icon/cta/CtaVerticalDots";

interface PlanningItemProps {
  time: string | null;
  ride: Rides;
  onClickModal: () => void;
  onClickChoice: () => void;
}

const PlanningItem: React.FC<PlanningItemProps> = ({
  time,
  ride,
  onClickModal,
  onClickChoice,
}) => (
  <div className="home__item">
    <div className="home__item-main">
      <div className="home__item-departure">
        <p>{time}</p>
        <div className="text-sm">{`${ride.instances_departure} -${ride.instances_destination}`}</div>
      </div>
      <div className="home__item-content">
        <div className="home__item-cta" onClick={onClickChoice}>
          <BtnPrimary txt="Voir le conducteur disponible" path="#" />
        </div>
      </div>
      <div className="home__item-option" onClick={onClickModal}>
        <CtaVerticalDots />
      </div>
    </div>
  </div>
);

export default PlanningItem;
