import CtaRightArrow from "~/src/assets/icon/cta/CtaRightArrow";

interface NavProps {
  onClose: () => void;
}
const Nav = ({ onClose }: NavProps) => {
  console.log("Rendering Nav");
  return (
    <header>
      <nav className="navbar">
        <div className="navbar__header">
          <div className="navbar__back">
            <div className="navbar__close-button" onClick={onClose}>
              <CtaRightArrow />
            </div>
          </div>
        </div>
      </nav>
    </header>
  );
};

export default Nav;
