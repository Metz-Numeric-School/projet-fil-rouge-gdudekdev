import { useNavigate } from "react-router-dom";
import { useState } from "react";
import { useToken } from "~/context/TokenContext";
import { useApi } from "~/utils/api";

const Login = () => {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { apiConnect, loading, error } = useApi();
  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    let data = await apiConnect(email, password);
    if(data != false){
      navigate("/home");
    }else{
      navigate("/login");
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
