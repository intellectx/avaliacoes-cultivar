import { IRoute } from "./index";
import Dashboard from "../pages/Dashboard";
import MainLayout from "../components/layout/Main";

export enum APP_ROUTES {
  DASHBOARD = "/dashboard"
}

const routes: IRoute[] = [
  {
    path: APP_ROUTES.DASHBOARD,
    pageComponent: Dashboard,
    layout: MainLayout,
    isPublic: false,
    meta: {
      scope: null,
      breadcrumb: []
    }
  }
];

export default routes;
