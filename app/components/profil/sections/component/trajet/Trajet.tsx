import React, { useState } from "react";
import ToggleBtn from "~/components/main/button/ToggleBtn/ToggleBtn";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import IconTrajetHome from "~/src/assets/icon/profil/trajet/IconTrajetHome";
import IconTrajetWork from "~/src/assets/icon/profil/trajet/IconTrajetWork";
import TrajetDay from "./TrajetDay/TrajetDay";

const Trajet = () => {
  return (
      <div className="trajet">
        <h2>Mon Trajet</h2>
        <div className="trajet__content">
          <section className="trajet__section trajet__adress">
            <div className="trajet__adress-left">
              <div className="trajet__adress-left-from">
                <IconTrajetHome />
              </div>
              <div className="trajet__adress-left-between"></div>
              <div className="trajet__adress-left-to">
                <IconTrajetWork />
              </div>
            </div>
            <div className="trajet__adress-right">
              <div className="trajet__adress-right-from">
                <h3>Domicile</h3>
                <p>Adresse</p>
                <div className="trajet__adress-right-cta">
                  <div className="trajet__adress-right-cta-p">
                    <p>Modifier l'adresse</p>
                  </div>
                  <div className="trajet__adress-right-cta-svg">
                    <CtaRightArrow />
                  </div>
                </div>
              </div>
              <div className="trajet__adress-right-to">
                <h3>Travail</h3>
                <p>Adresse</p>
                <div className="trajet__adress-right-cta">
                  <div className="trajet__adress-right-cta-p">
                    <p>Modifier l'adresse</p>
                  </div>
                  <div className="trajet__adress-right-cta-svg">
                    <CtaRightArrow />
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section className="trajet__section trajet__role">
            <div className="trajet__role-content">
              <h3>Je suis conducteur</h3>
              <p>Proposez moi des passagers</p>
            </div>
            <div className="trajet__role-cta">
              <ToggleBtn />
            </div>
          </section>
          <section className="trajet__section trajet__disable">
            <div className="trajet__disable-content">
              <h3>Désactiver mon trajet</h3>
            </div>
            <div className="trajet__disable-cta">
              <ToggleBtn />
            </div>
          </section>
          <section className="trajet__section trajet__planning">
            <div className="trajet__planning-title">
              <h3>Mes horaires de départs habituels</h3>
            </div>
            <div className="trajet__planning-content">
              <TrajetDay day="Lundi"/>
              <TrajetDay day="Mardi"/>
              <TrajetDay day="Mercredi"/>
              <TrajetDay day="Jeudi"/>
              <TrajetDay day="Vendredi"/>
              <TrajetDay day="Samedi"/>
              <TrajetDay day="Dimanche"/>
            </div>
          </section>
        </div>
      </div>
  );
};

export default Trajet;