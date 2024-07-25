import axios from "axios";
import React, { useEffect, useState } from "react";
import { Link, useNavigate, useSearchParams } from "react-router-dom";

const Detail = () => {
  let user = JSON.parse(localStorage.getItem("user"));
  const [userid, setUserid] = useState(user.userDetails.id);
  const [product, setProduct] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const [size, setSize] = useState("");
  const [productid, setProductid] = useState("");
  const navigate = useNavigate();
  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/detail/" + searchParams.get("id"))
      .then((response) => setProduct(response.data["products"]));
  };
  async function addToCart() {
    var size = searchParams.get("size");
    var productid = searchParams.get("id");
    // alert(userid);
    let item = { size, productid, userid };
    // console.warn(item);
    let result = await fetch("http://127.0.0.1:8000/api/add-to-cart", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(item),
    });
    result = await result.json();
    console.warn("Result: ", result);
    if (result["message"] == "Product already exists in cart") {
      alert(result["message"]);
    } else if (result["message"] == "Product Added in Cart!") {
      alert(result["message"]);
      navigate("/cart?userid=" + userid);
    }
  }
  useEffect(() => {
    fetchData();
  }, []);
  return (
    <div className="container">
      <div className="row my-3">
        <h2 className="text-center">Product Details</h2>
        {product.map((productObj) => {
          return (
            <div key={productObj.id} className="col-md-8 mx-auto my-2">
              <div className="card p-4">
                <div className="row">
                  <div className="col-md-6">
                    {" "}
                    <img src={productObj.product_image} />
                  </div>
                  <div className="col-md-6">
                    <div className="card-body">
                      {" "}
                      <h5> {productObj.product_name} </h5>
                      <p className="">
                        {" "}
                        {productObj.brand.name} /{" "}
                        <Link to={"/listing?url=" + productObj.category.url}>
                          {" "}
                          {productObj.category.category_name}
                        </Link>
                      </p>
                      <h6>Price: {productObj.final_price} </h6>
                      <h6>Code: {productObj.product_code} </h6>
                      <h6>Color: {productObj.product_color} </h6>
                      <h6 style={{ color: "red" }}>
                        Price: {productObj.final_price}{" "}
                      </h6>
                      <h6>Sleeve: {productObj.sleeve} </h6>
                      <h6>Fabric: {productObj.fabric} </h6>
                      <h6 style={{ textAlign: "justify" }}>
                        {productObj.description}{" "}
                      </h6>
                      {localStorage.getItem("user") ? (
                        <>
                          {searchParams.get("size") ? (
                            <form action="javascript:;">
                              <input
                                name="userid"
                                type="hidden"
                                value={userid}
                                onChange={(e) => setUserid(e.target.value)}
                              />
                              <input
                                name="id"
                                type="hidden"
                                value={productObj.id}
                                onChange={(e) => setProductid(e.target.value)}
                              />
                              <input
                                name="size"
                                type="hidden"
                                value={searchParams.get("size")}
                                onChange={(e) => setSize(e.target.value)}
                              />
                              <h6>
                                <b>Selected Sizes:</b>{" "}
                                {searchParams.get("size")}
                              </h6>
                              <button
                                onClick={addToCart}
                                className="btn btn-success"
                              >
                                Checkout
                              </button>
                            </form>
                          ) : (
                            <form>
                              <input
                                name="id"
                                type="hidden"
                                value={productObj.id}
                                onChange={(e) => setProductid(e.target.value)}
                              />
                              <h6>
                                Sizes:{" "}
                                <select name="size">
                                  {productObj.attributes.map((valObj) => {
                                    return (
                                      <option
                                        key={valObj.size}
                                        value={valObj.size}
                                      >
                                        {valObj.size}
                                      </option>
                                    );
                                  })}
                                </select>
                              </h6>
                              <button className="btn btn-dark">
                                Proceed To Checkout
                              </button>
                            </form>
                          )}
                        </>
                      ) : (
                        <>
                          {" "}
                          <Link to="/login">Please Login First</Link>{" "}
                        </>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default Detail;
