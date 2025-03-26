import { Link } from "react-router"

interface BtnPrimaryProps {
  txt: string;
  path: string;
}
/**
 * @params txt : Contenu du bouton
 * @params path: Chemin de redirection du bouton
 */
const BtnPrimary = ({ txt, path }: BtnPrimaryProps) => {
      return(
            <>
            <Link to={path} className="btnprimary">
            <p>{txt}</p>
            </Link> 
            </>
      )
}
export default BtnPrimary;