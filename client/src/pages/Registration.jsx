import React from 'react'
import {Link} from "react-router-dom"
import RegistrationForm from '../components/forms/RegistrationForm'
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

const Registration = () => {
  return (
    <MainContainer>
        <Title>TechWitter</Title>
        <IntroParagraph>Welcome to your tech discussion forum</IntroParagraph>
        <RegistrationForm/>
        <IntroParagraph>Have an account?</IntroParagraph>
        <Link to="/login/">LOGIN</Link>
    </MainContainer>
  )
}

export default Registration