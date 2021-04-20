import React, {useEffect} from 'react';
import {Container, Image} from "@themesberg/react-bootstrap";

type AuthLayoutProps = {
  title: string
}

const AuthLayout: React.FC<AuthLayoutProps> = ({ title, children }) => {
  useEffect(() => {
    document.title = `${title} | Avaliações Cultivar`;
  }, [title])

  return (
    <main>
      <section className="d-flex align-items-center my-4 mt-lg-3 mb-lg-3">
        <Container>
          <div className="text-center">
            <Image src='/images/logo-characters.png' className='mb-lg-3' style={{maxHeight: '170px'}} />
          </div>
          { children }
        </Container>
      </section>
    </main>
  )
};

export default AuthLayout;
