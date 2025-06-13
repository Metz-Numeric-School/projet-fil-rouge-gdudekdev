import { useNavigate, useParams } from "react-router";
import { useEffect, useLayoutEffect, useState } from "react";
import { useApi } from "~/hooks/useApi";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";
import TrajetChoiceItem from "../profilSection/trajet/TrajetChoice/TrajetChoiceItem/TrajetChoiceItem";
import TrajetChoiceDetail from "../profilSection/trajet/TrajetChoice/TrajetChoiceDetail/TrajetChoiceDetail";

interface Trajet {
  id: number;
  // autres propriétés selon ta définition
}

const Ride = () => {
  const { id } = useParams();
  const navigate = useNavigate();

  const [rides, setRides] = useState<TrajetRaw[][] | null>(null);
  const { apiQuery } = useApi();

  useLayoutEffect(() => {
    async function fetchRides() {
      try {
        const result = await apiQuery("ride_choice", { id });
        if (result?.response) {
          setRides(result.response);
        }
      } catch (error) {
        console.error("Erreur lors du chargement des Trajets :", error);
      }
    }
    fetchRides();
  }, [id]);
  const rides_array: Trajet[] = [];
  if (rides && rides.length > 0) {
    rides_array.push(
      ...rides.flat().map((ride: TrajetRaw) => ({
        id: ride.instances_id,
        departure: ride.instances_departure,
        departure_time: ride.instances_departure_time,
        destination: ride.instances_destination,
        driver_id: ride.instances_driver_id,
        fullname: ride.accounts_fullname,
        phone: ride.accounts_phone,
        company: ride.entreprises_name,
        division: ride.divisions_name,
      }))
    );
  }

  const [selectedChoiceItem, setSelectedChoiceItem] = useState<number[]>([]);
  const [selectedChoiceDetail, setSelectedChoiceDetail] =
    useState<Trajet | null>(null);

  const toggleSelection = (id: number) => {
    setSelectedChoiceItem((prev) =>
      prev.includes(id) ? prev.filter((item) => item !== id) : [...prev, id]
    );
  };

  const showDetails = (id: number) => {
    const trajet = rides_array?.find((t) => t.id === id);
    setSelectedChoiceDetail(trajet || null);
  };

  const closeDetails = (trajet: Trajet | null) => {
    setSelectedChoiceDetail(null);
    if (trajet) {
      setSelectedChoiceItem((prev) =>
        prev.includes(trajet.id)
          ? prev.filter((item) => item !== trajet.id)
          : [...prev, trajet.id]
      );
    }
  };

  const closeRide = () => {
    navigate("/home");
  };

  return (
    <FSOverlay onClose={closeRide}>
      <div className="trajet__choice">
        <form action="#" method="post" className="trajet__choice-form">
          <div className="trajet__choice-header">
            <h2>Choisissez des conducteurs</h2>
            <p>Trouvez des covoitureurs qui partagent votre trajet</p>
          </div>
          <div className="trajet__choice-main">
            <div className="trajet__choice-main-header">
              <h3>Meilleurs résultats</h3>
            </div>
            <div className="trajet__choice-main-content">
              {rides_array && rides_array.length > 0 ? (
                rides_array.map((ride) => (
                  <TrajetChoiceItem
                    key={ride.id}
                    trajet={ride}
                    selected={selectedChoiceItem.includes(ride.id)}
                    toggleSelection={toggleSelection}
                    showDetails={showDetails}
                  />
                ))
              ) : (
                <div>
                  <p>Pas de trajet disponible</p>
                </div>
              )}
            </div>
          </div>
          <div className="trajet__choice-form-submit mt-4">
            <input type="submit" value="Envoyer ma demande" />
          </div>
        </form>

        {selectedChoiceDetail && (
          <TrajetChoiceDetail
            trajet={selectedChoiceDetail}
            onClose={closeDetails}
          />
        )}
      </div>
    </FSOverlay>
  );
};

export default Ride;
