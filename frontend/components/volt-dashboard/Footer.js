import React from "react";
import { Row, Col, Card } from '@themesberg/react-bootstrap';

export default (props) => {
  const currentYear = new Date().getFullYear();

  return (
    <div>
      <footer className="footer section py-5">
        <Row>
          <Col xs={12} lg={6} className="mb-lg-0">
            <p className="mb-0 text-xl-left">
              Copyright © 2019-{`${currentYear} `}
            </p>
          </Col>
        </Row>
      </footer>
    </div>
  );
};
