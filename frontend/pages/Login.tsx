import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faEnvelope, faUnlockAlt} from "@fortawesome/free-solid-svg-icons";
import {Button, Card, Col, Form, FormCheck, InputGroup, Row} from "@themesberg/react-bootstrap";
import {Link, useHistory} from "react-router-dom";
import {AUTH_ROUTES} from "../routes/auth";
import {APP_ROUTES} from "../routes/app";

const Login: React.FC = () => {
  let history = useHistory();

  return (
    <Row className="justify-content-center form-bg-image">
      <Col xs={12} className="d-flex align-items-center justify-content-center">
        <div className="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
          <div className="text-center text-md-center mb-4 mt-md-0">
            <h3 className="mb-0">Avaliações Cultivar</h3>
          </div>
          <Form className="mt-4">
            <Form.Group id="email" className="mb-4">
              <Form.Label>E-mail</Form.Label>
              <InputGroup>
                <InputGroup.Text>
                  <FontAwesomeIcon icon={faEnvelope}/>
                </InputGroup.Text>
                <Form.Control autoFocus required type="email" placeholder="seu@email.com.br"/>
              </InputGroup>
            </Form.Group>
            <Form.Group>
              <Form.Group id="password" className="mb-4">
                <Form.Label>Senha</Form.Label>
                <InputGroup>
                  <InputGroup.Text>
                    <FontAwesomeIcon icon={faUnlockAlt}/>
                  </InputGroup.Text>
                  <Form.Control required type="password" placeholder="Sua senha de acesso..."/>
                </InputGroup>
              </Form.Group>
              <div className="d-flex justify-content-between align-items-center mb-4">
                <Form.Check type="checkbox">
                  <FormCheck.Input id="defaultCheck5" className="me-2"/>
                  <FormCheck.Label htmlFor="defaultCheck5" className="mb-0">Lembrar neste PC.</FormCheck.Label>
                </Form.Check>
                <Card.Link as={Link} to={AUTH_ROUTES.FORGOT_PASSWORD} className="small text-end">
                  Esqueceu a senha?
                </Card.Link>
              </div>
            </Form.Group>
            <Button onClick={() => history.replace(APP_ROUTES.DASHBOARD)} variant="primary" type="submit" className="w-100">
              Entrar
            </Button>
          </Form>
        </div>
      </Col>
    </Row>
  )
};

export default Login;
