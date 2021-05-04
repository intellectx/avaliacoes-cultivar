export enum APP_ROUTES {
  DASHBOARD = "/dashboard"
}

export enum AUTH_ROUTES {
  LOGIN = "/login",
  FORGOT_PASSWORD = "/forgot-password",
  RESET_PASSWORD = "/reset-password",
  LOGOUT = "logout"
}

export enum GROUP_ROUTES {
  INDEX = "/system/groups",
  CREATE = "/system/groups/create",
  UPDATE = "/system/groups/update/{id}",
}

export enum USER_ROUTES {
  INDEX = "/system/users"
}
