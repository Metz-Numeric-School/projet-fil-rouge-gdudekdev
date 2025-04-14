import { useNavigate } from "react-router-dom";

const Login = () => {
  const navigate = useNavigate();

  const handleSubmit = (e: React.MouseEvent<HTMLButtonElement>) => {
    const sendContactForm = async () => {
      const response = await fetch('http://carpool', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          name: 'Jean Dupont',
          email: 'jean@email.fr'
        }).toString()
      });
    
      const text = await response.text();
      console.log('Réponse du serveur PHP:', text);
    };
    
    sendContactForm();
    // navigate("/?path=/home");
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
            <input
              type="password"
              id="password"
              placeholder="Votre mot de passe"
              required
            />
          </div>

          <button
            type="submit"
            className="login__button"
            onClick={handleSubmit}
          >
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
