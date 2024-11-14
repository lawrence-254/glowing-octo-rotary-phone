import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Form, Button, Container, Alert } from "react-bootstrap";
import { useUserActions } from "../../hooks/user.actions";

const LoginForm = () => {
    const navigate = useNavigate();
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({});
    const [error, setError] = useState(null);
    const userActions = useUserActions();

    const handleSubmit = (event) => {
        event.preventDefault();
        const loginForm = event.currentTarget;

        if (loginForm.checkValidity() === false) {
            event.stopPropagation();
        } else {
            const userData = {
                username: form.username,
                password: form.password,
            };

            userActions.login(userData).catch((err) => {
                setError(err?.response?.data?.message || "An error occurred.");
            });
        }

        setValidated(true);
    };

    return (
        <Container style={{ maxWidth: "400px", marginTop: "2rem" }}>
            <h2>Login</h2>
            <Form noValidate validated={validated} onSubmit={handleSubmit}>
                <Form.Group controlId="formUsername" className="mb-3">
                    <Form.Label>Username</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter your username..."
                        value={form.username}
                        onChange={(e) => setForm({ ...form, username: e.target.value })}
                        required
                    />
                    <Form.Control.Feedback type="invalid">
                        This field is required.
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formPassword" className="mb-3">
                    <Form.Label>Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Enter password"
                        value={form.password}
                        onChange={(e) => setForm({ ...form, password: e.target.value })}
                        minLength="8"
                        required
                    />
                    <Form.Control.Feedback type="invalid">
                        Password must be at least 8 characters.
                    </Form.Control.Feedback>
                </Form.Group>

                {error && <Alert variant="danger">{error}</Alert>}

                <Button variant="primary" type="submit">
                    Submit
                </Button>
            </Form>
        </Container>
    );
};

export default LoginForm;
