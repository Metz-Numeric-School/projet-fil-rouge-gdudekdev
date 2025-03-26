type ClassValue = string | { [key: string]: boolean };

const classNames = (...classes: ClassValue[]): string => {
  return classes
    .map((cls) => {
      if (typeof cls === "string") {
        return cls;
      }

      if (typeof cls === "object") {
        return Object.entries(cls)
          .filter(([, value]) => value)
          .map(([key]) => key)
          .join(" ");
      }

      return "";
    })
    .filter(Boolean)
    .join(" ");
};

export default classNames;