import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";
import BtnPrimary from "~/components/main/button/BtnPrimary/BtnPrimary";
import { useNavigate, useParams } from "react-router";
import TrajetDetail from "./TrajetDetail/TrajetDetail";

const TrajetItem = ({ trajet_id,onClick}: { trajet_id: number,onClick : (id:number)=> void }) => {
  return (
    <div
      className=" flex justify-between items-center w-full border hover:cursor-pointer hover:translate-x-0.5 hover:transition-all border-gray-300 rounded-md p-3 mb-2 gap-4"
      onClick={()=>onClick(trajet_id)}
    >
      <div className="flex-col w-full gap-5">
        <div className="">
          <div className="flex w-full justify-between">
            <h4>Adresse Départ - Adresse Arrivée</h4>
          </div>
          <div className="flex w-full justify-between items-center">
            <p className="text-sm text-gray-400">Tous les jours</p>
          </div>
        </div>
      </div>
      <div className="trajet__adress-right-cta-svg ml-4">
        <CtaRightArrow />
      </div>
    </div>
  );
};
// TODO faire une requete directement sur tous les trajets définis par l'utilisateur, les mettre dans une variable d'état et la passer via un props dans le detail, enlever donc la route trajet/{id}, elle n'est plus pertinente ici mais plutot faire afficher le bon trajet via FSOverlay au moment ou en a besoin pour afficher le détail, passer en props a ce moment la 
// TODO faire le reste des routes : les différentes réservations liées à un trajet pour les accepter et les refuser, faire le formulaire pour charger les adresses et les stocker en bdd si nécessaire, faire en sorte de stocker les adresses a un endroit pour l'utilisateur, qu'il puisse les supprimer si nécessaire, faire de l'autocomplétion sur les adresses et les stocker à la fois en latitude longitude et en clair pour le montrer a l'utilisateur, le relier via un identifiant et créer un type correspondant à un itinéraire (départ arrivé et sens de direction, avec la longitude et latitude pour chaque données), finir la partie de présentation des trajets disponible, mettre dans le formualrie un moyen de créer des planifications mais aussi de le modifier dans les détails, le reste est facultatif, faire en sorte de pouvoir afficher la carte concernant un itinéraire et de génerer des itinéraires plus complet comprenant différents point de ralliement entre les utilsiateurs et le conducteur, permettre, au fur et  a mesure, de pouvoir voir le trajet qui se complete, previsualisation , ça fait BEAUCOUP de choses a faire pour rendre le tout vraiment pertinent mais c'est faisable
const Trajet = () => {
  const {id} = useParams();

  if(id!=null){
    return(
      <TrajetDetail id={1} />
    )
  }
  const navigate = useNavigate();
  const openRideDetail = (id:number) => {
    navigate(`/profil/trajet/${id}`);
  };
  return (
    <div className="trajet">
      <div className="flex w-full justify-between">
        <h2>Mes Trajets</h2>
        <BtnPrimary txt="Ajouter un trajet" path="" />
      </div>
      <div className="trajet__content flex-col mt-4">
        <TrajetItem trajet_id={1} onClick={openRideDetail}/>
      </div>
    </div>
  );
};

export default Trajet;
