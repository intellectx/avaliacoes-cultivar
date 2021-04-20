import React from 'react';
import MainLayout from "../../components/layout/Main";

const GroupPage = () => {
  return (
    <div>Main Group page</div>
  );
};

// @ts-ignore
GroupPage.layout = page => <MainLayout children={page} title="Perfis de Acesso" />

export default GroupPage;
