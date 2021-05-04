import React, {ChangeEvent, FormEvent, useEffect} from 'react';
import MainLayout from "../../components/layout/Main";

import {lang} from "../../lang";
import {Col, Form, Row} from "@themesberg/react-bootstrap";
import route from "ziggy-js";
import {useForm} from "@inertiajs/inertia-react";
import {SaveButton} from "../../components/buttons";
import {ContextEnum} from "../../app/AppEnums";
import {BreadcrumbItem, FormProps} from "../../app/AppTypes";
import {USER_ROUTES} from "../../config/routes";

type UserFormProps = FormProps & {
  groups: Record<string, unknown>[]
}

const UserForm: React.FunctionComponent<UserFormProps> = (props) => {
  const {
    record = {},
    groups = [],
    meta: { context = ContextEnum.DEFAULT }
  } = props;

  const { data, setData, errors, post, put, processing, hasErrors, clearErrors } = useForm({
    name: '',
    email: '',
    groupId: '',
    password: '',
    passwordConfirmation: '',
    active: true
  });

  function isNewRecord(): boolean {
    return Object.keys(record).length === 0 && context === ContextEnum.CREATE
  }

  useEffect(() => {
    if (!isNewRecord()) {
      setData({
        name: String(record.name),
        email: String(record.email),
        groupId: String(record.group_id),
        password: '',
        passwordConfirmation: '',
        active: Boolean(record.active)
      });
    }
  }, []);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    clearErrors();

    if (!isNewRecord()) {
      await put(route('groups-update', { id: Number(record.id) }));
      return;
    }

    await post(route('groups-create'));
  }

  return (
    <>
      <Form onSubmit={handleSubmit}>
        <Row>
          <Col xs={12} sm={12} md={12} lg={4}>
            <Form.Group id="name">
              <Form.Label>{lang('user.fields.name')}</Form.Label>
              <Form.Control
                autoFocus
                disabled={processing}
                isInvalid={hasErrors}
                name="name"
                value={data.name}
                onChange={e => setData('name', e.target.value)}
              />
              <Form.Control.Feedback type="invalid">{ lang((errors.name)) }</Form.Control.Feedback>
            </Form.Group>
          </Col>
          <Col xs={12} sm={12} md={12} lg={4}>
            <Form.Group id="email">
              <Form.Label>{lang('user.fields.email')}</Form.Label>
              <Form.Control
                disabled={processing}
                isInvalid={hasErrors}
                name="email"
                value={data.email}
                onChange={e => setData('email', e.target.value)}
              />
              <Form.Control.Feedback type="invalid">{ lang((errors.email)) }</Form.Control.Feedback>
            </Form.Group>
          </Col>
          <Col xs={12} sm={12} md={12} lg={4}>
            <Form.Group id="group_id">
              <Form.Label>{lang('user.fields.group')}</Form.Label>
              <Form.Select
                name="groupId"
                onChange={(e: React.ChangeEvent<HTMLSelectElement>) => setData('groupId', e.target.value)}
                disabled={processing}
                isInvalid={hasErrors}
              >
                <option>{lang('general.defaultSelectOption')}</option>
                {
                  groups.map(group => <option value={Number(group.id)}>{String(group.name)}</option>)
                }
              </Form.Select>
              <Form.Control.Feedback type="invalid">{ lang((errors.groupId)) }</Form.Control.Feedback>
            </Form.Group>
          </Col>
        </Row>
        <Row>
          <Col xs={3} className='mt-3'>
            <Form.Group id="password">
              <Form.Label>{lang('user.fields.password')}</Form.Label>
              <Form.Control
                type='password'
                disabled={processing}
                isInvalid={hasErrors}
                name="password"
                value={data.password}
                onChange={e => setData('password', e.target.value)}
              />
              <Form.Control.Feedback type="invalid">{ lang((errors.password)) }</Form.Control.Feedback>
            </Form.Group>
          </Col>
          <Col xs={3} className='mt-3'>
            <Form.Group id="passwordConfirmation">
              <Form.Label>{lang('user.fields.passwordConfirmation')}</Form.Label>
              <Form.Control
                type='password'
                disabled={processing}
                isInvalid={hasErrors}
                name="passwordConfirmation"
                value={data.passwordConfirmation}
                onChange={e => setData('passwordConfirmation', e.target.value)}
              />
              <Form.Control.Feedback type="invalid">{ lang((errors.passwordConfirmation)) }</Form.Control.Feedback>
            </Form.Group>
          </Col>
        </Row>
        <Row>
          <Col xs={12} md={6} className='mt-4'>
            <Form.Check
              checked={data.active}
              disabled={processing}
              id='active'
              type="checkbox"
              onChange={(e: ChangeEvent<HTMLInputElement>) => setData('active', e.target.checked)}
              label={lang('general.activeLabel')}
            />
          </Col>
        </Row>
        <Row>
          <Col xs={12} className='mt-4'>
            <SaveButton context={context} loading={processing} />
          </Col>
        </Row>
      </Form>
    </>
  );
};

const breadcrumb: Array<BreadcrumbItem> = [
  {text: lang('user.title'), href: USER_ROUTES.INDEX},
  {text: lang('general.query'), href: USER_ROUTES.INDEX},
  {text: lang('general.createTitle'), active: true},
]

// @ts-ignore
UserForm.layout = page => (
  <MainLayout children={page} title={lang('user.title')} breadcrumb={breadcrumb}/>
)

export default UserForm;
