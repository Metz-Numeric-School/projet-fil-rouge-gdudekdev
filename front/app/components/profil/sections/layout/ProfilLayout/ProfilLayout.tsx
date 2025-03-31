import UserProfil from "~/components/profil/sections/layout/ProfilLayout/user/UserProfil";
import ProfilSectionList from "~/components/profil/sections/layout/ProfilLayout/ProfilSectionList/ProfilSectionList";

const ProfilLayout: React.FC<{ onSelect: (href: string) => void }> = ({ onSelect }) => (
  <>
    <UserProfil />
    <ProfilSectionList onSelect={onSelect} />
  </>
);

export default ProfilLayout;
