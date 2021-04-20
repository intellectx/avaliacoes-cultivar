import React from 'react'
import { render } from 'react-dom'

// vendor styles
import "@fortawesome/fontawesome-free/css/all.css";
import "react-datetime/css/react-datetime.css";

// core styles
import "./css/volt-dashboard/volt.scss";
import {InertiaApp} from "@inertiajs/inertia-react";
import { InertiaProgress } from '@inertiajs/progress'

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
      resolveComponent={name =>
        import(`./pages/${name}`).then(module => module.default)
      }
    />,
  </React.StrictMode>,
  document.getElementById('app')
)
