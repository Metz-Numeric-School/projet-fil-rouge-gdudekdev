import { useEffect, useState } from "react";
import { useNavigate } from "react-router";
import { useApi } from "~/hooks/useApi";
import FSOverlay from "~/layouts/FSOverlay/FSOverlay";

const TrajetDetail = ({ id }: { id: number }) => {
   const [trajet, setTrajet] = useState<Trajet>();
  const navigate = useNavigate();
  const onCloseTrajetDetail = () => {
    navigate("/profil/trajet");
  };
   const { apiQuery } = useApi();
    useEffect(() => {
      async function fetchTrajet() {
        try {
          const result = await apiQuery("rides");
          if (result?.response) {
            console.log(result.response);
            setTrajet(result.response);
          }
        } catch (error) {
          navigate('/login');
          console.error("Erreur lors du chargement du planning :", error);
        }
      }
      fetchTrajet();
    }, []);
  return (
    <FSOverlay
      children={<TrajetDetailComponent trajet={trajet} />}
      onClose={onCloseTrajetDetail}
    />
  );
};

const TrajetDetailComponent = ({ trajet }: { trajet: Trajet }) => {
  return(
      <p>trajetdetailComponent</p>
  );
};
export default TrajetDetail;
