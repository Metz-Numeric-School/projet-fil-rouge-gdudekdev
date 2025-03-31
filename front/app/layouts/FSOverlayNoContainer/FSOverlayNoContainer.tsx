import Nav from "../../components/main/nav/Nav";

interface FSOverlayNoContainerProps {
  children: React.ReactNode;
  onClose: () => void;
}
const FSOverlayNoContainer = ({
  children,
  onClose,
}: FSOverlayNoContainerProps) => {
  return (
    <div className="profil__fullscreen-overlay">
      <Nav onClose={onClose} />
      <div>
        <div className="profil__fullscreen-content">{children}</div>
      </div>
    </div>
  );
};
export default FSOverlayNoContainer;
