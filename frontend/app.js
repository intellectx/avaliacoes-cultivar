import React from 'react'
import { render } from 'react-dom'

// vendor styles
import "@fortawesome/fontawesome-free/css/all.css";
import "react-datetime/css/react-datetime.css";

// core styles
import "./css/volt-dashboard/volt.scss";
import { InertiaApp } from "@inertiajs/inertia-react";
import { InertiaProgress } from '@inertiajs/progress'

import { LANGUAGES, LOCAL_STORAGE_LANG_NAME } from "./lang";
import { AppComponent } from "./AppComponent";

InertiaProgress.init({
  delay: 250,
  color: '#29d',
  includeCSS: true,
  showSpinner: true
})

render(
  <AppComponent app={app} />,
  document.getElementById('app')
)
