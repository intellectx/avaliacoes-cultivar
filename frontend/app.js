import React from 'react'
import { render } from 'react-dom'

// vendor styles
import "@fortawesome/fontawesome-free/css/all.css";
import "react-datetime/css/react-datetime.css";

// core styles
import "./css/volt-dashboard/volt.scss";
import {InertiaApp} from "@inertiajs/inertia-react";
import { InertiaProgress } from '@inertiajs/progress'
import MainLayout from "./components/layout/Main";
import AuthLayout from "./components/layout/Auth";

InertiaProgress.init({
  delay: 250,
  color: '#29d',
  includeCSS: true,
  showSpinner: true
})

render(
  <React.StrictMode>
    <InertiaApp
      initialPage={JSON.parse(app.dataset.page)}
      resolveComponent={async name => {
        const pageModule = await import(`./pages/${name}`)
        const { default: pageComponent } = pageModule;

        return pageComponent;
      }}
    />
  </React.StrictMode>,
  document.getElementById('app')
)
