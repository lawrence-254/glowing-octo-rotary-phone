import React from 'react'
import useSWR from 'swr'
import { useParams } from 'react-router-dom'
import {Col, Row} from 'react-bootstrap'

import Layout from '../components/navigation/Layout'
import UpdateProfileForm from '../components/profile/UpdateProfileForm'
import { fetcher } from '../helpers/axios'


function ProfileEdit() {
  return (
    <div>ProfileEdit</div>
  )
}

export default ProfileEdit