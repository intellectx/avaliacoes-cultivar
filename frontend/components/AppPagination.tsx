import React from 'react';
import {InertiaLink} from "@inertiajs/inertia-react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faAngleDoubleLeft, faAngleDoubleRight} from "@fortawesome/free-solid-svg-icons";
import {Pagination} from "@themesberg/react-bootstrap";
import {GridPagination} from "../app/AppTypes";

type AppPaginationProps = GridPagination & {
  buttonsUrl: string
}

const AppPagination: React.FC<AppPaginationProps> = (props) => {
  const {buttonsUrl, totalPages, totalItems = 0, currentPage = 1} = props;

  if (totalPages <= 1) {
    return null;
  }

  return (
    <Pagination size='sm' className="mt-3 text-right">
      <Pagination.Prev
        disabled={currentPage === 1}
        as={InertiaLink}
        href={`${buttonsUrl}?page=${currentPage - 1}`}
      >
        <FontAwesomeIcon icon={faAngleDoubleLeft}/>
      </Pagination.Prev>
      {
        [...Array(totalPages)].map((x, pageNumber) => (
          <Pagination.Item
            active={currentPage === (pageNumber + 1)}
            key={pageNumber}
            as={InertiaLink}
            href={`${buttonsUrl}?page=${pageNumber + 1}`}
          >
            {pageNumber + 1}
          </Pagination.Item>
        ))
      }
      <Pagination.Next
        disabled={currentPage === totalPages}
        as={InertiaLink}
        href={`${buttonsUrl}?page=${currentPage + 1}`}
      >
        <FontAwesomeIcon icon={faAngleDoubleRight}/>
      </Pagination.Next>
    </Pagination>
  )
}

export default AppPagination;
