
export const apiGuard = async () => {
  try {
    const response = await fetch("http://carpool/index.php?api&query=refresh", {
      method: "POST",
      credentials: "include",
      headers: {
        "Content-Type": "application/json",
      },
    });
    
    if (response.status === 422) {
      return false;
    }

    const data = await response.json();
    return data.access_token;
  } catch (err) {
    return false;
  }
};
