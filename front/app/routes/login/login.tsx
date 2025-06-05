import { useNavigate } from "react-router-dom";
import { useState } from "react";
import { useToken } from "~/context/TokenContext";

const Login = () => {
  const navigate = useNavigate();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { token, setToken } = useToken();

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    try {
      const response = await fetch("http://carpool/index.php?api&query=login", {
        method: "POST",
        credentials : 'include',
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email: email,
          password: password,
        }),
      });
      console.log(response);
      if (response.status == 422) {
        throw new Error("Credentials are incorrect");
        // TODO faire l'UI lorsque le user et mdp sont incorrects
      }

      // const raw = await response.text();
      // console.log(raw);
      
      const data = await response.json();
      console.log("data: ", data)
      navigate("/home");
    } catch (error) {
      console.error("Erreur lors de l'envoi du formulaire :", error);
    }
  };

  return (
    <div className="login">
      <div className="login__overlay"></div>
      <div className="login__container">
        <h1 className="login__title">Connexion</h1>
        <form className="login__form" method="post" onSubmit={handleSubmit}>
          <div className="login__input-group">
            <label htmlFor="email">Email</label>
            <input
              type="text"
              id="email"
              placeholder="Votre email"
              required
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div className="login__input-group">
            <label htmlFor="password">Mot de passe</label>
            <input
              type="password"
              id="password"
              placeholder="Votre mot de passe"
              required
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <button type="submit" className="login__button">
            Se connecter
          </button>
        </form>

        <p className="login__footer">
          Pas encore de compte ?{" "}
          <a href="/register" className="login__link">
            Inscrivez-vous
          </a>
        </p>
      </div>
    </div>
  );
};

export default Login;
