function togglePlanningFields(value) {
  const planningFields = document.getElementById("planning_fields");
  const daysSelector = document.getElementById("days_selector");
  const intervalGroup = document.getElementById("interval_weeks_group");

  if (value === "none") {
    planningFields.style.display = "none";
  } else {
    planningFields.style.display = "block";

    // Afficher ou non la sélection des jours
    daysSelector.style.display = value === "days" ? "block" : "none";

    // Afficher l'intervalle uniquement si pattern_type = days
    intervalGroup.style.display = value === "days" ? "block" : "none";
  }
}
