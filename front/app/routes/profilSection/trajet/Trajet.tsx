import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import BtnPrimary from "~/components/main/button/BtnPrimary/BtnPrimary";
import { useNavigate, useParams } from "react-router";
import { useApi } from "~/hooks/useApi";
import { useEffect, useState } from "react";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay.js";
import TrajetOverview from "./TrajetDetail/TrajetOverview.js";
import TrajetAdd from "./TrajetDetail/TrajetAdd.js";

export const arrayPlan = {
  none: "Une seule fois",
  daily: "Tous les jours",
  days: "Personnalisée",
};
export type RideDataSet = {
  planifications_days_of_week: string[];
  planifications_end: string;
  planifications_interval_weeks: number;
  planifications_pattern_type: "none" | "daily" | "days";
  planifications_start: string;
  rides_departure_time: string;
  rides_position: "passager" | "driver";
  rides_seats: number;
  rides_status: string;
  rides_id: number;
  routes_departure: string;
  routes_destination: string;
  vehicules_id: number;
};
const TrajetItem = ({
  ride,
  onClick,
}: {
  ride: RideDataSet;

  onClick: (id: number) => void;
}) => {
  console.log("ride dans TrajetItem: ", ride);
  return (
    <div
      className=" flex justify-between items-center w-full border hover:cursor-pointer hover:translate-x-0.5 hover:transition-all border-gray-300 rounded-md p-3 mb-2 gap-4"
      onClick={() => onClick(ride.rides_id)}
    >
      <div className="flex-col w-full gap-5">
        <div className="">
          <div className="flex w-full justify-between">
            <h4>
              {ride.routes_departure} - {ride.routes_destination}
            </h4>
          </div>
          <div className="flex w-full justify-between items-center">
            <p className="text-sm text-gray-400">
              {arrayPlan[ride.planifications_pattern_type]}
            </p>
          </div>
        </div>
      </div>
      <div className="trajet__adress-right-cta-svg ml-4">
        <CtaRightArrow />
      </div>
    </div>
  );
};
// TODO faire une requete directement sur tous les trajets définis par l'utilisateur, les mettre dans une variable d'état et la passer via un props dans le detail, enlever donc la route trajet/{id}, elle n'est plus pertinente ici mais plutot faire afficher le bon trajet via FSOverlay au moment ou en a besoin pour afficher le détail, passer en props a ce moment la
// TODO faire le reste des routes : les différentes réservations liées à un trajet pour les accepter et les refuser, faire le formulaire pour charger les adresses et les stocker en bdd si nécessaire, faire en sorte de stocker les adresses a un endroit pour l'utilisateur, qu'il puisse les supprimer si nécessaire, faire de l'autocomplétion sur les adresses et les stocker à la fois en latitude longitude et en clair pour le montrer a l'utilisateur, le relier via un identifiant et créer un type correspondant à un itinéraire (départ arrivé et sens de direction, avec la longitude et latitude pour chaque données), finir la partie de présentation des trajets disponible, mettre dans le formualrie un moyen de créer des planifications mais aussi de le modifier dans les détails, le reste est facultatif, faire en sorte de pouvoir afficher la carte concernant un itinéraire et de génerer des itinéraires plus complet comprenant différents point de ralliement entre les utilsiateurs et le conducteur, permettre, au fur et  a mesure, de pouvoir voir le trajet qui se complete, previsualisation , ça fait BEAUCOUP de choses a faire pour rendre le tout vraiment pertinent mais c'est faisable
const Trajet = () => {
  const { param } = useParams();
  const { apiQuery } = useApi();
  const navigate = useNavigate();
  const onCloseRideViews = () => {
    navigate("/profil/trajet");
  };
  const openRideDetail = (param: number) => {
    navigate(`/profil/trajet/${param}`);
  };
  console.log("param = ", param);
  if (param === "add") {
    return <FSOverlay children={<TrajetAdd />} onClose={onCloseRideViews} />;
  }
  const [rides, setRides] = useState(() => {
    const storedRides = localStorage.getItem("rides");
    console.log(storedRides);
    return storedRides ? JSON.parse(storedRides) : [];
  });

  useEffect(() => {
    const fetchRides = async () => {
      try {
        const res = await apiQuery("rides_all");
        const data = res.response;
        console.log("data:", data);
        setRides(data);
        localStorage.setItem("rides", JSON.stringify(data));
      } catch (err) {
        console.error("Erreur lors de la récupération des trajets :", err);
      }
    };

    fetchRides();
  }, []);
  console.log("param", typeof param);
  if (typeof param === "string") {
    return (
      <FSOverlay
        children={<TrajetOverview rideId={parseInt(param)} />}
        onClose={onCloseRideViews}
      />
    );
  }
  return (
    <FSOverlay
      children={<TrajetStd openRideDetail={openRideDetail} rides={rides} />}
      onClose={onCloseRideViews}
    />
  );
};
const TrajetStd = ({
  openRideDetail,
  rides,
}: {
  openRideDetail: (param: number) => void;
  rides: any;
}) => {
  const openOverview = (rides_id: number) => {
    openRideDetail(rides_id);
  };

  console.log("rides :", rides);
  return (
    <div className="trajet">
      <div className="flex w-full justify-between">
        <h2>Mes Trajets</h2>
        <BtnPrimary txt="Ajouter un trajet" path="/profil/trajet/add" />
      </div>
      <div className="trajet__content flex-col mt-4">
        {rides.map((ride: any) => (
          <TrajetItem key={ride.rides_id} ride={ride} onClick={openOverview} />
        ))}
      </div>
    </div>
  );
};
export default Trajet;
