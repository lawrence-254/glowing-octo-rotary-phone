import React from 'react'
import {Link} from "react-router-dom"
import LoginForm from "../components/forms/LoginForm" 
import styled from "styled-components"

const MainContainer = styled.div`
width:100%;
justify-items: center;
`
const Title = styled.h1`
color: black
`;

const IntroParagraph =styled.p`
color: darkgrey
`

const Login = () => {
  return (
    <MainContainer>
        <Title>TechWitter</Title>
        <IntroParagraph>Welcome to your tech discussion forum</IntroParagraph>
        <LoginForm/>
        <IntroParagraph>Don not have an account?</IntroParagraph>
        <Link to="/register/">REGISTER</Link>
    </MainContainer>
  )
}

export default Login