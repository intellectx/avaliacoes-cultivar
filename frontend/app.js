import React from 'react'
import { render } from 'react-dom'

// vendor styles
import "@fortawesome/fontawesome-free/css/all.css";
import "react-datetime/css/react-datetime.css";

// core styles
import "./css/volt-dashboard/volt.scss";
import Router from "./components/Router";

render(
  <React.StrictMode>
    <Router />
  </React.StrictMode>,
  document.getElementById('app')
)
