import {
  type RouteConfig,
  index,
  route,
  layout,
} from "@react-router/dev/routes";

export default [
  layout("layouts/LoaderLayout.tsx", [index("RedirectPage.tsx")]),
  layout("layouts/NoneLayout.tsx", [route("login","routes/login/login.tsx")]),
  layout("layouts/MainLayout.tsx", [
    route("home", "routes/home/home.tsx"),
    route("profil", "routes/profil/profil.tsx"),
    route("chat", "routes/chat/chat.tsx"),
  ]),
] satisfies RouteConfig;
