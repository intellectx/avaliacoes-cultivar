import React, {ChangeEvent} from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faSignInAlt} from "@fortawesome/free-solid-svg-icons";
import {Button, Card, Col, Form, FormCheck, InputGroup, Row} from "@themesberg/react-bootstrap";
import {AUTH_ROUTES} from "../../config/routes";
import {InertiaLink} from "@inertiajs/inertia-react";
import AuthLayout from "../../components/layout/Auth";
import { useForm } from '@inertiajs/inertia-react';
import route from 'ziggy-js';
import {lang} from "../../lang";

const LoginPage: React.FC = () => {
  const { data, setData, errors, post, processing, hasErrors, clearErrors } = useForm({
    email: '',
    password: '',
    remember: false
  });

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    clearErrors();
    await post(route('login'));
  }

  return (
    <Row className="justify-content-center form-bg-image">
      <Col xs={12} className="d-flex align-items-center justify-content-center">
        <div className="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
          <div className="text-center text-md-center mb-4 mt-md-0">
            <h3 className="mb-0">Avaliações Cultivar</h3>
          </div>
          <Form className="mt-4" onSubmit={handleSubmit}>
            <Form.Group id="email" className="mb-4">
              <Form.Label>E-mail</Form.Label>
              <Form.Control
                autoFocus
                disabled={processing}
                isInvalid={hasErrors}
                type="email"
                name="email"
                placeholder="seu@email.com.br"
                value={data.email}
                onChange={e => setData('email', e.target.value)}
              />
              <Form.Control.Feedback type="invalid">{ lang((errors.email)) }</Form.Control.Feedback>
            </Form.Group>
            <Form.Group>
              <Form.Group id="password" className="mb-4">
                <Form.Label>Senha</Form.Label>
                <Form.Control
                  type="password"
                  disabled={processing}
                  isInvalid={hasErrors}
                  name="password"
                  placeholder="Sua senha de acesso..."
                  value={data.password}
                  onChange={e => setData('password', e.target.value)}
                />
                <Form.Control.Feedback type="invalid">{ lang((errors.password)) }</Form.Control.Feedback>
              </Form.Group>
              <div className="d-flex justify-content-between align-items-center mb-4">
                <Form.Check type="checkbox">
                  <FormCheck.Input
                    id="remember"
                    disabled={processing}
                    className="me-2"
                    onChange={(e: ChangeEvent<HTMLInputElement>) => setData('remember', e.target.checked)}
                  />
                  <FormCheck.Label htmlFor="remember" className="mb-0">Lembrar neste PC.</FormCheck.Label>
                </Form.Check>
                <Card.Link as={InertiaLink} href={AUTH_ROUTES.FORGOT_PASSWORD} className="small text-end">
                  Esqueceu a senha?
                </Card.Link>
              </div>
            </Form.Group>
            <Button variant="primary" disabled={processing} type="submit" className="w-100">
                Entrar <FontAwesomeIcon icon={faSignInAlt} className="me-2" />
            </Button>
          </Form>
        </div>
      </Col>
    </Row>
  )
};

// @ts-ignore
LoginPage.layout = page => <AuthLayout children={page} title="Identificação" />

export default LoginPage;
