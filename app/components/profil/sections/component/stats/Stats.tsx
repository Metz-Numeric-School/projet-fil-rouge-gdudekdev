import React, { useEffect, useState } from "react";

// Fonction pour ajouter une animation de compteur
const AnimatedNumber: React.FC<{
  value: number;
  label: string;
  unit: string;
}> = ({ value, label, unit }) => {
  const [displayedValue, setDisplayedValue] = useState(0);

  useEffect(() => {
    const increment = () => {
      if (displayedValue < value) {
        setDisplayedValue((prev) =>
          Math.min(prev + Math.ceil(value / 40), value)
        ); // Animation progress
      }
    };
    const interval = setInterval(increment, 30);
    return () => clearInterval(interval);
  }, [displayedValue, value]);

  return (
    <div className="stat-item">
      <div className="stat-item__label">{label}</div>
      <div className="stat-item__value">
        {displayedValue}
        {unit}
      </div>
    </div>
  );
};

const Stats: React.FC = () => {
  const [stats, setStats] = useState({
    totalTrips: 25,
    totalDistance: 1500,
    totalPassengers: 75,
    totalSavings: 300,
  });

  useEffect(() => {
    // Simuler une récupération des données
    const timeout = setTimeout(() => {
      setStats({
        totalTrips: 30,
        totalDistance: 1800,
        totalPassengers: 100,
        totalSavings: 350,
      });
    }, 1500);

    return () => clearTimeout(timeout);
  }, []);

  return (
    <div className="stats">
      <h2>Vos Statistiques de Covoiturage</h2>
      <div className="stats__content">
        <p className="stats__description">
          Voici vos statistiques de covoiturage avec des animations ludiques !
        </p>
        <div className="stats__main">
          <div className="stats__main-item">
            <AnimatedNumber
              value={stats.totalTrips}
              label="Trajets effectués"
              unit=""
            />
          </div>
          <div className="stats__main-item">
            <AnimatedNumber
              value={stats.totalDistance}
              label="Distance parcourue"
              unit=" km"
            />
          </div>
          <div className="stats__main-item">
            <AnimatedNumber
              value={stats.totalPassengers}
              label="Passagers transportés"
              unit=""
            />
          </div>
          <div className="stats__main-item">
            <AnimatedNumber
              value={stats.totalSavings}
              label="Économies réalisées"
              unit=" €"
            />
          </div>
        </div>

        <div className="stats__progress">
          <div className="progress-bar">
            <label>Trajets réalisés</label>
            <div className="progress-bar__container">
              <div
                className="progress-bar__fill"
                style={{
                  width: `${(stats.totalTrips / 100) * 100}%`,
                  backgroundColor: "var(--cta-text-highlight)",
                }}
              ></div>
            </div>
          </div>
          <div className="progress-bar">
            <label>Distance parcourue</label>
            <div className="progress-bar__container">
              <div
                className="progress-bar__fill"
                style={{
                  width: `${(stats.totalDistance / 2000) * 100}%`,
                  backgroundColor: "var(--cta-accent)",
                }}
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Stats;
