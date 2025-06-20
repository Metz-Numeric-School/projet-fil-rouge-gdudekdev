Ignorer et passer au contenu
Vous avez dit :
  const [rides, setRides] = useState([]);

  useEffect(() => {
    const fetchRides = async () => {
      try {
        const response = await apiQuery("rides_all");
        const data = await response.json();
        setRides(data); 
      } catch (err) {
        console.error("Erreur lors de la récupération des trajets :", err);
      }
    };

    fetchRides();
  }, []);


commnet je peux stocker en local les Rides pour éviter de les perdre au chargmeent ?
ChatGPT a dit :

Pour stocker les rides localement et éviter de les perdre au rechargement de la page, tu peux utiliser le localStorage du navigateur. Voici comment faire :
🔁 Étapes à suivre :

    Charger depuis localStorage si dispo

    Sauvegarder dans localStorage après récupération de l'API

🧠 Exemple modifié :

import { useEffect, useState } from "react";

const MyComponent = () => {
  const [rides, setRides] = useState(() => {
    // Étape 1 : charger les données depuis localStorage au tout début
    const storedRides = localStorage.getItem("rides");
    return storedRides ? JSON.parse(storedRides) : [];
  });

  useEffect(() => {
    const fetchRides = async () => {
      try {
        const response = await apiQuery("rides_all");
        const data = await response.json();
        setRides(data);

        // Étape 2 : sauvegarder dans localStorage
        localStorage.setItem("rides", JSON.stringify(data));
      } catch (err) {
        console.error("Erreur lors de la récupération des trajets :", err);
      }
    };

    fetchRides();
  }, []);

  return (
    <div>
      {/* affichage des rides */}
      {rides.map((ride) => (
        <div key={ride.id}>{ride.name}</div>
      ))}
    </div>
  );
};

✅ Avantages :

    Les données sont conservées même après un rechargement de la page.

    Pas de requête API inutile si les données sont déjà en cache (tu peux même ajouter une logique pour éviter l'appel API si les données sont déjà présentes).

💡 Astuce bonus : vérifier si les données en cache sont trop vieilles

Tu peux aussi stocker une date de mise en cache dans localStorage, et ne rafraîchir depuis l'API que si la donnée est trop ancienne.

Souhaites-tu que je t’ajoute cette partie aussi ?
Vous avez dit :
oui je veux bien
ChatGPT a dit :

Parfait ! Voici comment tu peux ajouter un système d'expiration du cache dans le localStorage, pour rafraîchir les données seulement si elles sont trop anciennes (par exemple, plus de 1 heure).
✅ Code Complet avec expiration du cache

import { useEffect, useState } from "react";

const CACHE_KEY = "rides";
const CACHE_TIMESTAMP_KEY = "rides_timestamp";
const CACHE_DURATION = 1000 * 60 * 60; // 1 heure

const MyComponent = () => {
  const [rides, setRides] = useState(() => {
    const cachedData = localStorage.getItem(CACHE_KEY);
    return cachedData ? JSON.parse(cachedData) : [];
  });

  useEffect(() => {
    const fetchRides = async () => {
      try {
        const now = Date.now();
        const cachedTimestamp = localStorage.getItem(CACHE_TIMESTAMP_KEY);

        if (cachedTimestamp && now - parseInt(cachedTimestamp, 10) < CACHE_DURATION) {
          // Les données sont encore valides, pas besoin d'appeler l'API
          console.log("Données chargées depuis le cache local.");
          return;
        }

        // Données expirées ou inexistantes, on appelle l'API
        const response = await apiQuery("rides_all");
        const data = await response.json();
        setRides(data);

        // Stocker dans localStorage
        localStorage.setItem(CACHE_KEY, JSON.stringify(data));
        localStorage.setItem(CACHE_TIMESTAMP_KEY, now.toString());

        console.log("Données mises à jour depuis l'API.");
      } catch (err) {
        console.error("Erreur lors de la récupération des trajets :", err);
      }
    };

    fetchRides();
  }, []);

  return (
    <div>
      {rides.map((ride) => (
        <div key={ride.id}>{ride.name}</div>
      ))}
    </div>
  );
};

export default MyComponent;

