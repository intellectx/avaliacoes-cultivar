import React, {useEffect, useState} from 'react';
import Preloader from "../volt-dashboard/Preloader";
import Sidebar from "../volt-dashboard/Sidebar";
import Navbar from "../volt-dashboard/Navbar";
import Footer from "../volt-dashboard/Footer";
import {Breadcrumb, Card, Col, Row} from "@themesberg/react-bootstrap";
import {InertiaLink} from "@inertiajs/inertia-react";
import {APP_ROUTES} from "../../config/routes";

export type BreadcrumbType = {
  text: string,
  href?: string,
  active?: boolean
}

type MainLayoutProps = {
  title: string,
  isLoading?: boolean,
  breadcrumb?: Array<BreadcrumbType>,
  children: React.ReactNode
};

const MainLayout: React.FC<MainLayoutProps> = (props) => {
  const { title = '', isLoading = false, breadcrumb, children } = props;

  useEffect(() => {
    document.title = `${title && title.length > 0 ? title + ' | ' : ''}Avaliações Cultivar`;
  }, [title])

  return (
    <>
      <Preloader show={isLoading}/>
      <Sidebar/>

      <main className="content">
        <Navbar/>

        <div className="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
          <div className="d-block mb-4 mb-md-0">
            { breadcrumb && breadcrumb.length > 0 &&
              <Breadcrumb className="d-none d-md-inline-block" listProps={{ className: "breadcrumb-dark breadcrumb-transparent" }}>
                <Breadcrumb.Item linkAs={InertiaLink} href={APP_ROUTES.DASHBOARD}>Início</Breadcrumb.Item>
                { breadcrumb.map((item, key) => (
                  <Breadcrumb.Item key={key} active={item.active} linkAs={InertiaLink} href={item.href}>
                    {item.text}
                  </Breadcrumb.Item>
                )
              )}
              </Breadcrumb>
            }
            <h4>{ title }</h4>
          </div>
        </div>
        <Row>
          <Col className="mb-4 page-content" xs="12">
            <Card>
              <Card.Body>
                { children }
              </Card.Body>
            </Card>
          </Col>
        </Row>
        <Footer/>
      </main>
    </>
  )
};

export default MainLayout;
