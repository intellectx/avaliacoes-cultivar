import React from 'react';
import MainLayout, {BreadcrumbType} from "../../components/layout/Main";
import {GROUP_ROUTES} from "../../config/routes";

const GroupPage = () => {
  return (
    <div>Main Group page</div>
  );
};

const breadcrumb: Array<BreadcrumbType> = [
  { text: 'Perfis de Acesso', href: GROUP_ROUTES.INDEX },
  { text: 'Listagem', active: true },
]

// @ts-ignore
GroupPage.layout = page => <MainLayout children={page} title="Perfis de Acesso" breadcrumb={breadcrumb} />

export default GroupPage;
