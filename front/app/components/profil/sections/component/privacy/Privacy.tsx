const Privacy = () => {
  return (
    <div>
      <div className="privacy">
        <h2>Protection des Données</h2>
        <div className="privacy__content">
          <p>
            Retrouvez ici les informations sur la protection de vos données
            personnelles.
          </p>
          <div className="privacy__main">
            <div className="privacy__main-item">
              <div className="privacy__item-content">
                <h5>Section 1 - Collecte des données</h5>
                <p>
                  Nous collectons uniquement les données nécessaires à la mise
                  en relation des utilisateurs et à l'amélioration du service.
                </p>
              </div>
            </div>
            <div className="privacy__main-item">
              <div className="privacy__item-content">
                <h5>Section 2 - Utilisation des données</h5>
                <p>
                  Vos données sont utilisées uniquement pour faciliter votre
                  expérience sur le site et ne sont pas revendues à des tiers.
                </p>
              </div>
            </div>
            <div className="privacy__main-item">
              <div className="privacy__item-content">
                <h5>Section 3 - Sécurité</h5>
                <p>
                  Nous mettons en place des mesures de sécurité pour protéger
                  vos informations contre les accès non autorisés.
                </p>
              </div>
            </div>
            <div className="privacy__main-item">
              <div className="privacy__item-content">
                <h5>Section 4 - Partage des données</h5>
                <p>
                  Vos données ne sont partagées qu'avec votre consentement ou
                  lorsque la loi l'exige.
                </p>
              </div>
            </div>
            <div className="privacy__main-item">
              <div className="privacy__item-content">
                <h5>Section 5 - Droit d'accès et de suppression</h5>
                <p>
                  Vous pouvez demander à consulter, modifier ou supprimer vos
                  données à tout moment en nous contactant.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Privacy;
