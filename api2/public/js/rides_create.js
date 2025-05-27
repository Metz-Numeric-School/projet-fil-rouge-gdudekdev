const seats = document.getElementById("seats");
const seats_title = seats.previousElementSibling;
const position_checkbox = document.getElementById("rides_position");


seats.style.display = "none";
seats_title.style.display = "none";

position_checkbox.addEventListener("change", () => {
  if (position_checkbox.checked) {
    seats.style.display = "block";
    seats_title.style.display = "block";
  } else {
    seats.style.display = "none";
    seats_title.style.display = "none";
  }
});
function toggleSeats(event) {
  seats.style.display = none;
  console.log(seats);
}

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
