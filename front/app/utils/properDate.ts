const properDate = (date: string) => {
  const inputDate = new Date(date.replace(" ", "T"));
  const options: Intl.DateTimeFormatOptions = {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  };
  let formattedDate = inputDate.toLocaleDateString("fr-FR", options);
  const hours = String(inputDate.getHours()).padStart(2, "0");
  const minutes = String(inputDate.getMinutes()).padStart(2, "0");
  const timeOnly = `${hours}:${minutes}`;
  formattedDate =formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
  return {formattedDate, timeOnly};
};

export default properDate;
