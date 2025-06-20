const getTimeFromRide = (ride: Rides) => {
  const datetimeStr = ride.instances_departure_time;
  const now = new Date();
  const inputDate = new Date(datetimeStr.replace(" ", "T"));

  const hours = String(inputDate.getHours()).padStart(2, "0");
  const minutes = String(inputDate.getMinutes()).padStart(2, "0");
  const timeOnly = `${hours}:${minutes}`;

  const isToday = inputDate.toDateString() === now.toDateString();

  const tomorrow = new Date(now);
  tomorrow.setDate(now.getDate() + 1);
  const isTomorrow = inputDate.toDateString() === tomorrow.toDateString();
  const options: Intl.DateTimeFormatOptions = {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  };
  const formattedDate = inputDate.toLocaleDateString("fr-FR", options);

  let dateLabel;
  if (isToday) {
    dateLabel = "Aujourd'hui";
  } else if (isTomorrow) {
    dateLabel = "Demain";
  } else {
    dateLabel = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1); 
  }

  return { dateLabel, timeOnly };
};
export {getTimeFromRide};