import { useState, useCallback } from "react";

export const useHome = () => {
  const [isPlanning, setIsPlanning] = useState(false);
  const [isRideChoice, setIsRideChoice] = useState(false);
  const [isRideSettings, setIsRideSettings] = useState(false);

  const openPlanning = useCallback(() => setIsPlanning(true), []);
  const closePlanning = useCallback(() => setIsPlanning(false), []);

  const openRideChoice = useCallback(() => setIsRideChoice(true), []);
  const closeRideChoice = useCallback(() => setIsRideChoice(false), []);

  const openRideSettings = useCallback(() => setIsRideSettings(true), []);
  const closeRideSettings = useCallback(() => setIsRideSettings(false), []);

  return {
    isPlanning,
    openPlanning,
    closePlanning,
    isRideChoice,
    openRideChoice,
    closeRideChoice,
    isRideSettings,
    openRideSettings,
    closeRideSettings,
  };
};
