import React from 'react'
import {Button, Image} from 'react-bootstrap';
import { useNavigate} from 'react-router-dom';
import { getUser } from '../../hooks/user.actions';


function ProfileDetails(props) {
    const navigate = useNavigate();
    const {activeUser} = props;
    const user = getUser()
    
    // if (!user){
    //     return<div>user not detected</div>
    // }
  return (
    <div>
        <div className="d-flex flex-row border-bottom p-5">
            {/* <Image
            src={user.avatar}
            roundedCircle
            width={200}
            height={200}
            className="me-5 border border-primary border-2"
            /> */}
            <div className="d-flex flex-column justify-content-start align-self-center mt-2">
                <p className="fs-4 m-0">{user.username}</p>
                <p className="fs-5">{user.bio? user.bio:"No User Bio"}</p>
                <p className="fs-6">
                    <small>{user.posts_count}</small>
                </p>
                <Button
                variant="primary"
                size="sm"
                className="w-25"
                onClick={()=> navigate(`/profile/${user.id}/edit`)}
                >Edit profile</Button>
            </div>
        </div>
    </div>
  )
}

export default ProfileDetails