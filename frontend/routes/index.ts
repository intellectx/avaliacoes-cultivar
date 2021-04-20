import React from "react";
import auth from "./auth";
import app from "./app";

export type IRoute = {
  path: string;
  layout: React.FC;
  pageComponent: React.FC;
  isPublic: boolean;
  meta: object;
}

export enum SCOPES {
  CREATE = "create",
  UPDATE = "update"
}

const routes: IRoute[] = auth.concat(app);

export default routes;
