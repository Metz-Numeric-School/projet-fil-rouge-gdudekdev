export const apiConnect = async (email: string, password: string) => {
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
      return false;
    }
    return true;
  } catch (err) {
    return false;
  }
};
