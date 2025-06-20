import {
  type RouteConfig,
  index,
  route,
  layout,
} from "@react-router/dev/routes";

export default [
  layout("layouts/LoaderLayout.tsx", [index("RedirectPage.tsx")]),
  layout("layouts/LoginLayout.tsx", [route("login", "routes/login/login.tsx")]),
  layout("layouts/ProtectedLayout.tsx", [
    route("home", "routes/home/home.tsx"),
    route("profil", "routes/profil/profil.tsx"),
    route("profil/:section", "routes/profilSection/ProfilSection.tsx"),
    route("chat", "routes/chat/chat.tsx"),
    route("ride/:id", "routes/ride/ride.tsx"),
    route("profil/trajet/:param","routes/profilSection/trajet/Trajet.tsx"),
  ]),
] satisfies RouteConfig;
