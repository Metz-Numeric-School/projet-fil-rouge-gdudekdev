import { useEffect, useState } from "react";

const Cookies = () => {
  const [showUpdateButton, setShowUpdateButton] = useState(false);

  useEffect(() => {
    const form = document.getElementById("cookie-settings-form");
    form?.addEventListener("submit", function (event) {
      event.preventDefault();
      const performanceCookies = (
        document.getElementById("performance-cookies") as HTMLInputElement
      )?.checked;
      const functionalityCookies = (
        document.getElementById("functionality-cookies") as HTMLInputElement
      )?.checked;
      const advertisingCookies = (
        document.getElementById("advertising-cookies") as HTMLInputElement
      )?.checked;

      document.cookie = `performanceCookies=${performanceCookies}; path=/;`;
      document.cookie = `functionalityCookies=${functionalityCookies}; path=/;`;
      document.cookie = `advertisingCookies=${advertisingCookies}; path=/;`;

      setShowUpdateButton(false);
    });

    const checkboxes = document.querySelectorAll(
      "#performance-cookies, #functionality-cookies, #advertising-cookies"
    );
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener("change", () => setShowUpdateButton(true));
    });

    return () => {
      checkboxes.forEach((checkbox) => {
        checkbox.removeEventListener("change", () => setShowUpdateButton(true));
      });
    };
  }, []);

  return (
    <div className="cookies">
      <h2>Paramètres des Cookies</h2>
      <p>Gérez vos préférences en matière de cookies ici.</p>
      <form id="cookies-settings-form" className="cookies__form">
        <div className="cookies__main">
          <label className="cookies__main-item">
            <div className="cookies__main-item-desc">
              <h5>Cookies Essentiels</h5>
              <p>Ces cookies sont nécessaires au bon fonctionnement du site.</p>
            </div>
            <div className="cookies__main-item-submit">
              <input type="checkbox" checked disabled />
            </div>
          </label>
          <label className="cookies__main-item">
            <div className="cookies__main-item-desc">
              <h5>Cookies de Performance</h5>
              <p>
                Ces cookies nous permettent d’analyser le trafic et d'améliorer
                votre expérience.
              </p>
            </div>
            <div className="cookies__main-item-submit">
              <input type="checkbox" id="performance-cookies" />
            </div>
          </label>
          <label className="cookies__main-item">
            <div className="cookies__main-item-desc">
              <h5>Cookies de Fonctionnalité</h5>
              <p>Ces cookies permettent d’enregistrer vos préférences.</p>
            </div>
            <div className="cookies__main-item-submit">
              <input type="checkbox" id="functionnality-cookies" />
            </div>
          </label>
          <label className="cookies__main-item">
            <div className="cookies__main-item-desc">
              <h5>Cookies Publicitaires</h5>
              <p>
                Nous n'affichons pas de publicités, mais certains cookies
                peuvent être utilisés pour des analyses anonymes.
              </p>
            </div>
            <div className="cookies__main-item-submit">
              <input type="checkbox" id="advertising-cookies" />
            </div>
          </label>
        </div>
        {showUpdateButton && <input type="submit" value="Mettre à jour" />}
      </form>
    </div>
  );
};

export default Cookies;
