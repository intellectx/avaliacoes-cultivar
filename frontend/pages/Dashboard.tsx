import React from "react";
import MainLayout from "../components/layout/Main";
import {BreadcrumbItem} from "../app/AppTypes";

const Dashboard: React.FC = () => (
  <p>Conteúdo da página dashboard (Em construção)</p>
);

const breadcrumb: Array<BreadcrumbItem> = []

// @ts-ignore
Dashboard.layout = page => <MainLayout children={page} breadcrumb={breadcrumb} title="Dashboard" />

export default Dashboard;
