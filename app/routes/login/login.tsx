import { useNavigate } from "react-router-dom";

const Login = () => {
  const navigate = useNavigate();

  const handleLoginClick = (e: React.MouseEvent<HTMLButtonElement>) => {
    e.preventDefault();
    navigate("/?path=/home"); 
  };

  return (
    <div className="login">
      <div className="login__overlay"></div>
      <div className="login__container">
        <h1 className="login__title">Connexion</h1>
        <form className="login__form" method="post" action={"#"}>
          <div className="login__input-group">
            <label htmlFor="email">Email</label>
            <input type="email" id="email" placeholder="Votre email" required />
          </div>

          <div className="login__input-group">
            <label htmlFor="password">Mot de passe</label>
            <input type="password" id="password" placeholder="Votre mot de passe" required />
          </div>

          <button type="submit" className="login__button" onClick={handleLoginClick}>
            Se connecter
          </button>
        </form>

        <p className="login__footer">
          Pas encore de compte ? <a href="/register" className="login__link">Inscrivez-vous</a>
        </p>
      </div>
    </div>
  );
};

export default Login;
