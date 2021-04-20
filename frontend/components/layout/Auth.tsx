import React from 'react';
import {Container, Image} from "@themesberg/react-bootstrap";

const AuthLayout: React.FC = (props) => {
  return (
    <main>
      <section className="d-flex align-items-center my-4 mt-lg-3 mb-lg-3">
        <Container>
          <div className="text-center">
            <Image src='/images/logo-characters.png' className='mb-lg-3' style={{maxHeight: '170px'}} />
          </div>
          { props.children }
        </Container>
      </section>
    </main>
  )
};

export default AuthLayout;
