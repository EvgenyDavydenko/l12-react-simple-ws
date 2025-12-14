import { type RouteConfig, index, route } from "@react-router/dev/routes";

export default [
  index("routes/_index.tsx"),
  route("login", "routes/login.tsx"),
  route("logout", "routes/logout.tsx"),
  route("dashboard", "routes/dashboard.tsx", [
    index("routes/dashboard.index.tsx"),
  ]),
  // Catch-all for 404 - must be last
  route("*", "routes/$.tsx"),
] satisfies RouteConfig;
