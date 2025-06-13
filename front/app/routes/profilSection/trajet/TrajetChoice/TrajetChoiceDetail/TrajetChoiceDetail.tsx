import { useState } from "react";
import { motion } from "framer-motion";
import FSOverlayNoContainer from "~/layouts/FSOverlayNoContainer/FSOverlayNoContainer";
import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import TrajetItineraire from "../TrajetItineraire/TrajetItineraire";
import Container from "~/components/main/container/Container";

interface TrajetChoiceDetailProps {
  trajet: {
    id: number;
    name: string;
    entreprise: string;
    rdv: string;
    distance: string;
  } | null;
  onClose: (
    trajet: {
      id: number;
      name: string;
      entreprise: string;
      rdv: string;
      distance: string;
    } | null
  ) => void;
}

const TrajetChoiceDetail = ({ trajet, onClose }: TrajetChoiceDetailProps) => {
  if (!trajet) return null;

  const minHeight = 200;
  const maxHeight = 500;
  const [height, setHeight] = useState(minHeight);
  const [isExpanded, setIsExpanded] = useState(false);

  const toggleHeight = () => {
    setHeight((prevHeight) =>
      prevHeight === minHeight ? maxHeight : minHeight
    );
    setIsExpanded((prev) => !prev);
  };

  const handleAjouterClick = () => {
    onClose(trajet);
  };

  return (
    <FSOverlayNoContainer onClose={() => onClose(null)}>
      <div className="bg-[var(--maincolor-original)] absolute top-0 bottom-0 right-0 left-0 -z-10 opacity-20"></div>

      {/* <motion.div
        style={{ height }}
        initial={{ height }}
        animate={{ height }}
        transition={{
          type: "spring",
          stiffness: 100,
          damping: 20,
          duration: 1,
        }}
        onClick={toggleHeight}
      > */}

      <div className="trajet__choice-detail-main">
        <div className="trajet__choice-detail-main-cta">
          <CtaRightArrow />
          <div className="trajet__choice-detail-add">
            <p>Ajouter+</p>
          </div>
        </div>
        <Container>
          <div className="trajet__choice-detail-main-content">
            <div className="trajet__choice-detail-main-desc">
              <div className="trajet__choice-detail-main-desc-basic">
                <h3>{trajet.name}</h3>
                <p>{trajet.entreprise}</p>
              </div>
            </div>
            <div className="trajet__choice-detail-main-itineraire">
              <h3>Itinéraire du trajet</h3>
              <div className="trajet__choice-detail-itineraire-frame">
                
                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>

                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>
                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>

                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>
                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>
{/* TODO https://codepen.io/grzegorz-rogala/pen/WNVRoVN  */}
                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>
                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>

                <div className="trajet__choice-detail-itineraire-step">
                  <div className="trajet__choice-detail-itineraire-step-left-container">
                    <div className="trajet__choice-detail-itineraire-line"></div>{" "}
                    {/* Ligne verticale */}
                    <div className="trajet__choice-detail-itineraire-checkpoint"></div>
                  </div>
                  <div className="trajet__choice-detail-itineraire-checkpoint-desc">
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-content">
                      <h5>Travail</h5>
                      <p>16:00</p>
                      <p>800m</p>
                    </div>
                    <div className="trajet__choice-detail-itineraire-checkpoint-desc-cta">
                      <p> arrow</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Container>
      </div>
      {/* </motion.div> */}
    </FSOverlayNoContainer>
  );
};

export default TrajetChoiceDetail;
