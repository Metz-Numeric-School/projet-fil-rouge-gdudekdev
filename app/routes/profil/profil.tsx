import { useState, useEffect } from "react";
import ProfilActiveSection from "~/components/profil/sections/layout/ProfilActiveSection/ProfilActiveSection";
import ProfilLayout from "~/components/profil/sections/layout/ProfilLayout/ProfilLayout";

const Profil = () => {
  const [activeComponent, setActiveComponent] = useState<string | null>(null);

  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        setActiveComponent(null);
      }
    };
    document.addEventListener("keydown", handleKeyDown);
    return () => document.removeEventListener("keydown", handleKeyDown);
  }, []);

  useEffect(() => {
    document.body.classList.toggle("noscroll", !!activeComponent);
  }, [activeComponent]);

  return (
    <main>
      <div className="profil">
        {activeComponent ? (
          <ProfilActiveSection activeComponent={activeComponent} onClose={() => setActiveComponent(null)} />
        ) : (
          <ProfilLayout onSelect={setActiveComponent} />
        )}
      </div>
    </main>
  );
};

export default Profil;