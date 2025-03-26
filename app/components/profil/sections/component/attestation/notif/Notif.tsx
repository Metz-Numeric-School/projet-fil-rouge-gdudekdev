import { motion } from "framer-motion";
import IconWarning from "~/src/assets/icon/general/IconWarning";

const Notif = () => {
  console.log("Rendering Notif");

  return (
    <motion.div
      className="notif"
      initial={{ opacity: 0, y: -50 }} // Initial state (avant l'animation)
      animate={{ opacity: 1, y: 0 }} // Final state (après l'animation)
      exit={{ opacity: 0, y: 50 }} // State quand le composant disparaît
      transition={{ duration: 0.5 }} // Durée de l'animation
    >
      <h2>Pour quelle période souhaitez-vous recevoir une attestation?</h2>
      <div className="notif__content">
        <div className="notif__content-info">
          <div className="notif__content-info-img">
            <IconWarning />
          </div>
          <p>
            Les trajets effectués au cours des dernières 72 heures
            n'apparaîtront pas dans votre attestation.
          </p>
        </div>
        <div className="notif__content-form">
          <form action="#" method="get" className="notif__form">
            <label htmlFor="notif_debut">Du</label>
            <input
              type="date"
              id="notif_debut"
              name="notif_debut"
              placeholder="JJ/MM/AAAA"
              min={new Date().toISOString().split("T")[0]} // Utilisation de la date du jour
            />
            <label htmlFor="notif_fin">Au</label>
            <input
              type="date"
              id="notif_fin"
              name="notif_fin"
              placeholder="JJ/MM/AAAA"
              min={new Date().toISOString().split("T")[0]} // Utilisation de la date du jour
            />
            <input type="submit" value="Recevoir une attestation" />
          </form>
        </div>
      </div>
    </motion.div>
  );
};

export default Notif;
