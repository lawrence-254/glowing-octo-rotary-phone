import styled from "styled-components"

import React from 'react'

const HomeContainerMain = styled.div`
background: red
`
const HomeTitle = styled.h1`
color: pink;
display: flex;
alignSelf: center
`

const Home = () => {
  return (
    <HomeContainerMain>
        <HomeTitle>
            prof
        </HomeTitle>
        Home
    </HomeContainerMain>
  )
}

export default Home

