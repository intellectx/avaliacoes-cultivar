import React from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";

import {GROUP_ROUTES} from "../../config/routes";
import {Button, Card, Pagination, Table} from "@themesberg/react-bootstrap";
import {lang} from "../../lang";
import EditButton from "../../components/buttons/EditButton";
import DeleteButton from "../../components/buttons/DeleteButton";
import {InertiaLink} from "@inertiajs/inertia-react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faAngleDoubleLeft, faAngleDoubleRight, faPlusCircle} from "@fortawesome/free-solid-svg-icons";

type GroupRecord = {
  id: number,
  name: string,
  system_name?: string
}

type GridPagination = {
  totalItems: number,
  totalPages: number,
  currentPage: number
}

type GroupPageProps = {
  data: GroupRecord[]
  pagination: GridPagination
}

const GroupPage: React.FunctionComponent<GroupPageProps> = (props) => {
  const { data, pagination: { totalPages, totalItems = 0, currentPage = 1 }} = props;

  return (
    <>
      <Button as={InertiaLink} href={GROUP_ROUTES.CREATE} variant="primary" className="mb-4">
        <FontAwesomeIcon icon={faPlusCircle} className="me-2" /> {lang('general.addButton')}
      </Button>
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
              <tr key={record.id}>
                <td className="fw-bold">
                  <Card.Link href="#" as={InertiaLink} className="text-primary fw-bold d-block">
                    {record.name}
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
      { totalPages > 1 &&
        <Pagination size='sm' className="mt-3 text-right">
          <Pagination.Prev
            disabled={currentPage === 1}
            as={InertiaLink}
            href={`${GROUP_ROUTES.INDEX}?page=${currentPage - 1}`}
          >
            <FontAwesomeIcon icon={faAngleDoubleLeft} />
          </Pagination.Prev>
          {
            [...Array(totalPages)].map((x, pageNumber) => (
              <Pagination.Item
                active={currentPage === (pageNumber + 1)}
                key={pageNumber}
                as={InertiaLink}
                href={`${GROUP_ROUTES.INDEX}?page=${pageNumber + 1}`}
              >
                {pageNumber + 1}
              </Pagination.Item>
            ))
          }
          <Pagination.Next
            disabled={currentPage === totalPages}
            as={InertiaLink}
            href={`${GROUP_ROUTES.INDEX}?page=${currentPage + 1}`}
          >
            <FontAwesomeIcon icon={faAngleDoubleRight} />
          </Pagination.Next>
        </Pagination>
      }
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
