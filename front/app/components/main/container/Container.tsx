import React from "react";

const Container: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  return (
    <div className="container px-3 sm:px-4 md:px-5 lg:px-6 xl:px-7 2xl:px-8 mx-auto
      w-full sm:w-[540px] md:w-[720px] lg:w-[960px] xl:w-[1140px] 2xl:w-[1320px]">
      {children}
    </div>
  );
};

export default Container;
