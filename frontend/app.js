import { InertiaApp } from '@inertiajs/inertia-react'
import React from 'react'
import { render } from 'react-dom'

// vendor styles
import "@fortawesome/fontawesome-free/css/all.css";
import "react-datetime/css/react-datetime.css";

// core styles
import "./css/volt-dashboard/volt.scss";
import ScrollToTop from "./components/volt-dashboard/ScrollToTop";
import { BrowserRouter } from "react-router-dom";

render(
  <React.StrictMode>
    <BrowserRouter>
      <ScrollToTop />
      <InertiaApp
        initialPage={JSON.parse(app.dataset.page)}
        resolveComponent={name => import(`./pages/${name}`).then(module => module.default)}
      />
    </BrowserRouter>
  </React.StrictMode>,
  document.getElementById('app')
)
