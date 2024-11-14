import React from 'react';
import { Link } from "react-router-dom";
import LoginForm from "../components/forms/LoginForm"; 
import { Container, Row, Col, Button, Card } from "react-bootstrap";

const Login = () => {
  return (
    <Container fluid className="d-flex justify-content-center align-items-center" style={{ minHeight: "100vh" }}>
      <Row className="w-100">
        {/* Left Column: Title and Intro */}
        <Col xs={12} md={6} className="d-flex w-50 justify-content-center flex-column align-items-start p-4">
          <h1 className="mb-4">TechWitter</h1>
          <p className="text-muted mb-3">Welcome to your tech discussion forum</p>
          <hr></hr>
          <p className="text-muted mb-4">Don't have an account?</p>
          <Link to="/register/">
            <Button variant="outline-primary" size="lg">REGISTER</Button>
          </Link>
        </Col>

        {/* Right Column: Login Form */}
        <Col xs={12} md={6} className="d-flex justify-content-center align-items-end p-4">
          <Card className="w-100 p-4">
            <Card.Body>
              <LoginForm />
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
};

export default Login;
