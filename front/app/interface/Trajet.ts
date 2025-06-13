interface Trajet {
  id: number;
  departure: string;
  departure_time: string;
  destination: string;
  driver_id: number;
  fullname: string;
  phone: string;
  company: string;
  division: string;
}
interface TrajetRaw {
  instances_id: number;
  instances_departure: string;
  instances_departure_time: string;
  instances_destination: string;
  instances_driver_id: number;
  accounts_fullname: string;
  accounts_phone: string;
  entreprises_name: string;
  divisions_name: string;
}