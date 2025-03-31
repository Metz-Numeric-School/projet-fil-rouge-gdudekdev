import * as section from "../../../import/ProfilSectionImport"

const profilSections: Record<string, React.FC> = {
  historique: section.Historique,
  attestation: section.Attestation,
  vehicule: section.Vehicule,
  info: section.Info,
  stats: section.Stats,
  block: section.Block,
  faq: section.Faq,
  cgu: section.Cgu,
  privacy: section.Privacy,
  cookies: section.Cookies,
  trajet: section.Trajet,
};

export default profilSections;
