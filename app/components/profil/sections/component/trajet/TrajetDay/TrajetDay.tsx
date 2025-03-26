import { useRef, useState } from "react";
import ToggleBtn from "~/components/main/button/ToggleBtn/ToggleBtn";

interface TrajetDayProps {
      day:string,
}
const TrajetDay = ({day,}:TrajetDayProps) => {
  const [departureTime, setDepartureTime] = useState("");
  const [arrivalTime, setArrivalTime] = useState("");
  const containerRef = useRef<HTMLDivElement>(null);
  
  return (
    <div  ref={containerRef} className="trajet__planning-content-day">
      <div className="trajet__planning-content-day-name">
        <h3>Chaque {day}</h3>
      </div>
      <div className="trajet__planning-content-day-main">
        <table className="trajet__planning-content-day-main-table">
          <tbody>
            <tr>
              <td>
                <p>Domicile</p>
              </td>
              <td>
                <input
                  type="time"
                  value={departureTime}
                  onChange={(e) => setDepartureTime(e.target.value)}
                />
              </td>
              <td>
                <ToggleBtn />
              </td>
            </tr>
            <tr>
              <td>
                <p>Travail</p>
              </td>
              <td>
                <input
                  type="time"
                  value={arrivalTime}
                  onChange={(e) => setArrivalTime(e.target.value)}
                />
              </td>
              <td>
                <ToggleBtn />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  );
};
export default TrajetDay;