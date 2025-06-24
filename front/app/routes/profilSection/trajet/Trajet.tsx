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
  days: "Personnalisé",
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
  return (
    <div
      className="flex justify-between items-center w-full border hover:cursor-pointer hover:translate-x-0.5 hover:transition-all border-gray-300 rounded-md p-3 mb-2 gap-4 relative"
      onClick={() => onClick(ride.rides_id)}
    >
      <div className="flex items-center ml-2 justify-center absolute top-0 left-0.5 text-[10px] text-[var(--maincolor-original)]  ">
        <p>{ride.rides_position == "driver" ? "Conducteur" : "Passager"}</p>
      </div>
      <div className="flex flex-col  gap-2 relative ml-5 p-4">
        <div className="flex gap-2 w-full justify-between items-center ">
          <h4>{ride.routes_departure}</h4>
          <div className=" [&>svg]:h-[12px] [&>svg]:w-auto ">
            <CtaRightArrow />
          </div>
          <h4>{ride.routes_destination}</h4>
        </div>
        <div className="flex w-full justify-between items-center">
          <p className="text-sm text-gray-400">
            {arrayPlan[ride.planifications_pattern_type]}
          </p>
        </div>
      </div>
      <div className="trajet__adress-right-cta-svg ml-4">
        <CtaRightArrow />
      </div>
    </div>
  );
};
// TODO faire le reste des routes : qu'il puisse les supprimer si nécessaire, faire de l'autocomplétion sur les adresses et les stocker à la fois en latitude longitude et en clair pour le montrer a l'utilisateur, le relier via un identifiant et créer un type correspondant à un itinéraire (départ arrivé et sens de direction, avec la longitude et latitude pour chaque données), finir la partie de présentation des trajets disponible, mettre dans le formualrie un moyen de créer des planifications mais aussi de le modifier dans les détails, le reste est facultatif, faire en sorte de pouvoir afficher la carte concernant un itinéraire et de génerer des itinéraires plus complet comprenant différents point de ralliement entre les utilsiateurs et le conducteur, permettre, au fur et  a mesure, de pouvoir voir le trajet qui se complete, previsualisation , ça fait BEAUCOUP de choses a faire pour rendre le tout vraiment pertinent mais c'est faisable
const Trajet = () => {
  const { param } = useParams();
  const { apiQuery } = useApi();
  const navigate = useNavigate();

  const onCloseRideViews = () => navigate("/profil/trajet");

  const openRideDetail = (param: number) => navigate(`/profil/trajet/${param}`);

  const [rides, setRides] = useState<RideDataSet[]>(() => {
    const storedRides = localStorage.getItem("rides");
    if (!storedRides) return [];
    try {
      return JSON.parse(storedRides);
    } catch {
      return [];
    }
  });

  useEffect(() => {
    const fetchRides = async () => {
      try {
        const res = await apiQuery("rides_all");
        const data = res.response;
        setRides(data);
        localStorage.setItem("rides", JSON.stringify(data));
      } catch (err) {
        console.error("Erreur lors de la récupération des trajets :", err);
      }
    };
    fetchRides();
  }, []);

  if (param === "add") {
    return <FSOverlay children={<TrajetAdd />} onClose={onCloseRideViews} />;
  }

  if (param) {
    const rideId = parseInt(param);
    if (!isNaN(rideId)) {
      return (
        <FSOverlay
          children={<TrajetOverview rideId={rideId} />}
          onClose={onCloseRideViews}
        />
      );
    }
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
  rides = [],
}: {
  openRideDetail: (param: number) => void;
  rides?: RideDataSet[];
}) => {
  return (
    <div className="trajet">
      <div className="flex w-full justify-between">
        <h2>Mes Trajets</h2>
        <BtnPrimary txt="Ajouter un trajet" path="/profil/trajet/add" />
      </div>
      <div className="trajet__content flex-col mt-4">
        {rides.map((ride) => (
          <TrajetItem
            key={ride.rides_id}
            ride={ride}
            onClick={openRideDetail}
          />
        ))}
      </div>
    </div>
  );
};

export default Trajet;
