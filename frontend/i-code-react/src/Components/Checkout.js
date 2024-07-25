import axios from "axios";
import React, { useEffect, useState } from "react";
import { Link, useNavigate, useSearchParams } from "react-router-dom";

const Checkout = () => {
  let user = JSON.parse(localStorage.getItem("user"));
  const [userid, setUserid] = useState(user.userDetails.id);
  const [products, setProducts] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const navigate = useNavigate();

  const [name, setName] = useState("");
  const [address, setAddress] = useState("");
  const [city, setCity] = useState("");
  const [state, setState] = useState("");
  const [country, setCountry] = useState("");
  const [pincode, setPincode] = useState("");
  const [mobile, setMobile] = useState("");

  async function placeOrder() {
    if (name == "") {
      alert("Please enter your name");
    } else if (address == "") {
      alert("Enter your address");
    } else if (city == "") {
      alert("Enter your city");
    } else if (state == "") {
      alert("Enter your state");
    } else if (country == "") {
      alert("Enter your country");
    } else if (pincode == "") {
      alert("Enter your pincode");
    } else if (mobile == "") {
      alert("Enter your mobile");
    } else {
      let item = { name, address, city, state, country, pincode, mobile };
      // console.warn(item);
      let result = await fetch(
        "http://127.0.0.1:8000/api/place-order/" + userid,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(item),
        }
      );
      result = await result.json();
      console.warn("Result: ", result);
      if (result["name"] == "") {
        alert("Name is required");
      } else {
        navigate("/thanks-order");
      }
    }
  }

  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/checkout/" + searchParams.get("userid"))
      .then((response) => setProducts(response.data["products"]));
  };
  useEffect(() => {
    fetchData();
  }, []);
  return (
    <div align="center" className="py-4">
      <h2>Checkout</h2>
      {products.map((productObj) => {
        return (
          <div key={productObj.id}>
            <h5>{productObj.product.product_name}</h5>
            <Link to={"detail?id=" + productObj.id}>
              <img
                src={productObj.product.product_image}
                style={{ width: "150px" }}
              />
            </Link>
            <h6>Price: {productObj.product.final_price}</h6>
            <hr />
            <hr />
          </div>
        );
      })}
      {products.map((productObj) => {
        return (
          <div key={productObj.id}>
            {productObj.product.key == 0 ? (
              <h6 className="text-danger">
                Total Price: {productObj.product.total_price} Tk
              </h6>
            ) : null}
          </div>
        );
      })}
      <hr />
      <div className="container mt-5">
        <div className="row">
          <div className="col-md-12 mx-auto">
            <form className="p-4 border rounded shadow-sm">
              <h3 className="text-center mb-4">Delivery Address</h3>
              <hr />
              <input
                type="hidden"
                name="userid"
                value={userid}
                onChange={(e) => setUserid(e.target.value)}
              />
              <div className="row">
                <div className="col-md-3">
                  {" "}
                  <div className="mb-3">
                    <input
                      type="text"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                      className="form-control"
                      id="name"
                      placeholder="Enter Name"
                    />
                  </div>
                </div>
                <div className="col-md-3">
                  {" "}
                  <div className="mb-3">
                    <input
                      type="text"
                      value={address}
                      onChange={(e) => setAddress(e.target.value)}
                      className="form-control"
                      id="address"
                      placeholder="Enter Address"
                    />
                  </div>
                </div>
                <div className="col-md-3">
                  <div className="mb-3">
                    <input
                      type="text"
                      value={city}
                      onChange={(e) => setCity(e.target.value)}
                      className="form-control"
                      id="city"
                      placeholder="Enter City"
                    />
                  </div>
                </div>
                <div className="col-md-3">
                  <div className="mb-3">
                    <input
                      type="text"
                      value={state}
                      onChange={(e) => setState(e.target.value)}
                      className="form-control"
                      id="state"
                      placeholder="Enter State"
                    />
                  </div>
                </div>
              </div>

              <div className="row">
                <div className="col-md-4">
                  {" "}
                  <div className="mb-3">
                    <input
                      type="text"
                      value={country}
                      onChange={(e) => setCountry(e.target.value)}
                      className="form-control"
                      id="country"
                      placeholder="Enter Country"
                    />
                  </div>
                </div>
                <div className="col-md-4">
                  {" "}
                  <div className="mb-3">
                    <input
                      type="text"
                      value={pincode}
                      onChange={(e) => setPincode(e.target.value)}
                      className="form-control"
                      id="pincode"
                      placeholder="Enter Pincode"
                    />
                  </div>
                </div>
                <div className="col-md-4">
                  {" "}
                  <div className="mb-3">
                    <input
                      type="text"
                      value={mobile}
                      onChange={(e) => setMobile(e.target.value)}
                      className="form-control"
                      id="mobile"
                      placeholder="Enter Mobile Number"
                    />
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <Link>
                    <button
                      type="submit"
                      onClick={placeOrder}
                      className="btn btn-primary mt-2 w-100"
                    >
                      Place Order
                    </button>
                  </Link>
                </div>
                <div className="col-md-6">
                  {" "}
                  <Link to={"/cart?userid=" + searchParams.get("userid")}>
                    <button type="submit" className="btn btn-danger mt-2 w-100">
                      Back To Cart
                    </button>
                  </Link>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Checkout;
