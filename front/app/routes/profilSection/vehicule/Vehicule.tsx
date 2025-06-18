import React, { useState, useCallback, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { useApi } from "~/hooks/useApi";
import { getTextColorByBackground } from "~/utils/getBrightness";
import { useNavigate } from "react-router";

interface Brands {
  car_brands_id: number;
  car_brands_name: string;
}
interface Models {
  car_models_id: number;
  car_models_name: string;
}
interface Colors {
  car_colors_id: number;
  car_colors_name: string;
}
interface Engines {
  car_engines_id: number;
  car_engines_name: string;
}
interface ImmatriculationPlate {
  immatriculation: string;
}
interface Vehicule {
  brand: Brands | null;
  model: Models | null;
  color: Colors | null;
  engine: Engines | null;
  plate: ImmatriculationPlate | null;
}
interface StepProps {
  step: string;
  choices?: any[];
  stepTitles: { [key: string]: string };
  onSelect: (step: string, choice: string) => void;
  formData: { [key: string]: string };
  displayMethod?: string;
  vehicule: Vehicule;
}

const Step: React.FC<StepProps> = ({
  step,
  choices,
  stepTitles,
  onSelect,
  formData,
  displayMethod = "",
  vehicule,
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
        <div className="mb-[var(--navbar-height)]">
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
                <button
                  className="vehicule__step-btn skippable"
                  onClick={(e) => {
                    e.preventDefault();
                    onSelect(step, inputValue);
                  }}
                >
                  Valider
                </button>
                <button
                  className="vehicule__step-btn skippable"
                  onClick={handleSkip}
                >
                  Passer
                </button>
              </div>
            </div>
          ) : (
            <div className="vehicule__step-choice-list overflow-y-auto overflow-x-hidden mb-[var(--navbar-height)]">
              {choices?.map((choice, index) => {
                const bgColor = choice["car_colors_hexa"] ?? "#0C5832";
                const textColorClass = getTextColorByBackground(bgColor);

                return (
                  <div
                    key={index}
                    onClick={() => onSelect(step, choice)}
                    className={`p-2 rounded-sm w-full cursor-pointer ${textColorClass}`}
                    style={{ backgroundColor: bgColor }}
                  >
                    <p>{choice[displayMethod]}</p>
                  </div>
                );
              })}
            </div>
          )}
        </div>
      ) : (
        <>
          <h2 className="vehicule__step-title">Récapitulatif</h2>
          <div className="vehicule__recap-list">
            <p>Marque : {vehicule.brand?.car_brands_name}</p>
            <p>Modèle : {vehicule.model?.car_models_name}</p>
            <p>Couleur : {vehicule.color?.car_colors_name}</p>
            <p>Motorisation : {vehicule.engine?.car_engines_name}</p>
            <p>
              Plaque d'immatriculation :{" "}
              {vehicule.plate?.immatriculation == ""
                ? "Non fournie"
                : vehicule.plate?.immatriculation}
            </p>
          </div>
          <button className="vehicule__step-btn skippable" type="submit">
            Valider
          </button>
        </>
      )}
    </motion.div>
  );
};

