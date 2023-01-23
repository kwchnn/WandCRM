import React from "react";
import { useState } from "react";
import axios from "axios";
import { nanoid } from "@reduxjs/toolkit";

export default function RegisterComponent() {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const getRandId = () => {
        return nanoid(5);
    }

    async function postUser() {
        await axios.post('http://localhost:3000/auth', {
            username: username,
            password: password,
        })
        .then((response) => {
            console.log(response);
        })
        .catch(err => {
            console.log(err);
        });
    }

    return (
        <div className="container grd">
            <div className="border_form">
                <div className="reg_form">
                    <form>
                        <h2>Register</h2>
                        <div class="form-group">
                            <label for="thisEmail" className="text-white">Email address</label>
                            <input type="email" class="form-control bg-dark text-white" id="thisEmail" aria-describedby="emailHelp" value={username} onChange={(e) => setUsername(e.target.value)} />
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="thisPass" className="text-white">Password</label>
                            <input type="password" class="form-control bg-dark text-white" id="thisPass" aria-describedby="emailHelp"  value={password} onChange={(e) => setPassword(e.target.value)}/>
                        </div>
                        <br />
                        <button type="submit" className="btn btn-success" onClick={function(e) {e.preventDefault(); postUser() }}>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    );
}