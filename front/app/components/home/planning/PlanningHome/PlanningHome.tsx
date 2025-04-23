import CtaCalendar from "~/src/assets/icon/home/CtaCalendar";
import PlanningItem from "../PlanningItemHome/PlanningItemHome";


interface PlanningHomeProps {
  onClickTrajet: () => void;
  onClickModal: () => void;
  onClickChoice: () => void;
  userPlanning: any;
}

const PlanningHome = ({
  onClickTrajet,
  onClickModal,
  onClickChoice,
  userPlanning,
}: PlanningHomeProps) => {
  const week = [
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
    "Dimanche",
  ];
  console.log(userPlanning);
  // Vérifie si userPlanning et userPlanning.planning existent
  if (!userPlanning) {
    return <div>Chargement...</div>; // Affiche un message de chargement si les données sont absentes
  }

  const { departure_time, ride_enabled } = userPlanning.planning;
 
  return (
    <div className="home__planning">
      <div className="home__planning-header">
        <h2>Je recherche un covoitureur</h2>
        <div className="home__planning-header-cta" onClick={onClickTrajet}>
          <CtaCalendar />
        </div>
      </div>

      <div className="home__planning-item">
        {departure_time.map((day, index) => {
          const rideEnabled = ride_enabled[index]; // Récupère le ride_enabled correspondant au même index
          const showHome = day.home && rideEnabled.home; // Vérifie si le trajet "home" est disponible et activé
          const showWork = day.work && rideEnabled.work; // Vérifie si le trajet "work" est disponible et activé

          return (
            <div key={index}>
              <div className="home__planning-item-day">
                <h3>{week[index]}</h3>
              </div>

              {/* Si le trajet "domicile → travail" est disponible, on l'affiche */}
              {showHome && (
                <PlanningItem
                  time={day.home}
                  direction="Domicile → Travail"
                  onClickModal={onClickModal}
                  onClickChoice={onClickChoice}
                />
              )}

              {/* Si le trajet "travail → domicile" est disponible, on l'affiche */}
              {showWork && (
                <PlanningItem
                  time={day.work}
                  direction="Travail → Domicile"
                  onClickModal={onClickModal}
                  onClickChoice={onClickChoice}
                />
              )}

              {/* Si ni l'un ni l'autre n'est activé, afficher un message */}
              {!showHome && !showWork && (
                <p className="home__planning-item-empty">Aucun trajet prévu</p>
              )}
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default PlanningHome;
