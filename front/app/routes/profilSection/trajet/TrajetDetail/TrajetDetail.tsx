import { useEffect, useState, type FormEvent } from "react";
import { useNavigate } from "react-router";
import Map from "~/components/main/map/Map";
import FormSubmit from "~/components/main/button/FormSubmit/FormSubmit";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";

export type Coord = [number | null, number | null];

type Route = {
  routes_departure: {
    routes_departure_name: string;
    routes_departure_coord: Coord;
  };
  routes_destination: {
    routes_destination_name: string;
    routes_destination_coord: Coord;
  };
};

type Planifications = {
  planifications_pattern_type: string;
  planifications_days_of_week: string[] | null;
  planifications_interval_week: number;
};

type RideForm = {
  rides_position: "passager" | "conducteur";
  rides_seats: number;
  planifications_start: string | null;
  planifications_end: string | null;
  planifications: Planifications;
  route: Route;
};

const TrajetDetail = ({ id }: { id: number }) => {
  const [trajet, setTrajet] = useState<any>(); // Vous pouvez ajuster le type si besoin
  const navigate = useNavigate();

  const onCloseTrajetDetail = () => {
    navigate("/profil/trajet");
  };

  return (
    <FSOverlay
      children={<TrajetDetailComponent trajet={trajet} />}
      onClose={onCloseTrajetDetail}
    />
  );
};

const TrajetDetailComponent = ({ trajet }: { trajet: any }) => {
  const [positions, setPositions] = useState<[Coord | null, Coord | null]>([
    [null, null],
    [null, null],
  ]);
  const [addressLabels, setAddressLabels] = useState<[string, string]>(["", ""]);

  const setPositionDeparture = (result: any) => {
    setPositions(([_, dest]) => [[+result.lon, +result.lat], dest]);
  };
  const setPositionDestination = (result: any) => {
    setPositions(([dep, _]) => [dep, [+result.lon, +result.lat]]);
  };

  return (
    <div className="flex-col gap-y-4 items-center mb-[var(--navbar-height)]">
      <h2 className="text-[var(--maincolor-original)] mb-4">
        Ajouter votre itinéraire
      </h2>
      <h3 className="text-[var(--maincolor-light)] mb-4">
        Décrivez votre trajet
      </h3>
      <div className="mb-8 flex flex-col justify-center items-center w-full">
        <div className="flex flex-col justify-between items-center w-full max-w-[320px] gap-4">
          <InputCoordMap
            setPosition={setPositionDeparture}
            setAddressLabel={(label) => setAddressLabels(([_, dest]) => [label, dest])}
            placeholder="Adresse de départ"
          />
          <InputCoordMap
            setPosition={setPositionDestination}
            setAddressLabel={(label) => setAddressLabels(([dep, _]) => [dep, label])}
            placeholder="Adresse d'arrivée"
          />
        </div>
        <div className="flex w-full justify-center items-center mt-8">
          <Map coord={positions} />
        </div>
      </div>
      <div className="text-[var(--maincolor-light)] mb-4">
        <h3>Planifiez votre trajet</h3>
        <PlanRide positions={positions} addressLabels={addressLabels} />
      </div>
    </div>
  );
};

type InputCoordMapProps = {
  setPosition: (result: any) => void;
  setAddressLabel: (label: string) => void;
  placeholder?: string;
};

const InputCoordMap = ({
  setPosition,
  setAddressLabel,
  placeholder = "Entrez une adresse",
}: InputCoordMapProps) => {
  const [query, setQuery] = useState("");
  const [results, setResults] = useState<any[]>([]);

  useEffect(() => {
    if (query.length < 3) {
      setResults([]);
      return;
    }
    const timer = setTimeout(() => {
      fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
        .then((res) => res.json())
        .then(setResults)
        .catch(console.error);
    }, 1000);
    return () => clearTimeout(timer);
  }, [query]);

  return (
    <div className="relative flex items-center justify-center w-full">
      <input
        type="text"
        value={query}
        placeholder={placeholder}
        onChange={(e) => setQuery(e.target.value)}
        className="shadow-sm border border-gray-100 rounded-sm p-2 w-full"
      />
      <ul className="max-h-40 overflow-auto z-10 absolute w-full bg-white">
        {results.map((result, idx) => (
          <li
            key={idx}
            onClick={() => {
              setPosition(result);
              setAddressLabel(result.display_name);
              setQuery(result.display_name);
              setResults([]);
            }}
            className="cursor-pointer hover:bg-gray-100 p-1"
          >
            {result.display_name}
          </li>
        ))}
      </ul>
    </div>
  );
};

