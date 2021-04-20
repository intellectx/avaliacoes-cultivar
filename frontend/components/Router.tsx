import React from 'react';
import { BrowserRouter, Switch, Route } from "react-router-dom";

import routes from "../routes";

const Router: React.FC = () => {
  return (
    <BrowserRouter>
      <Switch>
        {
          routes.map(route =>
            <Route
              key={route.path}
              path={route.path}
              exact
              render={(props: any) => (
                <route.layout { ...props } routeConfig={route} />
              )}
            />
          )
        }
      </Switch>
    </BrowserRouter>
  );
};

export default Router;
