import { useNavigate } from "react-router";
import type { RideDataSet } from "../Trajet";
import properDate from "~/utils/properDate";
import { arrayPlan } from "../Trajet";
import { mapDaysOfWeek } from "./TrajetAdd";
import { useApi } from "~/hooks/useApi";
import { useEffect, useState } from "react";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";

const TrajetOverview = ({ rideId }: { rideId: number }) => {
  const navigate = useNavigate();
  const ride: RideDataSet[] = JSON.parse(
    localStorage.getItem("rides") ?? "[]"
  ).filter((ride: RideDataSet) => ride.rides_id == rideId);
  console.log(ride);
  if (ride.length === 0) {
    navigate("/profil/trajet");
  }
  const currentRide = ride[0];
  return (
    <div className="flex flex-col gap-4 mb-[var(--navbar-height)]">
      <div className="flex w-full justify-between items-center">
        <h2 className="text-[var(--maincolor-dark)] mb-4">
          Votre trajet {currentRide.routes_departure}-
          {currentRide.routes_destination}
        </h2>
        <p className="text-[var(--maincolor-original)] mb-4 text-sm border py-1 px-1.5 rounded-sm border-[var(--maincolor-original)]">
          {currentRide.rides_position.toUpperCase()}
        </p>
      </div>
      <div className="">
        <h3 className="text-[var(--maincolor-original)] mb-4 text-sm underline">
          Informations relatives au trajet
        </h3>

        <div className="flex flex-col gap-2">
          <div className="border border-[var(--maincolor-light)] rounded-sm p-5 relative">
            <h4 className="text-sm text-[var(--maincolor-original)] absolute top-0 left-2">
              Itinéraire
            </h4>
            <div className="flex gap-4 items-center">
              <p className="text-gray-500 text-sm">Adresse de départ : </p>
              <p className="text-[var(--maincolor-light)]">
                {currentRide.routes_departure}
              </p>
            </div>
            <div className="flex gap-4 items-center">
              <p className="text-gray-500 text-sm">Adresse d'arrivée :</p>
              <p className="text-[var(--maincolor-light)]">
                {currentRide.routes_destination}
              </p>
            </div>
          </div>
          <div className="border border-[var(--maincolor-light)] rounded-sm p-5 relative">
            <h4 className="text-sm text-[var(--maincolor-original)] absolute top-0 left-2">
              Planification
            </h4>
            <div className="">
              <div className="flex gap-4 items-center">
                <p className="text-gray-500 text-sm">Début : </p>
                <p className="text-[var(--maincolor-light)]">
                  {currentRide.planifications_start}
                </p>
              </div>
              <div className="flex gap-4 items-center">
                <p className="text-gray-500 text-sm">Fin : </p>
                <p className="text-[var(--maincolor-light)]">
                  {currentRide.planifications_end}
                </p>
              </div>
            </div>
            <div className="flex gap-4 items-center">
              <p className="text-gray-500 text-sm">Heure de départ : </p>
              <p className="text-[var(--maincolor-light)]">
                {properDate(currentRide.rides_departure_time).timeOnly}
              </p>
            </div>
            <div className="flex gap-4 items-center">
              <p className="text-gray-500 text-sm">Type : </p>
              <p className="text-[var(--maincolor-light)]">
                {arrayPlan[currentRide.planifications_pattern_type]}
              </p>
            </div>
            {currentRide.planifications_pattern_type === "days" && (
              <div className="flex gap-4 items-center">
                <p className="text-gray-500 text-sm">Jours séléctionnés </p>
                <p className="text-[var(--maincolor-light)]">
                  {mapDaysOfWeek
                    .filter((day) =>
                      currentRide.planifications_days_of_week.includes(day[0])
                    )
                    .map((day) => day[1])
                    .join(" - ")}
                </p>
              </div>
            )}
          </div>
          {currentRide.rides_position === "driver" && (
            <div className="border border-[var(--maincolor-light)] rounded-sm p-5 relative">
              <h4 className="text-sm text-[var(--maincolor-original)] absolute top-0 left-2">
                Options du conducteur
              </h4>
              <div className="flex gap-4 items-center">
                <p className="text-gray-500 text-sm">
                  Nombre de places proposées :{" "}
                </p>
                <p className="text-[var(--maincolor-light)]">
                  {currentRide.rides_seats}
                </p>
              </div>
            </div>
          )}
        </div>
      </div>
      <div className="">
        <h3 className="text-[var(--maincolor-original)] mb-4 text-sm underline">
          Trajets à venir
        </h3>
        {currentRide.rides_position === "driver" ? (
          <RideOverviewDriver rides_id={currentRide.rides_id} />
        ) : (
          <RideOverviewPassenger rides_id={currentRide.rides_id} />
        )}
      </div>
    </div>
  );
};
type InstanceData = {
  instances_id: number;
  instances_status: "active" | "disabled";
  instances_departure_time: string;
  rides_id : number;
};
const RideOverviewPassenger = ({ rides_id }: { rides_id: number }) => {
  const { apiQuery } = useApi();
  const [instances, setInstances] = useState<InstanceData[]>([]);
  useEffect(() => {
    const fetchInstances = async () => {
      const res = await apiQuery("ride/instances", { rides_id });
      if (res.response === undefined) {
        return;
      }
      setInstances(res.response);
    };
    fetchInstances();
  }, []);
  console.log("instances", instances);
  return (
    <div className="">
      <h4>Voyages correspondant à ce trajet</h4>
      {instances.length > 0 &&
        instances.map((instance) => (
          <div className="">
            <p>{properDate(instance.instances_departure_time).formattedDate}</p>
          </div>
        ))}
    </div>
  );
};

