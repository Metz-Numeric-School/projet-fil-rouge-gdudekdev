import React, { useEffect } from "react";
import { useNavigate, useLocation } from "react-router-dom";
import Loader from "./components/main/loader/Loader";

const RedirectPage = () => {
  const navigate = useNavigate();
  const location = useLocation();

  const searchParams = new URLSearchParams(location.search);
  const path = searchParams.get("path") || "/login"; 
  useEffect(() => {
    const timer = setTimeout(() => {
      navigate(path); 
    }, 2000);

    return () => clearTimeout(timer);
  }, [navigate, path]);

  return (
    <div className="flex items-center justify-center min-h-screen">
      <Loader />
    </div>
  );
};

export default RedirectPage;
