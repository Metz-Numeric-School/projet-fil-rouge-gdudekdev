const axios = require('axios');

const register = async () => {
  try {
    const response = await axios.post("http://carpoolbackend/register", {
      email: "alice@email.com",
      password: "mypassword"
    });

    console.log("Réponse:", response.data);
  } catch (error) {
    console.error("Erreur:", error.response?.data || error.message);
  }
};

register();
