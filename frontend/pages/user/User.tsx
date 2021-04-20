import React from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";
import {USER_ROUTES} from "../../config/routes";

const UserPage = () => {
  return (
      <div>Main User page</div>
  );
};

const breadcrumb: Array<BreadcrumbType> = [
  { text: 'Usuários', href: USER_ROUTES.INDEX },
  { text: 'Listagem', active: true },
]

// @ts-ignore
UserPage.layout = page => <MainLayout children={page} breadcrumb={breadcrumb} title="Usuários" />

export default UserPage;
