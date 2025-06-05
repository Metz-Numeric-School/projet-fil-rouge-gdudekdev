const apiFetch = () => {};
export const getRefreshToken = async () => {
  try {
    const response = await fetch("http://carpool/index.php?api&query=refresh", {
      method: "POST",
      credentials: "include",
    });
    const raw = await response.text();
    console.log(raw);
  } catch (error) {
    throw new Error("Erreur");
  }
};

export const getAccessToken = async () => {
  try {
    const response = await fetch("http://carpool/index.php?api&query=refresh", {
      method: "POST",
      credentials: "include",
    });
    // const raw = await response.text();
    // console.log(raw);

    const data = await response.json();
    console.log("data: ", data);
  } catch (error) {
    console.log(error);
    throw new Error("Erreur");
  }
};