const RideOverviewDriver = ({ rides_id }: { rides_id: number }) => {
  const { apiQuery } = useApi();
  const [instances, setInstances] = useState<InstanceData[]>([]);
  const [openInstanceId, setOpenInstanceId] = useState<number | null>(null);

  useEffect(() => {
    const fetchInstances = async () => {
      const res = await apiQuery("ride/instances", { rides_id });
      if (res === null || res.response === undefined) return;
      setInstances(res.response);
    };
    fetchInstances();
  }, [rides_id]);
  console.log(instances);
  const toggleInstance = (id: number) => {
    setOpenInstanceId((prev) => (prev === id ? null : id));
  };

  return (
    <div className="flex flex-col gap-2">
      {instances.length > 0 &&
        instances.map((instance) => {
          const isOpen = openInstanceId === instance.instances_id;

          return (
            <div
              key={instance.instances_id}
              className="border border-[var(--maincolor-original)] rounded-sm transition-all"
            >
              <div
                className="flex justify-between items-center p-3 relative hover:scale-[102%] transition-all hover:cursor-pointer"
                onClick={() => toggleInstance(instance.instances_id)}
              >
                <h4 className="text-md text-[var(--maincolor-original)]">
                  {properDate(instance.instances_departure_time).formattedDate}
                </h4>
                <div
                  className={`transition-transform duration-300 absolute right-4 [&>svg]:w-3 [&>svg]:h-auto [&>svg]:fill-[var(--maincolor-original)] ${
                    isOpen ? "rotate-90" : ""
                  }`}
                >
                  <CtaRightArrow />
                </div>
              </div>

              <div
                className={`transition-[max-height] duration-300 overflow-hidden ${
                  isOpen ? "max-h-96" : "max-h-0"
                }`}
              >
                <div className="text-sm text-gray-700 p-3">
                  <p><strong>Heure exacte :</strong> {properDate(instance.instances_departure_time).timeOnly}</p>
                  <p><strong>ID instance :</strong> {instance.instances_id}</p>
                </div>
              </div>
            </div>
          );
        })}
    </div>
  );
};

// TODO finir la gestion des réservations sur la page à partir des données fetch 



export default TrajetOverview;
