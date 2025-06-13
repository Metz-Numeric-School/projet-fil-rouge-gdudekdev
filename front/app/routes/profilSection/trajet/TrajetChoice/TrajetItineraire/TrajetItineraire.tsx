const TrajetItineraire = () => {
      const trajetDetails = [
        { title: 'Ville de départ', value: 'Paris' },
        { title: 'Heure de départ', value: '08:00' },
        { title: 'Adresse', value: '123 Rue de Paris, 75001' },
        { title: 'Distance', value: '50 km' },
      ];
    
      const itineraires = [
        { title: 'Itinéraire 1', value: 'Paris → Lyon' },
        { title: 'Itinéraire 2', value: 'Lyon → Marseille' },
      ];
    
      return (
        <div className="trajet__details-item mb-6">
          <h4 className="text-md font-bold mb-2">Départ</h4>
    
          <div className="progression-container">
            {/* Départ */}
            {trajetDetails.map((step, index) => (
              <div key={index} className="progression-step">
                <div className="circle"></div>
                <div className="progression-info">
                  <p>
                    <strong>{step.title}:</strong> {step.value}
                  </p>
                </div>
    
                {/* Affichage de la ligne entre les étapes sauf pour la dernière */}
                {index < trajetDetails.length - 1 && <div className="progression-line"></div>}
              </div>
            ))}
    
            {/* Itinéraires */}
            {itineraires.map((itineraire, index) => (
              <div key={index + trajetDetails.length} className="progression-step">
                <div className="circle"></div>
                <div className="progression-info">
                  <p>
                    <strong>{itineraire.title}:</strong> {itineraire.value}
                  </p>
                </div>
    
                {/* Affichage de la ligne entre les itinéraires sauf pour le dernier */}
                {index < itineraires.length - 1 && <div className="progression-line"></div>}
              </div>
            ))}
          </div>
        </div>
      );
    };
    
    export default TrajetItineraire;
    