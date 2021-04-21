import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faAngleLeft} from "@fortawesome/free-solid-svg-icons";
import {Col, Row, Form, Card, Button, InputGroup} from '@themesberg/react-bootstrap';
import {AUTH_ROUTES} from "../../config/routes";
import {InertiaLink} from "@inertiajs/inertia-react";
import AuthLayout from "../../components/layout/Auth";
import LoginPage from "./Login";

const ForgotPasswordPage: React.FC = () => {
  return (
    <Row className="justify-content-center">
      <p className="text-center">
        <Card.Link as={InertiaLink} href={AUTH_ROUTES.LOGIN} className="text-gray-700">
          <FontAwesomeIcon icon={faAngleLeft} className="me-2"/> Voltar para Login
        </Card.Link>
      </p>
      <Col xs={12} className="d-flex align-items-center justify-content-center">
        <div
          className="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
          <h3>Esqueceu sua senha?</h3>
          <p className="mb-4">Não se preocupe! Basta digitar seu e-mail e enviaremos um código para redefinir sua
            senha!</p>
          <Form>
            <div className="mb-4">
              <Form.Label htmlFor="email">Informe seu email</Form.Label>
              <InputGroup id="email">
                <Form.Control required autoFocus type="email" placeholder="seu@email.com.br"/>
              </InputGroup>
            </div>
            <Button as={InertiaLink} href={AUTH_ROUTES.RESET_PASSWORD} variant="primary" type="submit"
                    className="w-100">
              Recuperar sua Senha
            </Button>
          </Form>
        </div>
      </Col>
    </Row>
  );
};

// @ts-ignore
ForgotPasswordPage.layout = page => <AuthLayout children={page} title="Identificação" />

export default ForgotPasswordPage;