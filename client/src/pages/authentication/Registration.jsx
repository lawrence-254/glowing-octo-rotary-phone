import React from 'react';
import { Link } from "react-router-dom";
import RegistrationForm from '../../components/forms/RegistrationForm';
import { Container, Row, Col, Button, Card } from 'react-bootstrap';

const Registration = () => {
  return (
    <Container fluid className="d-flex flex-row justify-content-center align-items-center" style={{ minHeight: "100vh" }}>
      <Row className="w-100 justify-content-center">
        {/* Card Container for Registration Form */}
        <Col xs={12} md={6} lg={4} className="d-flex justify-content-center">
          <Card className="w-100 container">
            <Card.Body>
              <div className="text-center mt-3 row">
                <div className="col-md-6 d-flex align-items-center">
                  <div className="content text-center px-4">
                    <h1 className="text-center text-primary mb-4">TechWitter</h1>
                    <p className="text-center content text-muted mb-4">Welcome to your tech discussion forum</p>
                    <hr></hr>
                      <p className="text-muted">Already have an account?</p>
                      <Link to="/login/">
                      login
                        {/* <Button variant="outline-primary" size="lg">LOGIN</Button> */}
                      </Link>
                  </div>
                </div>
              </div>
              {/* Registration Form */}
              <div className="col-md-6 p-5">
                <RegistrationForm />
              </div>

              {/* Redirect to Login */}
  
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default Registration;
