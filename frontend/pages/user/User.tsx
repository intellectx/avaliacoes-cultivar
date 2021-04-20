import React from 'react';
import MainLayout from "../../components/layout/Main";

const UserPage = () => {
  return (
      <div>Main User page</div>
  );
};

// @ts-ignore
UserPage.layout = page => <MainLayout children={page} title="Usuários" />

export default UserPage;
