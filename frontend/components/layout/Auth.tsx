import React from 'react';
import { IRoute } from "../../routes";
import {Container, Image} from "@themesberg/react-bootstrap";

export type AuthLayoutProps = {
  routeConfig: IRoute
}

const AuthLayout: React.FC = (props: any) => {
  return (
    <main>
      <section className="d-flex align-items-center my-4 mt-lg-3 mb-lg-3">
        <Container className="text-center">
          <Image src='/images/logo-characters.png' className='mb-lg-3' style={{maxHeight: '170px'}} />
          <props.routeConfig.pageComponent {...props} />
        </Container>
      </section>
    </main>
  )
};

export default AuthLayout;
