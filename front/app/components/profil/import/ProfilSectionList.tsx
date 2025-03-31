import * as IconProfil from "./profilSvgImport";
// Sections et liens
const sections = [
      {
        title: "Vos trajets",
        items: [
          {
            href: "trajet",
            icon: <IconProfil.IconProfilTrajet />,
            alt: "Horloge",
            title: "Trajet de covoiturage",
          },
          {
            href: "historique",
            icon: <IconProfil.IconProfilHistorique />,
            alt: "Horloge",
            title: "Historique de covoiturage",
          },
          {
            href: "attestation",
            icon: <IconProfil.IconProfilAttestation />,
            alt: "Feuille",
            title: "Attestation de covoiturage",
          },
          {
            href: "vehicule",
            icon: <IconProfil.IconProfilVehicule />,
            alt: "Voiture",
            title: "Véhicule",
            description:
              "Ajoutez-le pour faciliter la rencontre avec vos passagers",
            cta: "Ajouter",
          },
        ],
      },
      {
        title: "Préférences",
        items: [
          {
            href: "info",
            icon: <IconProfil.IconProfilInfo />,
            alt: "Personne",
            title: "Infos personnelles",
          },
          {
            href: "stats",
            icon: <IconProfil.IconProfilStats />,
            alt: "Statistiques",
            title: "Vos statistiques",
          },
          {
            href: "block",
            icon: <IconProfil.IconProfilBlock />,
            alt: "Stop",
            title: "Membres bloqués",
          },
        ],
      },
      {
        title: "Aide",
        items: [
          {
            href: "faq",
            icon: <IconProfil.IconProfilFaq />,
            alt: "Questions",
            title: "Questions fréquentes",
          },
          {
            href: "cgu",
            icon: <IconProfil.IconProfilCgu />,
            alt: "Formulaire",
            title: "Conditions Générales",
          },
          {
            href: "privacy",
            icon: <IconProfil.IconProfilPrivacy />,
            alt: "Cadenas",
            title: "Protection des Données",
          },
          {
            href: "cookies",
            icon: <IconProfil.IconProfilCookies />,
            alt: "Cookie",
            title: "Paramètre des cookies",
          },
        ],
      },
    ];
export default sections;