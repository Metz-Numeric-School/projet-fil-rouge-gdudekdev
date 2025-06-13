import { useEffect, useState } from "react";
import { useNavigate, useParams } from "react-router";

import FSOverlay from "~/layouts/FSOverlay/FSOverlay";
import Attestation from "./attestation/Attestation";
import Block from "./block/Block";
import Cgu from "./cgu/Cgu";
import Cookies from "./cookies/Cookies";
import Faq from "./faq/Faq";
import Historique from "./historique/Historique";
import Info from "./info/Info";
import Stats from "./stats/Stats";
import Trajet from "./trajet/Trajet";
import Vehicule from "./vehicule/Vehicule";

const SectionComponents = {
  attestation: <Attestation />,
  block: <Block />,
  cgu: <Cgu />,
  cookies: <Cookies />,
  faq: <Faq />,
  historique: <Historique />,
  info: <Info />,
  stats: <Stats />,
  trajet: <Trajet />,
  vehicule: <Vehicule />,
};

const ProfilSection = () => {
  const { section } = useParams();
  const navigate = useNavigate();

  const onSectionClose = () => {
    navigate("/profil");
  };

  return (
    <FSOverlay
      children={
        SectionComponents[section as keyof typeof SectionComponents] || null
      }
      onClose={onSectionClose}
    />
  );
};

export default ProfilSection;
