import React, {useEffect, useState} from 'react';
import Preloader from "../volt-dashboard/Preloader";
import Sidebar from "../volt-dashboard/Sidebar";
import Navbar from "../volt-dashboard/Navbar";
import Footer from "../volt-dashboard/Footer";
import { IRoute } from "../../routes";

export type MainLayoutProps = {
  routeConfig: IRoute
}

const MainLayout: React.FC = (props: any) => {
  const [loaded, setLoaded] = useState(false);

  useEffect(() => {
    const timer = setTimeout(() => setLoaded(true), 2000);
    return () => clearTimeout(timer);
  }, []);

  return (
    <>
      <Preloader show={!loaded}/>
      <Sidebar/>

      <main className="content">
        <Navbar/>
        <div className="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
          <props.routeConfig.pageComponent {...props} />
        </div>
        <Footer/>
      </main>
    </>
  )
};

export default MainLayout;
