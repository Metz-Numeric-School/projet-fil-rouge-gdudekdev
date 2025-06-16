import { useEffect, useState } from "react";
import PlanningHome from "~/components/home/planning/PlanningHome/PlanningHome";
import { useHome } from "~/hooks/useHome";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";
import { Link, useNavigate } from "react-router";
import { useApi } from "~/hooks/useApi";
import MainModal from "~/components/main/modal/MainModal";

const SectionHome = [
  {
    className: "home__friend",
    title: "Inviter un ami ou un collègue à covoiturer",
    description:
      "Envoyez une demande de covoiturage à vos contacts, comme vos amis ou collègues.",
    link: {
      href: "/home/relatives",
      text: "Covoiturer avec une connaissance",
    },
    icon: "fa-user-friends", // Ajouter une icône
  },
  {
    className: "home__newride",
    title: "Publier un trajet domicile-travail",
    description:
      "Partagez votre trajet pour trouver des covoitureurs sur votre route.",
    link: {
      href: "#",
      text: "Publier votre trajet",
    },
    icon: "fa-route", // Icône représentant un trajet
  },
];

const Home = () => {
  const [planning, setPlanning] = useState<string[] | null>(null);
  const {
    isPlanning,
    openPlanning,
    closePlanning,
    isRideChoice,
    openRideChoice,
    closeRideChoice,
    isRideSettings,
    openRideSettings,
    closeRideSettings,
  } = useHome();
  const { apiQuery } = useApi();
  const navigate = useNavigate();
  useEffect(() => {
    async function fetchPlanning() {
      try {
        const result = await apiQuery("instances");
        if (result?.response) {
          console.log(result.response);
          setPlanning(result.response);
        }
      } catch (error) {
        navigate("/login");
        console.error("Erreur lors du chargement du planning :", error);
      }
    }
    fetchPlanning();
  }, []);

  return (
    <div className="home">
      {SectionHome.map((section, idx) => (
        <HomeSection key={idx} section={section} />
      ))}

      {planning ? (
        <PlanningHome
          planning={planning}
          onClicks={{
            trajet: openPlanning,
            modal: openRideSettings,
          }}
        />
      ) : (
        <div className="w-full flex justify-center">
          Chargement des plannings...
        </div>
      )}

      {isPlanning && (
        <FSOverlay onClose={closePlanning} children={<Trajet />} />
      )}

      {isRideSettings && (
        <MainModal
          children={ModalHomeContent()}
          close={() => closeRideSettings()}
        />
      )}
    </div>
  );
};

const HomeSection = ({
  section,
}: {
  section: {
    className: string;
    icon?: string;
    title: string;
    description: string;
    link: {
      href: string;
      text: string;
    };
  };
}) => (
  <section className={section.className}>
    <div className={`${section.className}-content`}>
      {section.icon && <i className={`fa ${section.icon}`}></i>}
      <h2>{section.title}</h2>
      <p>{section.description}</p>
    </div>
    <Link to={section.link.href} className={`${section.className}-cta`}>
      <button>{section.link.text}</button>
    </Link>
  </section>
);

const ModalHomeContent = () => {
  return (
    <div className="modal__home-trajet-action">
      <ul>
        <li className="modal__home-trajet-action-item">Voir mon itinéraire</li>
        <li className="modal__home-trajet-action-item">
          Modifier l'heure de ce trajet
        </li>
        <li className="modal__home-trajet-action-item">
          Ne pas proposer ce trajet
        </li>
      </ul>
    </div>
  );
};

export default Home;
