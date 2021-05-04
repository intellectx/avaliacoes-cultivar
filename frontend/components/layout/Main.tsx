import React, {useEffect, useState} from 'react';
import Preloader from "../volt-dashboard/Preloader";
import Sidebar from "../volt-dashboard/Sidebar";
import Navbar from "../volt-dashboard/Navbar";
import Footer from "../volt-dashboard/Footer";
import {Alert, Breadcrumb, Card, Col, Row} from "@themesberg/react-bootstrap";
import {InertiaLink, usePage} from "@inertiajs/inertia-react";
import {APP_ROUTES} from "../../config/routes";
import {BreadcrumbItem} from "../../app/AppTypes";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faBomb, faCheckCircle, faExclamationCircle, faInfoCircle} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";

type MainLayoutProps = {
  title: string,
  children: React.ReactNode,
  isLoading?: boolean,
  breadcrumb?: Array<BreadcrumbItem>,
};

const MainLayout: React.FC<MainLayoutProps> = (props) => {
  const { title = '', isLoading = false, breadcrumb, children } = props;
  // @ts-ignore
  const { flash, user } = usePage().props

  useEffect(() => {
    document.title = `${title && title.length > 0 ? title + ' | ' : ''}Avaliações Cultivar`;
  }, [title])

  return (
    <>
      <Preloader show={isLoading}/>
      <Sidebar/>

      <main className="content">
        <Navbar user={user} />

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
          <Col xs="12">
            {flash.success && (
              <Alert variant="success">
                <FontAwesomeIcon icon={faCheckCircle} className="me-1" />{' '}
                <strong>Tudo certo!</strong> {lang(flash.success)}
              </Alert>
            )}

            {flash.info && (
              <Alert variant="secondary">
                <FontAwesomeIcon icon={faInfoCircle} className="me-1" />{' '}
                {lang(flash.info)}
              </Alert>
            )}

            {flash.warning && (
              <Alert variant="warning">
                <FontAwesomeIcon icon={faExclamationCircle} className="me-1" />{' '}
                <strong>Atenção!</strong> {lang(flash.warning)}
              </Alert>
            )}

            {flash.error && (
              <Alert variant="danger">
                <FontAwesomeIcon icon={faBomb} className="me-1" />{' '}
                <strong>Opss, aconteceu algo de Errado!</strong> {lang(flash.error)}
              </Alert>
            )}
          </Col>
        </Row>
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
