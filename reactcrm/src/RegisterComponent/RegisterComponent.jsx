import React from "react";
import { useState } from "react";

export default function RegisterComponent() {
    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');
    const [remember, setRemember] = useState(false);


    return (
        <div className="container grd">
            <div className="border_form">
                <div className="reg_form">
                    <form>
                        <h2>Register</h2>
                        <div class="form-group">
                            <label for="thisEmail" className="text-white">Email address</label>
                            <input type="email" class="form-control bg-dark text-white" id="thisEmail" aria-describedby="emailHelp" value={login} onChange={(e) => setLogin(e.target.value)} />
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="thisPass" className="text-white">Password</label>
                            <input type="email" class="form-control bg-dark text-white" id="thisPass" aria-describedby="emailHelp"  value={password} onChange={(e) => setPassword(e.target.value)}/>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label text-white" for="defaultCheck1">
                                Remember me
                            </label>
                        </div>
                        <br />
                        <button type="submit" className="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    );
}