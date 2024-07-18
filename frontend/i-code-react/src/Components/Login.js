import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  async function loginUser(event) {
    event.preventDefault();
    let item = { email, password };
    // console.warn(item);
    let result = await fetch("http://127.0.0.1:8000/api/login-user", {
      method: "POST",
      headers: {
        "content-type": "application/json",
      },
      body: JSON.stringify(item),
    });
    result = await result.json();
    console.warn(result);
    if (result["email"] == "Email is required") {
      alert(result["email"]);
    } else if (result["email"] == "Email does not exists") {
      alert(result["email"]);
    } else if (result["email"] == "The email must be a valid email address.") {
      alert(result["email"]);
    } else if (result["message"] == "Email is incorrect") {
      alert(result["message"]);
    } else if (result["password"] == "Password is required") {
      alert(result["password"]);
    } else if (result["message"] == "Password is incorrect") {
      alert(result["message"]);
    } else {
      localStorage.setItem("user", JSON.stringify(result));
      navigate("/account");
    }
  }
  return (
    <div className="container">
      <div className="row my-3">
        <div className="col-md-8 mx-auto">
          <div className="card">
            <div className="card-header bg-light">
              <h2 className="text-center">User Login</h2>
            </div>
            <div className="card-body">
              <form>
                <div className="form-group">
                  <label>Email</label>
                  <input
                    type="email"
                    className="form-control"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                  />
                </div>
                <div className="form-group">
                  <label>Password</label>
                  <input
                    type="password"
                    className="form-control"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                  />
                </div>
                <input
                  type="submit"
                  value="Sign Up"
                  className="btn btn-dark mt-2 w-100"
                  onClick={loginUser}
                />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;
