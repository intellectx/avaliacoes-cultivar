import React, {useEffect, useState} from 'react';
import Preloader from "../volt-dashboard/Preloader";
import Sidebar from "../volt-dashboard/Sidebar";
import Navbar from "../volt-dashboard/Navbar";
import Footer from "../volt-dashboard/Footer";
import { Breadcrumb } from "@themesberg/react-bootstrap";

const MainLayout: React.FC = (props) => {
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
          <Breadcrumb className="d-none d-md-inline-block" listProps={{ className: "breadcrumb-dark breadcrumb-transparent" }}>
            <Breadcrumb.Item>Home</Breadcrumb.Item>
            <Breadcrumb.Item>Volt</Breadcrumb.Item>
            <Breadcrumb.Item active>Transactions</Breadcrumb.Item>
          </Breadcrumb>
          <h4>Usuários</h4>
        </div>
        { props.children }
        <Footer/>
      </main>
    </>
  )
};

export default MainLayout;
