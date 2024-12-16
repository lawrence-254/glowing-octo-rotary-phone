import React, { useState } from "react";
import { Form, Button, Container, Alert } from "react-bootstrap";
import { useUserActions } from "../../hooks/user.actions";
import '../../css/components/forms/LoginForm.css';

const LoginForm = () => {
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({});
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);
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
        setLoading(true);
        userActions
            .login(userData)
            .then(() => setLoading(false))
            .catch((err) => {
                setLoading(false);
                if (err.response && err.response.data) {
                    console.log("error response data:", err.response.data);
                    setError(err.response.data.message || "An error occurred.");
                } else {
                    console.log("unexpected error:", err.message);
                    setError(err.message || "An error occurred.");
                }
            });
    };

    return (
        <Container className="login-container-box">
            <h2>Login</h2>
            <Form id="login-form" noValidate validated={validated} onSubmit={handleSubmit}>
                <Form.Group controlId="formUsername" className="form-group">
                    <Form.Label className="label">Email</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter your username..."
                        value={form.email || ""}
                        onChange={(e) => {
                            setForm({ ...form, email: e.target.value });
                            setError(null);
                        }}
                        required
                        className="input"
                    />
                    <Form.Control.Feedback type="invalid">
                        This field is required.
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formPassword" className="form-group">
                    <Form.Label className="label">Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Enter password"
                        value={form.password || ""}
                        onChange={(e) => {
                            setForm({ ...form, password: e.target.value });
                            setError(null);
                        }}
                        minLength="8"
                        required
                        className="input"
                    />
                    <Form.Control.Feedback type="invalid">
                        Password must be at least 8 characters.
                    </Form.Control.Feedback>
                </Form.Group>
                <div className="text-danger">
                    {error && (
                        <Alert variant="danger">
                            {typeof error === "string" ? (
                                error
                            ) : (
                                <pre>{JSON.stringify(error, null, 2)}</pre>
                            )}
                        </Alert>
                    )}
                </div>
                <Button variant="primary" type="submit" disabled={loading}>
                    {loading ? "LOGING IN..." : "LOGIN"}
                </Button>
            </Form>
        </Container>
    );
};

export default LoginForm;
