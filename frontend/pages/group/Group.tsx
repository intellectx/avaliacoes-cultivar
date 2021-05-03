import React from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";

import {GROUP_ROUTES} from "../../config/routes";
import {Card, Pagination, Table} from "@themesberg/react-bootstrap";
import {lang} from "../../lang";
import EditButton from "../../components/buttons/EditButton";
import DeleteButton from "../../components/buttons/DeleteButton";
import {InertiaLink} from "@inertiajs/inertia-react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faAngleDoubleLeft, faAngleDoubleRight} from "@fortawesome/free-solid-svg-icons";

type GroupRecord = {
  id: number,
  name: string
}

type GroupPageProps = {
  totalPages: number,
  data: GroupRecord[]
}

const GroupPage: React.FunctionComponent<GroupPageProps> = (props) => {
  const [activeItem, setActiveItem] = React.useState(2);
  const [disablePrev, setDisablePrev] = React.useState(true);
  const [disableNext, setDisableNext] = React.useState(true);
  const { data, totalPages = 5 } = props;

  console.log(data);

  const onPrevItem = () => {
    const prevActiveItem = activeItem === 1 ? activeItem : activeItem - 1;
    setDisablePrev(activeItem === 1);
    setActiveItem(prevActiveItem);
  };

  const onNextItem = (totalPages: number) => {
    const nextActiveItem = activeItem === totalPages ? activeItem : activeItem + 1;
    setDisableNext(activeItem === totalPages);
    setActiveItem(nextActiveItem);
  };

  return (
    <>
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
                  <EditButton to='#' />
                  <DeleteButton to="#" />
                </td>
              </tr>
            ))
          }
        </tbody>
      </Table>
      <Pagination size='sm' className="mt-3 text-right">
        <Pagination.Prev disabled={disablePrev} onClick={onPrevItem}>
          <FontAwesomeIcon icon={faAngleDoubleLeft} />
        </Pagination.Prev>
          {
            [1,2,3,4,5,6,7].map(number => (
              <Pagination.Item
                active={activeItem === number}
                key={number}
                onClick={() => setActiveItem(number)}
              >
                {number}
              </Pagination.Item>
              )
            )
          }
        <Pagination.Next disabled={disableNext} onClick={() => onNextItem(totalPages)}>
          <FontAwesomeIcon icon={faAngleDoubleRight} />
        </Pagination.Next>
      </Pagination>
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
