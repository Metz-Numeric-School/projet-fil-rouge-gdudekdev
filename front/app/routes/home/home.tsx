import { useEffect, useState } from "react";
import HomeOverlayChoice from "~/components/home/overlay/HomeOverlayChoice/HomeOverlayChoice";
import HomeOverlayTrajet from "~/components/home/overlay/HomeOverlayTrajet/HomeOverlayTrajet";
import ModalHomeTrajet from "~/components/home/modal/modalHomeTrajet/ModalHomeTrajet";
import HomeSection from "~/components/home/sections/HomeSection";
import PlanningHome from "~/components/home/planning/PlanningHome/PlanningHome";
import SectionHome from "~/components/home/import/ImportSectionHome";
import Cookies from "js-cookie";
import { useNavigate } from "react-router";
import { useToken } from "~/context/TokenContext";
import { getAccessToken, getRefreshToken } from "~/utils/api";

// Types
interface HalfDay {
  home: string | null;
  work: string | null;
}

interface HalfDayRideEnabled {
  home: boolean;
  work: boolean;
}

interface PlanningData {
  planning: {
    departure_time: HalfDay[];
    ride_enabled: HalfDayRideEnabled[];
    route_enabled: boolean;
    driver: boolean;
  };
}

const Home = () => {
  const [isOverlayTrajetVisible, setIsOverlayTrajetVisible] = useState(false);
  const [isOverlayChoiceVisible, setIsOverlayChoiceVisible] = useState(false);
  const [isModalHomeTrajetVisible, setIsModalHomeTrajetVisible] =
    useState(false);
  const [loadPlanning, setLoadPlanning] = useState<PlanningData | null>(null);
  const navigate = useNavigate();
  const {token, setToken} = useToken();

  useEffect(() => {
    const loadPlanningData = async () => {
      if(token == null){
        getAccessToken();
      }
      return ;
      try {
        const response = await fetch("http://carpool/index.php?api&query=on&action=get&target=instances", {
          method: "POST",
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        if(response.status == 401){
          console.log("erreur 401");
          getRefreshToken();
        }
        
      } catch (error) {
        console.error("Erreur lors de l'envoi du formulaire :", error);
      }
    };

    loadPlanningData();
  }, []);
  return (
    <div className="home">
      {SectionHome.map((section, index) => (
        <HomeSection key={index} section={section} />
      ))}

      {/* Vérifier si userPlanning est défini avant de le passer */}
      {loadPlanning ? (
        <PlanningHome
          onClickTrajet={() => setIsOverlayTrajetVisible(true)}
          onClickModal={() => setIsModalHomeTrajetVisible(true)}
          onClickChoice={() => setIsOverlayChoiceVisible(true)}
          userPlanning={loadPlanning}
        />
      ) : (
        <div>Chargement des plannings...</div> // Option de fallback en attendant les données
      )}

      {isOverlayTrajetVisible && (
        <HomeOverlayTrajet
          isVisibleCalendar
          onCloseCalendar={() => setIsOverlayTrajetVisible(false)}
        />
      )}
      {isOverlayChoiceVisible && (
        <HomeOverlayChoice
          isVisibleChoice
          onCloseChoice={() => setIsOverlayChoiceVisible(false)}
        />
      )}
      {isModalHomeTrajetVisible && (
        <ModalHomeTrajet
          isVisibleModalHomeTrajet
          onCloseModalHomeTrajet={() => setIsModalHomeTrajetVisible(false)}
        />
      )}
    </div>
  );
};

export default Home;
