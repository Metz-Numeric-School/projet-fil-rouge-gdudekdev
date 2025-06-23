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
            {currentRide.planifications_pattern_type !== "none" && (
              <div className="">
                <div className="flex gap-4 items-center">
                  <p className="text-gray-500 text-sm">Début : </p>
                  <p className="text-[var(--maincolor-light)]">
                    {properDate(currentRide.planifications_start).formattedDate}
                  </p>
                </div>
                <div className="flex gap-4 items-center">
                  <p className="text-gray-500 text-sm">Fin : </p>
                  <p className="text-[var(--maincolor-light)]">
                    {properDate(currentRide.planifications_end).formattedDate}
                  </p>
                </div>
              </div>
            )}

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
          <RideOverviewDriver
            rides_id={currentRide.rides_id}
            rides_seats={currentRide.rides_seats}
          />
        ) : (
          <RideOverviewPassenger rides_id={currentRide.rides_id} />
        )}
      </div>
    </div>
  );
};
type InstanceData = {
  bookings_id: number;
  bookings_status: "accepted" | "pending" | "refused";
  instances_departure_time: string;
  instances_departure: string;
  instances_destination: string;
  accounts_fullname: string;
  accounts_phone: string;
};
const RideOverviewPassenger = ({ rides_id }: { rides_id: number }) => {
  const { apiQuery } = useApi();
  const [instances, setInstances] = useState<any>([]);
  const [openInstanceId, setOpenInstanceId] = useState<number | null>(null);
  useEffect(() => {
    const fetchInstances = async () => {
      const res = await apiQuery("ride/instances", { rides_id });
      console.log(res);
      if (res === null || res.response === undefined) return;
      const grouped = res.response.sent.reduce((acc: any, obj: any) => {
        console.log(obj.receiver_instance_id);
        const key = obj.receiver_instance_id;
        if (!acc[key]) {
          acc[key] = [];
        }
        acc[key].push(obj);
        return acc;
      }, {});
      setInstances(grouped);
    };
    fetchInstances();
  }, [rides_id]);
  const toggleInstance = (id: number) => {
    setOpenInstanceId((prev) => (prev === id ? null : id));
  };

  console.log(instances);
  return (
    <div className="flex flex-col gap-2">
      {Object.keys(instances).length > 0 &&
        Object.keys(instances).map((key: any) => {
          const isOpen = openInstanceId === parseInt(key);
          const instanceArray = instances[key];
          const isCompleted =
            instances[key].filter(
              (instance: any) => instance.bookings_status == "accepted"
            ).length > 0;
          return (
            <div
              key={key}
              className="border border-[var(--maincolor-original)] rounded-sm transition-all"
            >
              <div
                className="flex gap-8 items-center p-3 relative hover:scale-[102%] transition-all hover:cursor-pointer"
                onClick={() => toggleInstance(parseInt(key))}
              >
                <h4 className="text-md text-[var(--maincolor-original)]">
                  {
                    properDate(instanceArray[0].instances_departure_time)
                      .formattedDate
                  }
                </h4>
                <p
                  className={`text-sm text-[var(--${
                    isCompleted  ? "maincolor-original" : "cta-accent"
                  })]`}
                >
                  {isCompleted
                    ? `Vous avez trouvé un conducteur !`
                    : "Vous n'avez pas de conducteur pour le moment !"}
                </p>
                {/* TODO IMPORTANT faire le cas où l'utilisateur n'a pas encore de trajet validé, dans ce cas la , le re diriger vers la séléction des trajets
                Reste  a finir le formulaire de création d'un trajet et enfin de faire la recherche d'un trajet et c'est fini (pour la majeure partie)*/}
                {isCompleted && 
                <p>Cherchez un conducteur</p>}
                <div
                  className={`transition-transform duration-300 absolute right-4 [&>svg]:w-3 [&>svg]:h-auto [&>svg]:fill-[var(--maincolor-original)] ${
                    isOpen ? "rotate-90" : ""
                  }`}
                >
                  <CtaRightArrow />
                </div>
              </div>

              <div
                className={`transition-[max-height] duration-300 overflow-y-scroll ${
                  isOpen ? "max-h-96" : "max-h-0"
                }`}
              >
                {instanceArray
                  .filter(
                    (instance: any) => instance.bookings_status !== "refused"
                  )
                  .map((instance: any, i: number) => {
                    return (
                      <div
                        key={i}
                        className="text-sm text-gray-700 p-3 border-t border-gray-200"
                      >
                        <p>
                          <strong>Heure exacte :</strong>{" "}
                          {
                            properDate(instance.instances_departure_time)
                              .timeOnly
                          }
                        </p>
                        <p>
                          <strong>Départ :</strong>{" "}
                          {instance.instances_departure}
                        </p>
                        <p>
                          <strong>Destination :</strong>{" "}
                          {instance.instances_destination}
                        </p>
                        <p>
                          <strong>Status :</strong>{" "}
                          <span
                            className={`font-semibold ${
                              instance.bookings_status === "pending"
                                ? "text-[var(--cta-text-highlight)]"
                                : "text-[var(--cta-secondary)]"
                            }`}
                          >
                            {instance.bookings_status}
                          </span>
                        </p>

                        <div className="mt-4">
                          <p className="font-semibold text-[var(--maincolor-original)]">
                            Conducteur :
                          </p>
                          <ul className="ml-4 list-disc">
                            <li>
                              <strong>Nom :</strong> {instance.driver_fullname}
                            </li>
                            <li>
                              <strong>Téléphone :</strong>{" "}
                              {instance.driver_phone}
                            </li>
                          </ul>
                        </div>
                      </div>
                    );
                  })}
              </div>
            </div>
          );
        })}
    </div>
  );
};

