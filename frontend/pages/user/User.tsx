import React from 'react';
import MainLayout from "../../components/layout/Main";
import {USER_ROUTES} from "../../config/routes";
import {BreadcrumbItem} from "../../app/AppTypes";

const UserPage = () => {
  return (
      <div>Main User page</div>
  );
};

const breadcrumb: Array<BreadcrumbItem> = [
  { text: 'Usuários', href: USER_ROUTES.INDEX },
  { text: 'Listagem', active: true },
]

// @ts-ignore
UserPage.layout = page => <MainLayout children={page} breadcrumb={breadcrumb} title="Usuários" />

export default UserPage;
