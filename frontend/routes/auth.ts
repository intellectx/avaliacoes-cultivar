import { IRoute } from "./index";
import Login from "../pages/Login";
import AuthLayout from "../components/layout/Auth";
import ForgotPassword from "../pages/ForgotPassword";
import ResetPassword from "../pages/ResetPassword";

export enum AUTH_ROUTES {
  LOGIN = "/login",
  FORGOT_PASSWORD = "/forgot-password",
  RESET_PASSWORD = "/reset-password",
  LOGOUT = "/logout"
}

const routes: IRoute[] = [
  {
    path: AUTH_ROUTES.LOGIN,
    pageComponent: Login,
    layout: AuthLayout,
    isPublic: true,
    meta: {
      scope: null,
      breadcrumb: []
    }
  },
  {
    path: AUTH_ROUTES.FORGOT_PASSWORD,
    pageComponent: ForgotPassword,
    layout: AuthLayout,
    isPublic: true,
    meta: {
      scope: null,
      breadcrumb: []
    }
  },
  {
    path: AUTH_ROUTES.RESET_PASSWORD,
    pageComponent: ResetPassword,
    isPublic: true,
    layout: AuthLayout,
    meta: {
      scope: null,
      breadcrumb: []
    }
  },
  {
    path: AUTH_ROUTES.LOGOUT,
    pageComponent: ResetPassword,
    isPublic: true,
    layout: AuthLayout,
    meta: {
      scope: null,
      breadcrumb: []
    }
  }
];

export default routes;
