import React, { useState } from "react";
import { Form, Button, Container, Alert } from "react-bootstrap";
import { useUserActions } from "../../hooks/user.actions";
import '../../css/components/forms/LoginForm.css'

const LoginForm = () => {
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({});
    const [error, setError] = useState(null);
    const userActions = useUserActions();

    const handleSubmit = (event) => {
        event.preventDefault();
        const loginForm = event.currentTarget;

        if (loginForm.checkValidity() === false) {
            event.stopPropagation();
        }
        setValidated(true);

        const userData = {
            email: form.email,
            password: form.password,
        };
        userActions
            .login(userData)
            .catch((error) => {
                if (error.response && error.response.data){
                    console.log("error response data:", error.response.data)
                    setError(error.response.data)
                }else{
                    console.log("unexpected error:", error.message)
                    setError(error.message || "An error occurred.");
                }
            });
    };

    return (
        <Container className="login-container container-box">
            <h2>Login</h2>
            <Form id="login-form" noValidate validated={validated} onSubmit={handleSubmit}>
                <Form.Group controlId="formUsername">
                    <Form.Label>Email</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter your username..."
                        value={form.email}
                        onChange={(e) => setForm({ ...form, email: e.target.value })}
                        required
                    />
                    <Form.Control.Feedback type="invalid">
                        This field is required.
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formPassword">
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
                <div className="text-danger">
                    {error && <Alert variant="danger">{error}</Alert>}
                </div>
                <Button variant="primary" type="submit">
                    Submit
                </Button>
            </Form>
        </Container>
    );
};

export default LoginForm;
