import React, {ChangeEvent, useEffect} from 'react';
import MainLayout from "../../components/layout/Main";

import {GROUP_ROUTES} from "../../config/routes";
import {lang} from "../../lang";
import {Col, Form, Row} from "@themesberg/react-bootstrap";
import route from "ziggy-js";
import {useForm} from "@inertiajs/inertia-react";
import {SaveButton} from "../../components/buttons";
import {ContextEnum} from "../../app/AppEnums";
import {BreadcrumbItem, FormProps} from "../../app/AppTypes";

const GroupForm: React.FunctionComponent<FormProps> = (props) => {
  const { record = {}, meta: { context = ContextEnum.DEFAULT } } = props;
  const { data, setData, errors, post, put, processing, hasErrors, clearErrors } = useForm({
    name: '',
    active: true
  });

  function isNewRecord(): boolean {
    return Object.keys(record).length === 0 && context === ContextEnum.CREATE
  }

  useEffect(() => {
    if (!isNewRecord()) {
      setData({ name: String(record.name), active: Boolean(record.active) });
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
          <Col xs={12} sm={12} md={12} lg={6}>
            <Form.Group id="email" className="mb-4">
              <Form.Label>{lang('group.fields.name')}</Form.Label>
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
        </Row>
        <Row>
          <Col xs={12} md={6}>
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
  {text: lang('group.title'), href: GROUP_ROUTES.INDEX},
  {text: lang('general.query'), href: GROUP_ROUTES.INDEX},
  {text: lang('general.createTitle'), active: true},
]

// @ts-ignore
GroupForm.layout = page => (
  <MainLayout children={page} title={lang('group.title')} breadcrumb={breadcrumb}/>
)

export default GroupForm;
