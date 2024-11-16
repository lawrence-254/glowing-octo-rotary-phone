import React from 'react';
import {Navbar, Container, Image, NavDropdown, Nav} from "react-bootstrap";
import {useNavigate} from "react-router-dom";

function Navigationbar(){
    const navigate = useNavigate()
    const handleLogout=()=>{
        localStorage.removeItem("auth");
        navigate('/login/')
    }
    return(
        <Navbar bg="primary" variant="dark">
            <Container>
                <Navbar.Brand className="fw-bold" href="#home">TechWitter</Navbar.Brand>
                <Navbar.Collapse className="justify-content-end">
                    <Nav>
                        <NavDropdown
                        title={
                            <Image src="#" roundedCircle width={36} height={36}/>
                        }>
                            <NavDropdown.Item href='#'>Profile</NavDropdown.Item>
                            <NavDropdown.Item onClick={handleLogout}>LOGOUT</NavDropdown.Item>
                        </NavDropdown>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    )
}

export default Navigationbar;

