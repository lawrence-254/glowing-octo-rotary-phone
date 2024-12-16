import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import { Form, Button, Container, Alert } from "react-bootstrap";
import "../../css/components/forms/RegisterForm.css";

const RegistrationForm = () => {
    const navigate = useNavigate();
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({
        username: "",
        first_name: "",
        last_name: "",
        password: "",
        email: "",
        bio: "",
    });
    const [error, setError] = useState(null);
    const [fieldErrors, setFieldErrors] = useState({});

    const handleSubmit = (event) => {
        event.preventDefault();
        const registrationForm = event.currentTarget;

        if (registrationForm.checkValidity() === false) {
            event.stopPropagation();
        } else {
            const userData = { ...form };
            axios
                .post("http://localhost:8000/api/auth/register/", userData)
                .then((res) => {
                    localStorage.setItem(
                        "auth",
                        JSON.stringify({
                            access: res.data.access,
                            refresh: res.data.refresh,
                            user: res.data.user,
                        })
                    );
                    navigate("/");
                })
                .catch((error) => {
                    if (error.response && error.response.data) {
                        console.log("Error response data:", error.response.data);

                        // Set general errors
                        setError(error.response.data.non_field_errors || null);

                        // Set field-specific errors
                        setFieldErrors(error.response.data);
                    } else {
                        console.log("Unexpected error:", error.message);
                        setError(error.message || "Unexpected error occurred.");
                    }
                });
        }

        setValidated(true);
    };
    return (
        <Container className="registration-form-container" style={{
            width: '100%',
            height: '90vh',
            border: '1px solid #ddd',
            borderRadius: '8px',
            boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
            display: 'flex',
            flexDirection: 'column',
            color: 'bisque',
            background: 'green',
            overflow: 'hidden'
        }}>
            <h2>REGISTER</h2>
            {error && <Alert variant="danger">{error}</Alert>}
            <Form
                id="registration-form"
                noValidate
                validated={validated}
                onSubmit={handleSubmit}
              
            >
                <Form.Group controlId="formUsername" className="mb-3">
                    <Form.Label>Username</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter your username"
                        value={form.username}
                        onChange={(e) =>
                            setForm({ ...form, username: e.target.value })
                        }
                        required
                        isInvalid={!!fieldErrors.username}
                    />
                    <Form.Control.Feedback type="invalid">
                        {fieldErrors.username || "This field is required."}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formFirstName" className="mb-3">
                    <Form.Label>First Name</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter First Name"
                        value={form.first_name}
                        onChange={(e) =>
                            setForm({ ...form, first_name: e.target.value })
                        }
                        required
                        isInvalid={!!fieldErrors.first_name}
                    />
                    <Form.Control.Feedback type="invalid">
                        {fieldErrors.first_name || "This field is required."}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formLastName" className="mb-3">
                    <Form.Label>Last Name</Form.Label>
                    <Form.Control
                        type="text"
                        placeholder="Enter Last Name"
                        value={form.last_name}
                        onChange={(e) =>
                            setForm({ ...form, last_name: e.target.value })
                        }
                        required
                        isInvalid={!!fieldErrors.last_name}
                    />
                    <Form.Control.Feedback type="invalid">
                        {fieldErrors.last_name || "This field is required."}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formEmail" className="mb-3">
                    <Form.Label>Email</Form.Label>
                    <Form.Control
                        type="email"
                        placeholder="Enter email"
                        value={form.email}
                        onChange={(e) =>
                            setForm({ ...form, email: e.target.value })
                        }
                        required
                        isInvalid={!!fieldErrors.email}
                    />
                    <Form.Control.Feedback type="invalid">
                        {fieldErrors.email || "Please provide a valid email address."}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formPassword" className="mb-3">
                    <Form.Label>Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Enter password"
                        minLength="8"
                        value={form.password}
                        onChange={(e) =>
                            setForm({ ...form, password: e.target.value })
                        }
                        required
                        isInvalid={!!fieldErrors.password}
                    />
                    <Form.Control.Feedback type="invalid">
                        {fieldErrors.password || "Password must be at least 8 characters."}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group controlId="formBio" className="mb-3">
                    <Form.Label>Bio</Form.Label>
                    <Form.Control
                        as="textarea"
                        rows={3}
                        placeholder="Enter bio... (optional)"
                        value={form.bio}
                        onChange={(e) =>
                            setForm({ ...form, bio: e.target.value })
                        }
                    />
                </Form.Group>

                <Button variant="success" type="submit">
                    REGISTER
                </Button>
            </Form>
        </Container>
    );
};

export default RegistrationForm;
