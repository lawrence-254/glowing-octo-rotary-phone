import React, {useState, useContext} from 'react'
import {Form, Button, Image} from 'react-bootstrap'
import { useNavigate } from 'react-router-dom'

import { useUserActions } from '../../hooks/user.actions'
import { Context } from '../navigation/Layout'

function UpdateProfileForm(props) {
    const {profile} =props;
    const navigate = useNavigate()

    const [validated, setValidated] = useState();
    const [form, setForm] = useState()
    const [error, setError] = useState();
    const userActions = useUserActions();

    const [avatar, setAvatar] = useState();
    const {toaster, setToaster} = useContext(Context);
    const handleSubmit = (event)=>{
        event.preventDefault();
        const updateProfileForm = event.currentTarget

        if (updateProfileForm.checkVality()=== false){
            event.stopPropagation();
        }
        setValidated(true);
        const userUodateProfileData = {
            first_name: form.first_name,
            last_name: form.last_name,
            bio: form.bio
        }

        const formData = new FormData();

        Object.keys(userUodateProfileData).forEach((key)=>{
            if (userUodateProfileData[key]){
                formData.append(key, userUodateProfileData[key])
            }
        });
        if (avatar){
            formData.append("avatar", avatar)
        }
        userActions.edit(formData, profile.id).then(()=>{
            setToaster({
                type: "success",
                message:"Profile update success",
                show: true,
                title: "Profile Update",
            });
            navigate(-1)

        }).catch((err)=>{
            if (err.message){
                setError(err.request.response)
            }
        })

    }

  return (
    <Form
    id="registration-form"
    className="border p-4 rounded"
    noValidate
    validated={validated}
    onSubmit={handleSubmit}
    >
        <Form.Group className="mb-3 d-flex flex-column">
            <Form.Label className="text-center">Avatar</Form.Label>
            <Image
            src={form.avatar}
            roundedCircle
            width={130}
            height={130}
            className="m-2 border border-primary border-2 align-self-center"
            />
            <Form.Control
            onChange={(e)=>setAvatar(e.target.files[0])}
            className="w-50 align-self-center"
            type="file"
            size="sm"
            />
            <Form.Control.Feedback type="invalid">
                This File is required
            </Form.Control.Feedback>
        </Form.Group>
    </Form>
  )
}

export default UpdateProfileForm