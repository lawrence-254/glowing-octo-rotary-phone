import React from 'react';
import { Link } from "react-router-dom";
import RegistrationForm from '../components/forms/RegistrationForm';
import { Container, Row, Col, Button, Card } from 'react-bootstrap';

const Registration = () => {
  return (
    <Container fluid className="d-flex justify-content-center align-items-center" style={{ minHeight: "100vh" }}>
      <Row className="w-100 justify-content-center">
        {/* Card Container for Registration Form */}
        <Col xs={12} md={6} lg={4} className="d-flex justify-content-center">
          <Card className="w-100">
            <Card.Body>
            <div className="text-center mt-3">

              <h1 className="text-center mb-4">TechWitter</h1>
              <p className="text-center text-muted mb-4">Welcome to your tech discussion forum</p>
              <hr></hr>
                <p className="text-muted">Already have an account?</p>
                <Link to="/login/">
                  <Button variant="outline-primary" size="lg">LOGIN</Button>
                </Link>
              </div>
              {/* Registration Form */}
              <RegistrationForm />

              {/* Redirect to Login */}
  
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default Registration;
