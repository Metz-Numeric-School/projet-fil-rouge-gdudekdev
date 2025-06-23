import { useAuth } from "~/context/AuthGuard";

export const useApi = () => {
  const { token, setToken } = useAuth();

 const apiQuery = async (query : string ,body={}) => {
  let tokenToUse = token;

  if (tokenToUse == null) {
    const newToken = await getAccessToken();
    if (newToken) {
      setToken(newToken);
      tokenToUse = newToken;
    } else {
      throw new Error("Token invalide, connexion requise");
    }
  }
  try {
    const response = await fetch(
      `http://carpool/index.php?api&query=${query}`,
      {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${tokenToUse}`,
        },
        body : JSON.stringify(body),
      }
    );
    if (response.status === 401) {
      const newToken = await getAccessToken();
      if (newToken) {
        setToken(newToken);
        // relancer la requête avec le nouveau token
        // return await apiQuery(action, target);
      } else {
        throw new Error("Token invalide, connexion requise");
      }
    }
    // const raw = await response.text();
    // console.log("valeur en dure", raw);
    const data = await response.json();
    return data;
  } catch (err) {
    return null;
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
        return null;
      }
      // const data = await response.text();
      // console.log("reponse de demande d'access token",data);
      const data = await response.json();
      setToken(data.access_token);
      return data.access_token;
    } catch (err) {
      return null;
    }
  };

  return { apiQuery };
};