const RideOverviewDriver = ({
  rides_id,
  rides_seats,
}: {
  rides_id: number;
  rides_seats: number;
}) => {
  const { apiQuery } = useApi();
  const [instances, setInstances] = useState<any>([]);
  const [openInstanceId, setOpenInstanceId] = useState<number | null>(null);

  useEffect(() => {
    const fetchInstances = async () => {
      const res = await apiQuery("ride/instances", { rides_id });
      if (res === null || res.response === undefined) return;
      const grouped = res.response.received.reduce((acc: any, obj: any) => {
        const key = obj.instances_id;
        if (!acc[key]) {
          acc[key] = [];
        }
        acc[key].push(obj);
        return acc;
      }, {});
      setInstances(grouped);
    };
    fetchInstances();
  }, [rides_id]);
  const toggleInstance = (id: number) => {
    setOpenInstanceId((prev) => (prev === id ? null : id));
  };

  const handleBookingAction = (
    bookingId: number,
    newStatus: "accepted" | "refused"
  ) => {
    setInstances((prev: any) => {
      const updated = Object.fromEntries(
        Object.keys(prev).map((prevKey) => {
          const newArray = prev[prevKey].map((instance: any) => {
            if (instance.bookings_id === bookingId) {
              return {
                ...instance,
                bookings_status: newStatus,
              };
            }
            return instance;
          });
          return [prevKey, newArray];
        })
      );
      return updated;
    });
    apiQuery("bookings/set_status", {
      bookings_id: bookingId,
      bookings_status: newStatus,
    });
  };

  return (
    <div className="flex flex-col gap-2">
      {Object.keys(instances).length > 0 &&
        Object.keys(instances).map((key) => {
          const isOpen = openInstanceId === parseInt(key);
          const instanceArray = instances[key];
          const bookedSeats = instanceArray.filter(
            (inst: InstanceData) => inst.bookings_status === "accepted"
          ).length;
          const remainingSeats = rides_seats - bookedSeats;

          return (
            <div
              key={key}
              className="border border-[var(--maincolor-original)] rounded-sm transition-all"
            >
              <div
                className="flex gap-8 items-center p-3 relative hover:scale-[102%] transition-all hover:cursor-pointer"
                onClick={() => toggleInstance(parseInt(key))}
              >
                <h4 className="text-md text-[var(--maincolor-original)]">
                  {
                    properDate(instanceArray[0].instances_departure_time)
                      .formattedDate
                  }
                </h4>
                <p
                  className={`text-sm text-[var(--${
                    remainingSeats > 0 ? "maincolor-original" : "cta-accent"
                  })]`}
                >
                  {remainingSeats > 0
                    ? `Places restantes ${remainingSeats}`
                    : "Ce trajet est complet !"}
                </p>
                <div
                  className={`transition-transform duration-300 absolute right-4 [&>svg]:w-3 [&>svg]:h-auto [&>svg]:fill-[var(--maincolor-original)] ${
                    isOpen ? "rotate-90" : ""
                  }`}
                >
                  <CtaRightArrow />
                </div>
              </div>

              <div
                className={`transition-[max-height] duration-300 overflow-y-scroll ${
                  isOpen ? "max-h-96" : "max-h-0"
                }`}
              >
                {instanceArray
                  .filter(
                    (instance: any) => instance.bookings_status !== "refused"
                  )
                  .map((instance: any, i: number) => {
                    const isFull = remainingSeats <= 0;

                    return (
                      <div
                        key={i}
                        className="text-sm text-gray-700 p-3 border-t border-gray-200"
                      >
                        <p>
                          <strong>Heure exacte :</strong>{" "}
                          {
                            properDate(instance.instances_departure_time)
                              .timeOnly
                          }
                        </p>
                        <p>
                          <strong>Départ :</strong>{" "}
                          {instance.instances_departure}
                        </p>
                        <p>
                          <strong>Destination :</strong>{" "}
                          {instance.instances_destination}
                        </p>
                        <p>
                          <strong>Status :</strong>{" "}
                          <span
                            className={`font-semibold ${
                              instance.bookings_status === "pending"
                                ? "text-[var(--cta-text-highlight)]"
                                : "text-[var(--cta-secondary)]"
                            }`}
                          >
                            {instance.bookings_status}
                          </span>
                        </p>

                        <div className="mt-4">
                          <p className="font-semibold text-[var(--maincolor-original)]">
                            Demandeur :
                          </p>
                          <ul className="ml-4 list-disc">
                            <li>
                              <strong>Nom :</strong> {instance.sender_fullname}
                            </li>
                            <li>
                              <strong>Téléphone :</strong>{" "}
                              {instance.sender_phone}
                            </li>
                          </ul>
                        </div>

                        {instance.bookings_status === "pending" && (
                          <>
                            {isFull ? (
                              <p className="text-[var(--cta-accent)] font-semibold mt-2">
                                Trajet complet, impossible de valider plus de
                                réservations.
                              </p>
                            ) : (
                              <div className="mt-4 flex gap-2">
                                <button
                                  className="px-3 py-1 bg-[var(--cta-secondary)] text-white rounded hover:bg-[var(--cta-secondary-hover)] transition"
                                  onClick={() =>
                                    handleBookingAction(
                                      instance.bookings_id,
                                      "accepted"
                                    )
                                  }
                                >
                                  Valider
                                </button>
                                <button
                                  className="px-3 py-1 bg-[var(--cta-accent)] text-white rounded hover:bg-[var(--cta-accent)] transition"
                                  onClick={() =>
                                    handleBookingAction(
                                      instance.bookings_id,
                                      "refused"
                                    )
                                  }
                                >
                                  Refuser
                                </button>
                              </div>
                            )}
                          </>
                        )}
                      </div>
                    );
                  })}
              </div>
            </div>
          );
        })}
    </div>
  );
};

export default TrajetOverview;
