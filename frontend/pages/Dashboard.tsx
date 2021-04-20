import React from "react";
import MainLayout from "../components/layout/Main";

const Dashboard: React.FC = () => (
  <h1>Dashboard</h1>
);

// @ts-ignore
Dashboard.layout = page => <MainLayout children={page} title="Dashboard" />

export default Dashboard;