const PlanRide = ({
  positions,
  addressLabels,
}: {
  positions: [Coord | null, Coord | null];
  addressLabels: [string, string];
}) => {
  const [planType, setPlanType] = useState("none");
  const [position, setPosition] = useState<"passager" | "conducteur">("passager");
  const [seats, setSeats] = useState(0);

  const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const form = new FormData(e.currentTarget);

    const selectedDays: string[] = ["mon", "tue", "wed", "thu", "fri"].filter((day) => form.get(day));

    const plan: Planifications = {
      planifications_pattern_type: form.get("planifications_pattern_type")?.toString() || "none",
      planifications_days_of_week: selectedDays,
      planifications_interval_week: parseInt(
        form.get("planifications_interval_weeks")?.toString() || "1",
        10
      ),
    };

    const route: Route = {
      routes_departure: {
        routes_departure_name: addressLabels[0],
        routes_departure_coord: positions[0] ?? [null, null],
      },
      routes_destination: {
        routes_destination_name: addressLabels[1],
        routes_destination_coord: positions[1] ?? [null, null],
      },
    };

    const rideForm: RideForm = {
      rides_position: position,
      rides_seats: position === "conducteur" ? seats : 0,
      planifications_start: form.get("planifications_start")?.toString() ?? null,
      planifications_end: form.get("planifications_end")?.toString() ?? null,
      planifications: plan,
      route,
    };

  };

  return (
    <form onSubmit={handleSubmit} className="flex flex-col gap-4">
      <div className="flex gap-4 items-center">
        <label>Position :</label>
        <select value={position} onChange={(e) => setPosition(e.target.value as "passager" | "conducteur")}>
          <option value="passager">Passager</option>
          <option value="conducteur">Conducteur</option>
        </select>
      </div>

      {position === "conducteur" && (
        <div className="flex gap-2 items-center">
          <label htmlFor="rides_seats">Nombre de places :</label>
          <input
            type="number"
            id="rides_seats"
            name="rides_seats"
            min={1}
            max={8}
            value={seats}
            onChange={(e) => setSeats(parseInt(e.target.value, 10))}
            className="border rounded p-1 w-16"
          />
        </div>
      )}

      <div className="flex gap-4 items-center">
        <label htmlFor="planifications_pattern_type">
          Souhaitez-vous planifier ?
        </label>
        <select
          name="planifications_pattern_type"
          id="planifications_pattern_type"
          onChange={(e) => setPlanType(e.target.value)}
        >
          <option value="none">Aucune</option>
          <option value="daily">Tous les jours</option>
          <option value="days">Personnalisé</option>
        </select>
      </div>

      {planType === "days" && (
        <div className="flex flex-col gap-2">
          <label>Jours choisis :</label>
          {[["mon","Lundi"], ["tue","Mardi"], ["wed", "Mercredi"], ["thu","Jeudi"], ["fri","Vendredi"]].map((day) => (
            <label key={day[0]}>
              <input type="checkbox" name={day[0]} /> {day[1]}
            </label>
          ))}
        </div>
      )}

      {["days", "daily"].includes(planType) && (
        <>
          <label>Date de début :</label>
          <input
            type="date-time"
            name="planifications_start"
            defaultValue={new Date().toISOString().split("T")[0]}
            min={new Date().toISOString().split("T")[0]}
          />
          <label>Date de fin :</label>
          <input
            type="date"
            name="planifications_end"
            defaultValue={new Date().toISOString().split("T")[0]}
          />
          <label>Fréquence :</label>
          <select name="planifications_interval_weeks">
            <option value="1">Chaque semaine</option>
            <option value="2">Toutes les 2 semaines</option>
            <option value="3">Toutes les 3 semaines</option>
            <option value="4">Toutes les 4 semaines</option>
          </select>
        </>
      )}

      <FormSubmit txt="Confirmer" />
    </form>
  );
};

export default TrajetDetail;
