import React,{useState, useContext} from 'react';
import {Button,Form, Image, Card, Dropdown } from 'react-bootstrap';
import axiosService from '../../helpers/axios';
import {getUser} from '../../hooks/user.actions';
import { Context } from '../navigation/Layout';



function CreateComment(props) {
    const {postId,refresh}=props;
    const [avatar, setAvatar]=useState();
    const [validated, setValidated]= useState(false);
    const [form, setForm]=useState({});

    const { toaster, setToaster} = useContext(Context);
    const user = getUser();

    const handleSubmit = (event)=>{
        event.preventDefault();
        const createCommentForm = event.currentTarget;

        if (createCommentForm.checkValidity()===false){
            event.stopPropagation();
        }
        setValidated(true);

        const commentFormData = {
            author: user.id,
            body: form.body,
            post: postId,
        }
        axiosService.post(`/post/${postId}/comment/`, commentFormData).then(()=>{
            setForm({...form, title:"", body:""})
            setToaster({
                type: "success",
                message: "Your comment posted",
                show: true,
                title: "Comment!",
            })
            refresh();
        }).catch(()=>{
            setToaster({
                type:"danger",
                message:"An error occured while trying to post your comment",
                show: true,
                title: "Error!"
            })
        })
    };

  return (
    <Form
    className='d-flex flex-row justify-content-between'
    noValidate
    validated={validated}
    onSubmit={handleSubmit}
    >
        <Image
        src=''
        roundedCircle
        width={48}
        height={48}
        className='my-2'
        />
         <Form.Group className='m-3 w-75'>
            <Form.Control
            className='py-2 rounded-pill border-primary'
            type='text'
            placeholder='Comment title (optional)'
            value={form.title || ''}
            name='title'
            onChange={(e)=>setForm({...form, title: e.target.value})}
            />
        </Form.Group>
        <Form.Group className='m-3 w-75'>
            <Form.Control
            className='py-2 rounded-pill border-primary'
            type='text'
            placeholder='Comment on post'
            value={form.body}
            name='body'
            onChange={(e)=>setForm({...form, body: e.target.value})}
            />
        </Form.Group>
        <Form.Group className='m-3 w-75'>
            <Form.Control
            className='py-2 rounded-pill border-primary'
            type='file'
            placeholder='Comment image(optional)'
            // value={form.image}
            name='image'
            onChange={(e)=>setForm({...form, image: e.target.value})}
            />
        </Form.Group>
        <div className='m-auto'>
            <Button
            variant='primary'
            onClick={handleSubmit}
            disabled={form.body===undefined}
            size='small'
            >
                Comment
            </Button>
        </div>
    </Form>
  )
}

export default CreateComment