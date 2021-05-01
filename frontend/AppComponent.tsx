import React from "react";
import {InertiaApp} from "@inertiajs/inertia-react";
import {LANGUAGES, LOCAL_STORAGE_LANG_NAME} from "./lang/LangEnum";

export const appLanguage = (): LANGUAGES => {
  const localStorageLanguage = window.localStorage.getItem(LOCAL_STORAGE_LANG_NAME);

  if (localStorageLanguage) {
    return window.localStorage.getItem(LOCAL_STORAGE_LANG_NAME) as LANGUAGES;
  }

  return LANGUAGES.PT_BR;
};

// @ts-ignore
export const AppComponent = ({ app }) => (
  <React.StrictMode>
    <InertiaApp
      initialPage={JSON.parse(app.dataset.page)}
      resolveComponent={async name => {
        const pageModule = await import(`./pages/${name}`)
        const { default: pageComponent } = pageModule;

        return pageComponent;
      }}
    />
  </React.StrictMode>
)
