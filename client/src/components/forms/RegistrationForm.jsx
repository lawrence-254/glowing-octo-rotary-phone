import React, {useState} from "react"
import axios from "axios"
import {useNavigate} from "react-router-dom"
import styled from "styled-components"

const RegistrationForm = () => {
    const navigate = useNavigate()
    const [validated, setValidated] = useState(false);
    const [form, setForm] = useState({});
    const [error, setError] = useState(null);

    const handleSubmit =(event)=>{
        event.preventDefault();
        const registrationForm = event.currentTarget;

        if (registrationForm.checkValidity()=== false){
            event.stopPropagation();
        };

        setValidated(true);

        const userData = {
            username : form.username,
            first_name: form.first_name,
            last_name: form.last_name,
            password: form.password,
            email: form.email,
            bio: form.bio
        };

        axios.post("http://localhost/8000/api/auth/register/", userData).then((res)=>{
            localStorage.setItem("auth", JSON.stringify({
                access: res.data.access,
                refresh: res.data.refresh,
                user: res.data.user
            }));
            navigate("/");
        }).catch((err)=>{
            if (err.message){
                setError(err.request.response);
            }
        });
    };
    const FormContainer = styled.div`
    background: yellow;
    width: 80vw;
    height: 70vh;
    display: grid;
    margin-left: 10vw;
    margin-top:15vh;
    `;
    const FormTitle = styled.h2`
    font-weight: 10px;
    `;

    const FormDiv = styled.div`
    width: 90%;
    `
    const FormLabel = styled.label`
    font-weight: 7px
    `
    const FormInput = styled.input`
    width: 100%
    `

    const ErrorBox = styled.div`
    color:red;
    `
    const SubmitButton = styled.button`
    background: green;
    width: 80px;
    `

  return (
    <FormContainer validated={validated} onSubmit={handleSubmit}>
        <FormTitle>REGISTER</FormTitle>
        <FormDiv>
            <FormLabel>Username</FormLabel>
            <FormInput
            type="text"
            placeholder="Enter your username..."
            value={form.username}
            onChange={(e)=>setForm({...form, username: e.target.value })}
            required
            />
            {/* <Form.Control.Feedback type="invalid">
                This Field is required
            </Form.Control.Feedback> */}
        </FormDiv>
        <FormDiv>
            <FormLabel>First Name</FormLabel>
            <FormInput
            value={form.first_name}
            onChange={(e)=>setForm({...form, first_name: e.target.value})}
            required
            type="text"
            placeholder="Enter First Name"
            />
        </FormDiv>
        <FormDiv>
            <FormLabel>Last Name</FormLabel>
            <FormInput
            value={form.last_name}
            onChange={(e)=>setForm({...form, last_name: e.target.value})}
            required
            type="text"
            placeholder="Enter Last Name"
            />
        </FormDiv>
        <FormDiv>
            <FormLabel>Email</FormLabel>
            <FormInput
            value={form.email}
            onChange={(e)=>setForm({...form, email: e.target.value})}
            required
            type="email"
            placeholder="Enter email"
            />
        </FormDiv>
        <FormDiv>
            <FormLabel>Password</FormLabel>
            <FormInput
            value={form.password}
            minLength="8"
            onChange={(e)=>setForm({...form, password: e.target.value})}
            required
            type="password"
            placeholder="Enter password"
            />
        </FormDiv>
        <FormDiv>
            <FormLabel>Bio</FormLabel>
            <FormInput
            value={form.bio}
            onChange={(e)=>setForm({...form, bio: e.target.value})}
            as="textarea"
            row={3}
            placeholder="Enter bio...(optional)"
            />
        </FormDiv>
        <ErrorBox>{error && <p>{error}</p>}</ErrorBox>
        <SubmitButton>submit</SubmitButton>
    </FormContainer>
)
}

export default RegistrationForm