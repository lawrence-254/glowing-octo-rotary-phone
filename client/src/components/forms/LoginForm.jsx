import React, { useState } from "react";
// import { useNavigate } from "react-router-dom";
import { Form, Button, Container, Alert } from "react-bootstrap";
import { useUserActions } from "../../hooks/user.actions";
// import axios from "axios"

const LoginForm = () => {
    // const navigate = useNavigate();
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({});
    const [error, setError] = useState(null);
    const userActions = useUserActions();

    // const handleSubmit = (event) => {
    //     event.preventDefault();
    //     const loginForm = event.currentTarget;

    //     if (loginForm.checkValidity() === false) {
    //         event.stopPropagation();
    //     } else {
    //         const userData = {
    //             email: form.email,
    //             password: form.password,
    //         };

    //         userActions.login(userData).catch((err) => {
    //             setError(err.request.response);
    //             console.log("login error", error)
    //         });
    //     }

    //     setValidated(true);
    // };


    const handleSubmit = (event)=>{
        event.preventDefault()
        const loginForm = event.currentTarget;

        if (loginForm.checkValidity()===false){
            event.stopPropagation();
        };
        setValidated(true);

        const userData = {
            email: form.email,
            password: form.password,
        }

        // axios.post("http://localhost:8000/api/auth/login/", userData).then((res)=>{
        //     localStorage.setItem("auth", JSON.stringify({
        //         access: res.data.access,
        //         refresh: res.data.refresh,
        //         user: res.data.user,
        //     }));
        //     navigate("/");
        // })
        userActions.login(userData).catch((err)=>{
            if (err.message){
                setError(err.request.response);
                console.log("login error", error);
            }
        })
    }

    return (
        <Container style={{ maxWidth: "400px", marginTop: "2rem" }}>
            <h2>Login</h2>
            <Form id="login-form" noValidate validated={validated} onSubmit={handleSubmit} className="border p-4 rounded">
                <Form.Group controlId="formUsername" className="mb-3">  
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
                <div className="text-content text-danger">
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
