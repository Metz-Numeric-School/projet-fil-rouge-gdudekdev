import { useToken } from "~/context/TokenContext";
import { useState } from "react";

export const useApi = () => {
  const { token, setToken } = useToken();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

 const apiQuery = async (action: string, target: string) => {
  setLoading(true);
  setError(null);
  let tokenToUse = token;

  if (tokenToUse == null) {
    const newToken = await getAccessToken();
    if (newToken) {
      setToken(newToken);
      tokenToUse = newToken;
    } else {
      setLoading(false);
      throw new Error("Token invalide, connexion requise");
    }
  }
  try {
    const response = await fetch(
      `http://carpool/index.php?api&query=on&action=${action}&target=${target}`,
      {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${tokenToUse}`,
        },
      }
    );
    console.log(response);
    if (response.status === 401) {
      console.log("Demande d'access token suite a une 401");
      const newToken = await getAccessToken();
      if (newToken) {
        console.log("Mise a jour de l'état du token");
        setToken(newToken);
        // relancer la requête avec le nouveau token
        return await apiQuery(action, target);
      } else {
        throw new Error("Token invalide, connexion requise");
      }
    }
    // const raw = await response.text();
    // console.log("valeur en dure", raw);
    const data = await response.json();
    setLoading(false);
    console.log("reponse de la requete de query", data.response);
    return data;
  } catch (err) {
    setLoading(false);
    setError((err as Error).message);
    return null;
  }
};


  const apiConnect = async (email: string, password: string) => {
    setLoading(true);
    setError(null);
    try {
      const response = await fetch("http://carpool/index.php?api&query=login", {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      if (response.status === 422) {
        setError("Erreur de validation des identifiants");
        setLoading(false);
        return false;
      }

      const data = await response.json();
      setLoading(false);
      setToken(data.access_token);
      return true;
    } catch (err) {
      setLoading(false);
      setError((err as Error).message);
      return false;
    }
  };

  const getAccessToken = async () => {
    try {
      const response = await fetch(
        "http://carpool/index.php?api&query=refresh",
        {
          method: "POST",
          credentials: "include",
        }
      );

      if (response.status === 401) {
        setError("Refresh token invalide");
        return null;
      }
      // const data = await response.text();
      // console.log("reponse de demande d'access token",data);
      const data = await response.json();
      setToken(data.access_token);
      return data.access_token;
    } catch (err) {
      setError((err as Error).message);
      return null;
    }
  };

  return { apiQuery, apiConnect, loading, error };
};
