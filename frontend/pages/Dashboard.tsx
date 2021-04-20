import React from "react";
import MainLayout from "../components/layout/Main";

const Dashboard: React.FC = () => (
  <p>Conteúdo da página dashboard.</p>
);

// @ts-ignore
Dashboard.layout = page => <MainLayout children={page} title="Dashboard" />

export default Dashboard;
