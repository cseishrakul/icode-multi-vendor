import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Register = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [mobile, setMobile] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  async function Save(event) {
    event.preventDefault();
    let filter =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (name == "") {
      alert("Please enter your name");
    } else if (email == "") {
      alert("Please enter your email");
    } else if (!filter.test(email)) {
      alert("Please enter your valid email");
    } else if (mobile == "") {
      alert("Please enter your phone number");
    } else if (password == "") {
      alert("Please enter password");
    } else {
      let item = { name, email, mobile, password };
      // console.warn(item);
      let result = await fetch("http://127.0.0.1:8000/api/register-user", {
        method: "POST",
        headers: {
          "content-type": "application/json",
        },
        body: JSON.stringify(item),
      });
      result = await result.json();
      console.warn("result", result);

      if (result["email"] == "Email already exists") {
        alert(result["email"]);
      } else {
        navigate("/thanks");
      }
    }
  }

  return (
    <div className="container">
      <div className="row my-3">
        <div className="col-md-8 mx-auto">
          <div className="card">
            <div className="card-header bg-light">
              <h2 className="text-center">User Registration</h2>
              <p className="text-center">
                Registering for this site allows you to access your order status
                and history.
              </p>
            </div>
            <div className="card-body">
              <form onSubmit={Save}>
                <div className="form-group">
                  <label>Name</label>
                  <input
                    type="text"
                    className="form-control"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                  />
                </div>
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
                  <label>Phone</label>
                  <input
                    type="text"
                    className="form-control"
                    value={mobile}
                    onChange={(e) => setMobile(e.target.value)}
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
                />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Register;
