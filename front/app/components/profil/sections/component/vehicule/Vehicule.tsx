import React, { useState, useCallback } from "react";
import { motion, AnimatePresence } from "framer-motion";

interface StepProps {
  step: string;
  choices?: string[];
  stepTitles: { [key: string]: string };
  onSelect: (step: string, choice: string) => void;
  formData: { [key: string]: string };
}
const Step: React.FC<StepProps> = ({
  step,
  choices,
  stepTitles,
  onSelect,
  formData,
}) => {
  const [inputValue, setInputValue] = useState(formData[step] || "");

  const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    setInputValue(event.target.value);
  };

  const handleSkip = (event: React.MouseEvent<HTMLButtonElement>) => {
    event.preventDefault();
    onSelect(step, "");
  };

  return (
    <motion.div
      initial={{ opacity: 0, x: 50 }}
      animate={{ opacity: 1, x: 0 }}
      exit={{ opacity: 0, x: -50 }}
      transition={{ duration: 0.3 }}
    >
      {step !== "recap" ? (
        <>
          <h2 className="vehicule__step-title">{stepTitles[step]}</h2>
          {step === "immatriculation" ? (
            <div className="vehicule__step-skippable">
              <input
                type="text"
                value={inputValue}
                onChange={handleInputChange}
                placeholder="Entrez votre plaque d'immatriculation"
              />
              <div className="vehicule__step-skippable-action">
                <button className="vehicule__step-btn skippable"
                  onClick={(e) => {
                    e.preventDefault();
                    onSelect(step, inputValue);
                  }}
                >
                  Valider
                </button>
                <button  className="vehicule__step-btn skippable"onClick={handleSkip}>Passer</button>
              </div>
            </div>
          ) : (
            <div className="vehicule__step-choice-list">
              {choices?.map((choice) => (
                <div key={choice} onClick={() => onSelect(step, choice)}>
                  <p>{choice}</p>
                </div>
              ))}
            </div>
          )}
        </>
      ) : (
        <>
          <h2 className="vehicule__step-title">Récapitulatif</h2>
          <div className="vehicule__recap-list">
            {Object.entries(formData).map(([key, value]) => (
              <p key={key}>
                <strong className="vehicule__recap-key">{key}:</strong> {value || "Non renseigné"}
              </p>
            ))}
          </div>
          <button className="vehicule__step-btn skippable"type="submit">Valider</button>
        </>
      )}
    </motion.div>
  );
};

const Vehicule = () => {
  const [currentStepIndex, setCurrentStepIndex] = useState(0);
  const [formData, setFormData] = useState({});

  const steps = [
    "marque",
    "modele",
    "couleur",
    "motorisation",
    "immatriculation",
    "recap",
  ];
  const choices: { [key: string]: string[] } = {
    marque: ["CITROEN", "PEUGEOT", "RENAULT"],
    modele: ["MODEL1", "MODEL2", "MODEL3"],
    couleur: ["Noir", "Blanc", "Rouge"],
    motorisation: ["Electrique", "Essence", "Hybride"],
  };
  const stepTitles = {
    marque: "Quelle est la marque de votre véhicule?",
    modele: "Quel est le modèle de votre véhicule?",
    couleur: "Quelle est la couleur de votre véhicule?",
    motorisation: "Quel est le type de motorisation de votre véhicule?",
    immatriculation:
      "Quelle est votre plaque d'immatriculation? (Information pour les passagers uniquement)",
    recap: "Récapitulatif",
  };

  const handleChoiceClick = useCallback((step: string, value: string) => {
    setFormData((prev) => ({ ...prev, [step]: value }));
    setCurrentStepIndex((prevIndex) =>
      Math.min(prevIndex + 1, steps.length - 1)
    );
  }, []);

  const handleBackClick = useCallback(
    (event: React.MouseEvent<HTMLButtonElement>) => {
      event.preventDefault();
      setCurrentStepIndex((prevIndex) => Math.max(prevIndex - 1, 0));
    },
    []
  );

  const handleSubmit = (event: React.FormEvent) => {
    event.preventDefault();
    window.location.href = "/profil";
  };

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <AnimatePresence mode="wait">
          {steps.map((step, index) =>
            currentStepIndex === index ? (
              <motion.div
                key={step}
                initial={{ opacity: 0, x: 50 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -50 }}
                transition={{ duration: 0.3 }}
              >
                <Step
                  step={step}
                  choices={choices[step]}
                  onSelect={handleChoiceClick}
                  formData={formData}
                  stepTitles={stepTitles}
                />
                {currentStepIndex > 0 && (
                  <button
                    className="vehicule__step-btn"
                    type="button"
                    onClick={handleBackClick}
                  >
                    Précédent
                  </button>
                )}
              </motion.div>
            ) : null
          )}
        </AnimatePresence>
      </form>
    </div>
  );
};

export default Vehicule;
