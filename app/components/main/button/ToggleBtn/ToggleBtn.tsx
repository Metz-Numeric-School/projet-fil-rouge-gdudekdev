import { useRef } from "react";

const ToggleBtn = () => {
  const containerRef = useRef<HTMLDivElement>(null);

  const toggleSwitch = () => {
    if (containerRef.current) {
      containerRef.current.classList.toggle("toggle__active");
    }
  };
  return (
    <div ref={containerRef} className="toggle__container" onClick={toggleSwitch}>
      <div className="toggle-circle"></div>
    </div>
  );
};

export default ToggleBtn;