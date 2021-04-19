import React, {useEffect, useState} from 'react';
import {BrowserRouter, Switch, Route, RouteProps} from "react-router-dom";

import Login from "../pages/Login";
import ForgotPassword from "../pages/ForgotPassword";
import ResetPassword from "../pages/ResetPassword";
import Preloader from "./volt-dashboard/Preloader";
import Footer from "./volt-dashboard/Footer";
import Dashboard from "../pages/Dashboard";
import Sidebar from "./volt-dashboard/Sidebar";
import Navbar from "./volt-dashboard/Navbar";

const Router: React.FC = () => {
  return (
    <BrowserRouter>
      <Switch>
        <RouteWithSidebar path="/dashboard" exact component={Dashboard}/>
        <RouteWithSidebar path="/login" exact component={Login}/>
        <RouteWithSidebar path="/forgot-password" exact component={ForgotPassword}/>
        <RouteWithSidebar path="/reset-password" exact component={ResetPassword}/>
      </Switch>
    </BrowserRouter>
  );
};

const RouteWithSidebar = ({component, ...rest}: RouteProps) => {
  const [loaded, setLoaded] = useState(false);

  useEffect(() => {
    const timer = setTimeout(() => setLoaded(true), 2000);
    return () => clearTimeout(timer);
  }, []);

  const localStorageIsSettingsVisible = () => {
    return localStorage.getItem('settingsVisible') !== 'false'
  }

  const [showSettings, setShowSettings] = useState(localStorageIsSettingsVisible);

  const toggleSettings = () => {
    setShowSettings(!showSettings);
    localStorage.setItem('settingsVisible', String(!showSettings));
  }

  const PageComponent = component as React.ElementType;

  return (
    <Route {...rest} render={props => (
      <>
        <Preloader show={!loaded}/>
        <Sidebar />

        <main className="content">
          <Navbar />
          <div className="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <PageComponent {...props} />
          </div>
          <Footer toggleSettings={toggleSettings} showSettings={showSettings} />
        </main>
      </>
    )} />
  );
};

export default Router;