const Vehicule = () => {
  const { apiQuery } = useApi();
  const [currentStepIndex, setCurrentStepIndex] = useState(0);
  const [formData, setFormData] = useState({});
  const navigate = useNavigate();

  const [brands, setBrands] = useState([]);
  const [models, setModels] = useState([]);
  const [engines, setEngines] = useState([]);
  const [colors, setColors] = useState([]);

  const [vehicule, setVehicule] = useState<Vehicule>({
    brand: null,
    model: null,
    color: null,
    engine: null,
    plate: null,
  });

  useEffect(() => {
    const step = steps[currentStepIndex];

    const fetchData = async () => {
      try {
        if (step === "brands" && brands.length === 0) {
          const res = await apiQuery("vehicules", { sub: "brands" });
          console.log(res);
          setBrands(res.response);
        }

        if (step === "models" && models.length === 0 && vehicule.brand) {
          console.log("marque enregistré dans vehicule ", vehicule?.brand);
          const res = await apiQuery("vehicules", {
            sub: "models",
            brand_id: vehicule?.brand.car_brands_id,
          });
          setModels(res.response);
        }

        if (step === "colors" && colors.length === 0) {
          const res = await apiQuery("vehicules", { sub: "colors" });
          setColors(res.response);
        }

        if (step === "engines" && engines.length === 0) {
          const res = await apiQuery("vehicules", { sub: "engines" });
          setEngines(res.response);
        }
      } catch (error) {
        console.error("Erreur de chargement pour l'étape", step, error);
      }
    };
    fetchData();
    console.log(vehicule);
  }, [currentStepIndex, formData, vehicule]);
  // TODO faire en sorte de pouvoir voir les véhicules, les modifier au besoin et de pouvoir en créer de nouveau, il va probablement falloir faire une requete pour voir si il existe deja des véhicules et faire au choix : une redirection vers le composant de création d'un véhicule, une autre vers celui pour voir les véhicules, les composants de création et  de mise a jour sont similaires, avec une valeur de l'état du véhicule prédéfinie dans le second cas
  const steps = [
    "brands",
    "models",
    "colors",
    "engines",
    "immatriculation",
    "recap",
  ];

  const choices: { [key: string]: { data: any; display_method: string } } = {
    brands: { data: brands, display_method: "car_brands_name" },
    models: { data: models, display_method: "car_models_name" },
    colors: { data: colors, display_method: "car_colors_name" },
    engines: { data: engines, display_method: "car_engines_name" },
    immatriculation: { data: "", display_method: "" },
    recap: { data: "", display_method: "" },
  };
  const stepTitles = {
    brands: "Quelle est la marque de votre véhicule?",
    models: "Quel est le modèle de votre véhicule?",
    colors: "Quelle est la couleur de votre véhicule?",
    engines: "Quel est le type de motorisation de votre véhicule?",
    immatriculation:
      "Quelle est votre plaque d'immatriculation? (Information pour les passagers uniquement)",
    recap: "Récapitulatif",
  };

  const handleChoiceClick = useCallback((step: string, value: any) => {
    setVehicule((prev) => {
      const prevVehicule = prev || {};
      switch (step) {
        case "brands":
          return { ...prevVehicule, brand: value };
        case "models":
          return { ...prevVehicule, model: value };
        case "colors":
          return { ...prevVehicule, color: value };
        case "engines":
          return { ...prevVehicule, engine: value };
        case "immatriculation":
          return { ...prevVehicule, plate: { immatriculation: value } };
        default:
          return prevVehicule;
      }
    });
    setCurrentStepIndex((prevIndex) =>
      Math.min(prevIndex + 1, steps.length - 1)
    );
  }, []);

  const handleBackClick = useCallback(
    (event: React.MouseEvent<HTMLButtonElement>) => {
      event.preventDefault();
      setVehicule((prev) => {
        const prevVehicule = prev || {};
        switch (steps[currentStepIndex - 1]) {
          case "brands":
            setModels([]);
            setEngines([]);
            setColors([]);
            return {
              ...prevVehicule,
              brand: null,
              model: null,
              engine: null,
              color: null,
            };
          case "models":
            setEngines([]);
            setColors([]);
            return { ...prevVehicule, model: null, engine: null, color: null };
          case "colors":
            return { ...prevVehicule, color: null };
          case "engines":
            return { ...prevVehicule, engine: null };
          case "immatriculation":
            return { ...prevVehicule, plate: { immatriculation: null } };
          default:
            return prevVehicule;
        }
      });
      setCurrentStepIndex((prevIndex) => Math.max(prevIndex - 1, 0));
    },
    [currentStepIndex]
  );

  const handleSubmit = async (event: React.FormEvent) => {
    event.preventDefault();
    const res = await apiQuery("vehicules/update", { vehicule });
    if (res.response) {
      console.log(res);
      navigate("/profil");
    }
    console.error("Erreur lors de l'ajout du véhicule");
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
                  choices={choices[step].data ?? []}
                  onSelect={handleChoiceClick}
                  formData={formData}
                  stepTitles={stepTitles}
                  displayMethod={choices[step].display_method}
                  vehicule={vehicule}
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
