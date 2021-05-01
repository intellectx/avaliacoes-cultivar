import ptBr from "./pt-br";
import en from "./en";
import {appLanguage} from "../AppComponent";
import {LANGUAGES} from "./LangEnum";

let locale = appLanguage();

export const setLocale = (newLocale: LANGUAGES) => {
  locale = newLocale;
};

export const getLocale = (): LANGUAGES => {
  return locale;
};

export const getLocaleName = (localeCode: LANGUAGES = getLocale()): string => {
  switch (localeCode) {
    case LANGUAGES.EN:
      return lang("languages.en");
    case LANGUAGES.PT_BR:
      return lang("languages.ptBr");
    default:
      throw new Error('Invalid Language');
  }
};

export const lang = (path: string, fallback = ""): string => {
  if (!path) {
    return ''
  }

  return get(messages(locale), path, fallback);
};

const get = (element: any, path: any, fallback: any): any => {
  if (element === undefined) {
    return fallback;
  }

  const search = Array.isArray(path)
    ? path
    : path.split(".").filter((pieces: any) => pieces && pieces.length);

  if (!search.length) {
    return element;
  }

  return get(element[search.shift()], search, fallback);
};

const messages = (locale: LANGUAGES): object => {
  const messages = {
    [LANGUAGES.PT_BR]: ptBr,
    [LANGUAGES.EN]: en
  };

  return messages[locale];
};
