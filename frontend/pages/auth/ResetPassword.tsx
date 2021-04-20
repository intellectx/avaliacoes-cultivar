import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faEnvelope, faUnlockAlt} from "@fortawesome/free-solid-svg-icons";
import {Col, Row, Form, Button, InputGroup} from '@themesberg/react-bootstrap';
import {InertiaLink} from "@inertiajs/inertia-react";
import {AUTH_ROUTES} from "../../config/routes";
import AuthLayout from "../../components/layout/Auth";

const ResetPasswordPage: React.FC = () => {
  return (
    <Row className="justify-content-center">
      <Col xs={12} className="d-flex align-items-center justify-content-center">
        <div className="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
          <h3 className="mb-4">Renovação de Senha</h3>
          <Form>
            <Form.Group id="email" className="mb-4">
              <Form.Label>Seu E-mail</Form.Label>
              <InputGroup>
                <InputGroup.Text>
                  <FontAwesomeIcon icon={faEnvelope}/>
                </InputGroup.Text>
                <Form.Control autoFocus required type="email" placeholder="seu@email.com.br"/>
              </InputGroup>
            </Form.Group>
            <Form.Group id="password" className="mb-4">
              <Form.Label>Sua nova senha</Form.Label>
              <InputGroup>
                <InputGroup.Text>
                  <FontAwesomeIcon icon={faUnlockAlt}/>
                </InputGroup.Text>
                <Form.Control required type="password" placeholder="Sua nova senha..."/>
              </InputGroup>
            </Form.Group>
            <Form.Group id="confirmPassword" className="mb-4">
              <Form.Label>Repita sua senha</Form.Label>
              <InputGroup>
                <InputGroup.Text>
                  <FontAwesomeIcon icon={faUnlockAlt}/>
                </InputGroup.Text>
                <Form.Control required type="password" placeholder="Repita sua senha..."/>
              </InputGroup>
            </Form.Group>
            <Button as={InertiaLink} replace href={AUTH_ROUTES.LOGIN} variant="primary" type="submit" className="w-100">
              Alterar minha senha
            </Button>
          </Form>
        </div>
      </Col>
    </Row>
  );
};

// @ts-ignore
ResetPasswordPage.layout = page => <AuthLayout children={page} title="Identificação" />

export default ResetPasswordPage;
