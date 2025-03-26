import React, { useState } from "react";
import TrajetChoiceItem from "./TrajetChoiceItem/TrajetChoiceItem";
import TrajetChoiceDetail from "./TrajetChoiceDetail/TrajetChoiceDetail";

interface Trajet {
  id: number;
  name: string;
  entreprise: string;
  rdv: string;
  distance: string;
}

const TrajetChoice = () => {
  const trajets: Trajet[] = [
    { id: 1, name: "John", entreprise: "Entreprise", rdv: "8h00", distance: "16 min à pied" },
    { id: 2, name: "Sophie", entreprise: "StartUp", rdv: "8h15", distance: "10 min à pied" },
    { id: 3, name: "Marc", entreprise: "TechCorp", rdv: "7h45", distance: "20 min à pied" },
    { id: 4, name: "Emma", entreprise: "InnovateX", rdv: "9h00", distance: "5 min à pied" },
    { id: 5, name: "Alex", entreprise: "GreenWay", rdv: "8h30", distance: "12 min à pied" }
  ];

  const [selectedChoiceItem, setSelectedChoiceItem] = useState<number[]>([]);
  const [selectedChoiceDetail, setSelectedChoiceDetail] = useState<Trajet | null>(null);

  const toggleSelection = (id: number) => {
    setSelectedChoiceItem(prev => 
      prev.includes(id) ? prev.filter(item => item !== id) : [...prev, id]
    );
  };

  const showDetails = (id: number) => {
    const trajet = trajets.find(t => t.id === id);
    setSelectedChoiceDetail(trajet || null);
  };

  const closeDetails = (trajet: Trajet | null) => {
    setSelectedChoiceDetail(null);
    if (trajet) {
      setSelectedChoiceItem(prev =>
        prev.includes(trajet.id)
          ? prev.filter(item => item !== trajet.id)
          : [...prev, trajet.id]
      );
    }
  };

  return (
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
            {trajets.map((trajet) => (
              <TrajetChoiceItem
                key={trajet.id}
                trajet={trajet}
                selected={selectedChoiceItem.includes(trajet.id)}
                toggleSelection={toggleSelection}
                showDetails={showDetails}
              />
            ))}
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
  );
};

export default TrajetChoice;
