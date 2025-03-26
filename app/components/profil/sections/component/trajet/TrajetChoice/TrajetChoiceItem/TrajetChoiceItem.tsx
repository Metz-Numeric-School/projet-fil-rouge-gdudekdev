import IconLocation from "~/src/assets/icon/general/IconLocation";
interface TrajetChoiceItemProps {
  trajet: {
    id: number;
    name: string;
    entreprise: string;
    rdv: string;
    distance: string;
  };
  selected: boolean;
  toggleSelection: (id: number) => void;
  showDetails: (id: number) => void;
}

const TrajetChoiceItem = ({ trajet, selected, toggleSelection, showDetails }:TrajetChoiceItemProps) => {
  return (
    <div
      className={`trajet__choice-main-content-item cursor-pointer p-4 border rounded-lg shadow-sm ${
        selected ? "bg-gray-200" : "bg-white"
      }`}
      onClick={() => toggleSelection(trajet.id)}
    >
      <div className="trajet__choice-item-main-container">
        <div className="trajet__choice-item-desc flex items-center gap-4">
          <div className="trajet__choice-item-desc-img">
            <img src="app/src/assets/img/chat/dummyChatProfil.png" alt={trajet.name} className="w-12 h-12 rounded-full" />
          </div>
          <div className="trajet__choice-item-desc-main">
            <div className="trajet__choice-item-desc-main-contact">
              <h4 className="text-lg font-semibold">{trajet.name}</h4>
              <p className="text-sm text-gray-600">{trajet.entreprise}</p>
              <h5 className="text-sm font-medium">RDV à {trajet.rdv}</h5>
            </div>
            <div className="trajet__choice-item-desc-main-info flex items-center gap-2 text-gray-500">
              <IconLocation />
              <p>{trajet.distance}</p>
            </div>
          </div>
        </div>
        <div className="trajet__choice-item-actions flex justify-between mt-2">
          <label htmlFor={`choiceCheckbox-${trajet.id}`}>
            <input type="checkbox" id={`choiceCheckbox-${trajet.id}`} name="choiceCheckBox" value={trajet.id} checked={selected} readOnly className="pointer-events-none" />
          </label>
        </div>
      </div>
      <div onClick={(e) => { e.stopPropagation(); showDetails(trajet.id); }} className="trajet__choice-detail">
        <p>Voir le détail</p>
      </div>
    </div>
  );
};

export default TrajetChoiceItem;
