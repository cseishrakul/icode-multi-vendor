import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Account = () => {
  let user = JSON.parse(localStorage.getItem("user"));

  const navigate = useNavigate();
  const [id, setId] = useState(user.userDetails.id);
  const [name, setName] = useState(user.userDetails.name);
  const [address, setAddress] = useState(user.userDetails.address);
  const [city, setCity] = useState(user.userDetails.city);
  const [state, setState] = useState(user.userDetails.state);
  const [country, setCountry] = useState(user.userDetails.country);
  const [pincode, setPincode] = useState(user.userDetails.pincode);

  async function Update(event) {
    event.preventDefault();
    if (name == "") {
      alert("Please insert name");
    } else {
      let item = { id, name, address, city, state, country, pincode };
      let result = await fetch("http://127.0.0.1:8000/api/update-user", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(item),
      });
      result = await result.json();
      // console.warn("Result: ", result);
      localStorage.setItem("user", JSON.stringify(result));
      alert("Your Account Updated Successfully!");
      navigate("/account");
    }
  }

  return (
    <div className="container">
      {localStorage.getItem("user") ? (
        <>
          <h2 className="text-center">
            Welcome {user.userDetails && user.userDetails.name}
          </h2>
          <div className="container">
            <div className="row my-3">
              <div className="col-md-8 mx-auto">
                <div className="card">
                  <div className="card-header bg-light">
                    <h2 className="text-center">User Profile</h2>
                  </div>
                  <div className="card-body">
                    <form>
                      <div className="form-group">
                        <label>Name</label>
                        <input
                          type="text"
                          className="form-control"
                          value={name}
                          // placeholder={user.userDetails.name}
                          onChange={(e) => setName(e.target.value)}
                        />
                      </div>
                      <div className="form-group">
                        <label>Address</label>
                        <input
                          type="text"
                          className="form-control"
                          value={address}
                          // placeholder={user.userDetails.address}
                          onChange={(e) => setAddress(e.target.value)}
                        />
                      </div>
                      <div className="form-group">
                        <label>City</label>
                        <input
                          type="text"
                          className="form-control"
                          value={city}
                          // placeholder={user.userDetails.address}
                          onChange={(e) => setCity(e.target.value)}
                        />
                      </div>
                      <div className="form-group">
                        <label>State</label>
                        <input
                          type="text"
                          className="form-control"
                          value={state}
                          // placeholder={user.userDetails.address}
                          onChange={(e) => setState(e.target.value)}
                        />
                      </div>
                      <div className="form-group">
                        <label>Country</label>
                        <input
                          type="text"
                          className="form-control"
                          value={country}
                          // placeholder={user.userDetails.address}
                          onChange={(e) => setCountry(e.target.value)}
                        />
                      </div>
                      <div className="form-group">
                        <label>Pincode</label>
                        <input
                          type="text"
                          className="form-control"
                          value={pincode}
                          // placeholder={user.userDetails.address}
                          onChange={(e) => setPincode(e.target.value)}
                        />
                      </div>
                      <input
                        type="submit"
                        value="Update"
                        onClick={Update}
                        className="btn btn-dark mt-2 w-100"
                      />
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
    </div>
  );
};

export default Account;
