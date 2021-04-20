import React, { useState } from "react";
import SimpleBar from 'simplebar-react';
import { CSSTransition } from 'react-transition-group';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faChartPie, faCog, faTimes, faSignOutAlt, faUser, faUsers } from "@fortawesome/free-solid-svg-icons";
import { Nav, Badge, Image, Button, Dropdown, Accordion, Navbar } from '@themesberg/react-bootstrap';
import {InertiaLink} from "@inertiajs/inertia-react";
import {APP_ROUTES, AUTH_ROUTES, GROUP_ROUTES, USER_ROUTES} from "../../config/routes";

export default (props = {}) => {
  const { pathname } = location;
  const [show, setShow] = useState(false);
  const showClass = show ? "show" : "";

  const onCollapse = () => setShow(!show);

  const CollapsableNavItem = (props) => {
    const { eventKey, title, icon, children = null } = props;
    const defaultKey = pathname.indexOf(eventKey) !== -1 ? eventKey : "";

    return (
      <Accordion as={Nav.Item} defaultActiveKey={defaultKey}>
        <Accordion.Item eventKey={eventKey}>
          <Accordion.Button as={Nav.Link} className="d-flex justify-content-between align-items-center">
            <span>
              <span className="sidebar-icon"><FontAwesomeIcon icon={icon} /> </span>
              <span className="sidebar-text">{title}</span>
            </span>
          </Accordion.Button>
          <Accordion.Body className="multi-level">
            <Nav className="flex-column">
              {children}
            </Nav>
          </Accordion.Body>
        </Accordion.Item>
      </Accordion>
    );
  };

  const NavItem = (props) => {
    const { title, link, target, icon, image, badgeText, badgeBg = "secondary", badgeColor = "primary" } = props;
    const classNames = badgeText ? "d-flex justify-content-start align-items-center justify-content-between" : "";
    const navItemClassName = link === pathname ? "active" : "";
    const linkProps = { as: InertiaLink, href: link };

    return (
      <Nav.Item className={navItemClassName} onClick={() => setShow(false)}>
        <Nav.Link {...linkProps} target={target} className={classNames}>
          <span>
            {icon ? <span className="sidebar-icon"><FontAwesomeIcon icon={icon} /> </span> : null}
            {image ? <Image src={image} width={20} height={20} className="sidebar-icon svg-icon" /> : null}

            <span className="sidebar-text">{title}</span>
          </span>
          {badgeText ? (
            <Badge pill bg={badgeBg} text={badgeColor} className="badge-md notification-count ms-2">{badgeText}</Badge>
          ) : null}
        </Nav.Link>
      </Nav.Item>
    );
  };

  return (
    <>
      <Navbar expand={false} collapseOnSelect variant="dark" className="navbar-theme-primary px-4 d-md-none">
        <Navbar.Brand className="me-lg-5" as={InertiaLink} href={APP_ROUTES.DASHBOARD}>
          <Image src='' className="navbar-brand-light" />
        </Navbar.Brand>
        <Navbar.Toggle as={Button} aria-controls="main-navbar" onClick={onCollapse}>
          <span className="navbar-toggler-icon" />
        </Navbar.Toggle>
      </Navbar>
      <CSSTransition timeout={300} in={show} classNames="sidebar-transition">
        <SimpleBar className={`collapse ${showClass} sidebar d-md-block bg-primary text-white`}>
          <div className="sidebar-inner px-4 pt-3">
            <div className="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
              <div className="d-flex align-items-center">
                <div className="user-avatar lg-avatar me-4">
                  <Image src='/images/team/profile-picture-3.jpg' className="card-img-top rounded-circle border-white" />
                </div>
                <div className="d-block">
                  <h6>Hi, Jane</h6>
                  <Button as={InertiaLink} variant="secondary" size="xs" href={''} className="text-dark">
                    <FontAwesomeIcon icon={faSignOutAlt} className="me-2" /> Sign Out
                  </Button>
                </div>
              </div>
              <Nav.Link className="collapse-close d-md-none" onClick={onCollapse}>
                <FontAwesomeIcon icon={faTimes} />
              </Nav.Link>
            </div>
            <Nav className="flex-column pt-3 pt-md-0">
              <NavItem title="Avaliações Cultivar" />

              <NavItem title="Dashboard" link={APP_ROUTES.DASHBOARD} icon={faChartPie} />

              {/*<CollapsableNavItem eventKey="examples/" title="Page Examples" icon={faFileAlt}>
                <NavItem title="Sign In" link={''} />
                <NavItem title="Sign Up" link={''} />
                <NavItem title="Forgot password" link={''} />
                <NavItem title="Reset password" link={''} />
                <NavItem title="Lock" link={''} />
                <NavItem title="404 Not Found" link={''} />
                <NavItem title="500 Server Error" link={''} />
              </CollapsableNavItem>*/}

              <Dropdown.Divider className="my-3 border-indigo" />

              <CollapsableNavItem eventKey="system/" title="Sistema" icon={faCog}>
                <NavItem title="Usuários" icon={faUser} link={USER_ROUTES.INDEX} />
                <NavItem title="Perfis de Acesso" icon={faUsers} link={GROUP_ROUTES.INDEX} />
              </CollapsableNavItem>
              <NavItem title="Sair" link={AUTH_ROUTES.LOGIN} icon={faSignOutAlt} />
            </Nav>
          </div>
        </SimpleBar>
      </CSSTransition>
    </>
  );
};
