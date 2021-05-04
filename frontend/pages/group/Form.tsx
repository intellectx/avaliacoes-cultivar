import React, {ChangeEvent, useEffect} from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";

import {GROUP_ROUTES} from "../../config/routes";
import {lang} from "../../lang";
import {Col, Form, Row} from "@themesberg/react-bootstrap";
import route from "ziggy-js";
import {useForm} from "@inertiajs/inertia-react";
import SaveButton, {ContextEnum} from "../../components/buttons/SaveButton";

type MetaData = {
  context: ContextEnum
}

type GroupRecord = {
  id: number,
  name: string,
  active: boolean
  system_name?: string,
}

type GroupFormProps = {
  record?: GroupRecord,
  meta: MetaData
}

const GroupForm: React.FunctionComponent<GroupFormProps> = (props) => {
  const { record, meta: { context = ContextEnum.DEFAULT } } = props;
  const { data, setData, errors, post, put, processing, hasErrors, clearErrors } = useForm({
    name: '',
    active: true
  });

  useEffect(() => {
    if (context === ContextEnum.UPDATE && record !== undefined) {
      setData({ name: record.name, active: record.active });
    }
  }, []);

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    clearErrors();

    if (context === ContextEnum.UPDATE && record !== undefined) {
      await put(route('groups-update', { id: record.id }));
      return;
    }

    await post(route('groups-create'));
  }

  return (
    <>
      <Form onSubmit={handleSubmit}>
        <Row>
          <Col xs={6}>
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
          <Col xs={6}>
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

const breadcrumb: Array<BreadcrumbType> = [
  {text: lang('group.title'), href: GROUP_ROUTES.INDEX},
  {text: lang('general.query'), href: GROUP_ROUTES.INDEX},
  {text: lang('general.createTitle'), active: true},
]

// @ts-ignore
GroupForm.layout = page => (
  <MainLayout children={page} title={lang('group.title')} breadcrumb={breadcrumb}/>
)

export default GroupForm;
