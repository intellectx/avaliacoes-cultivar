import React from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";

import {GROUP_ROUTES} from "../../config/routes";
import {Card, Table} from "@themesberg/react-bootstrap";
import {lang} from "../../lang";
import { AddButton, EditButton, DeleteButton } from "../../components/buttons";
import {InertiaLink} from "@inertiajs/inertia-react";
import AppPagination from "../../components/AppPagination";
import {QueryPageProps} from "../../app/AppTypes";

const GroupPage: React.FunctionComponent<QueryPageProps<Record<string, unknown>>> = (props) => {
  const { data, pagination } = props;

  return (
    <>
      <AddButton to={GROUP_ROUTES.CREATE} />
      <Table responsive striped hover className="table-centered table-nowrap rounded mb-0">
        <thead className="thead-light">
        <tr>
          <th className="border-0">{lang('group.fields.name')}</th>
          <th className="border-0" style={{width: '200px', textAlign: 'center'}}>
            {lang('general.actions')}
          </th>
        </tr>
        </thead>
        <tbody>
          {
            data.map(record => (
              <tr key={Number(record.id)}>
                <td className="fw-bold">
                  <Card.Link href="#" as={InertiaLink} className="text-primary fw-bold d-block">
                    {String(record.name)}
                  </Card.Link>
                </td>
                <td className='text-center'>
                  <EditButton to={GROUP_ROUTES.UPDATE.replace('{id}', String(record.id))} />
                  {!record.system_name && <DeleteButton to={GROUP_ROUTES.DELETE.replace('{id}', String(record.id))} />}
                </td>
              </tr>
            ))
          }
        </tbody>
      </Table>
      <AppPagination buttonsUrl={GROUP_ROUTES.INDEX} {...pagination} />
    </>
  );
};

const breadcrumb: Array<BreadcrumbType> = [
  {text: lang('group.title'), href: GROUP_ROUTES.INDEX},
  {text: lang('general.query'), active: true},
]

// @ts-ignore
GroupPage.layout = page => (
  <MainLayout children={page} title={lang('group.title')} breadcrumb={breadcrumb}/>
)

export default GroupPage;
