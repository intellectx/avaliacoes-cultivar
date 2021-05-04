import React from 'react';
import MainLayout from "../../components/layout/Main";
import {USER_ROUTES} from "../../config/routes";
import {BreadcrumbItem, QueryPageProps} from "../../app/AppTypes";
import {AddButton, DeleteButton, EditButton} from "../../components/buttons";
import {Card, Table} from "@themesberg/react-bootstrap";
import {lang} from "../../lang";
import {InertiaLink} from "@inertiajs/inertia-react";
import AppPagination from "../../components/AppPagination";

const UserPage: React.FunctionComponent<QueryPageProps<Record<string, unknown>>> = (props) => {
  const { data, pagination } = props;

  return (
    <>
      <AddButton to={USER_ROUTES.CREATE} />
      <Table responsive striped hover className="table-centered table-nowrap rounded mb-0">
        <thead className="thead-light">
        <tr>
          <th className="border-0">{lang('user.fields.name')}</th>
          <th className="border-0" style={{width: '250px'}}>
            {lang('user.fields.group')}
          </th>
          <th className="border-0 text-center" style={{width: '450px'}}>
            {lang('user.fields.email')}
          </th>
          <th className="border-0 text-center" style={{width: '200px'}}>
            {lang('general.createdAt')}
          </th>
          <th className="border-0 text-center" style={{width: '200px', textAlign: 'center'}}>
            {lang('general.actions')}
          </th>
        </tr>
        </thead>
        <tbody>
        {
          data.map(record => {
            const group = record.group as Record<string,string|number>;
            const createdAt = new Date(String(record.created_at));

            return (
              <tr key={Number(record.id)}>
                <td className="fw-bold">
                <Card.Link href="#" as={InertiaLink} className="text-primary fw-bold d-block">
                  {String(record.name)}
                </Card.Link>
                </td>
                <td>{group.name}</td>
                <td className='text-center'>{String(record.email)}</td>
                <td>
                  {`${createdAt.getDay()}/${createdAt.getMonth() + 1}/${createdAt.getFullYear()} ${createdAt.getHours()}:${createdAt.getMinutes()}`}
                </td>
                <td className='text-center'>
                  <EditButton to={USER_ROUTES.UPDATE.replace('{id}', String(record.id))} />
                  <DeleteButton to={USER_ROUTES.DELETE.replace('{id}', String(record.id))} />
                </td>
              </tr>
            )
          })
        }
        </tbody>
      </Table>
      <AppPagination buttonsUrl={USER_ROUTES.INDEX} {...pagination} />
    </>
  );
};

const breadcrumb: Array<BreadcrumbItem> = [
  {text: lang('user.title'), href: USER_ROUTES.INDEX},
  {text: lang('general.query'), active: true},
]

// @ts-ignore
UserPage.layout = page => (
  <MainLayout children={page} title={lang('user.title')} breadcrumb={breadcrumb}/>
)

export default UserPage;
