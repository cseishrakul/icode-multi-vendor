import axios from "axios";
import React, { useEffect, useState } from "react";
import { Link, useSearchParams } from "react-router-dom";

const Cart = () => {
  const [products, setProducts] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/cart/" + searchParams.get("userid"))
      .then((response) => setProducts(response.data["products"]));
  };
  useEffect(() => {
    fetchData();
  }, []);
  return (
    <div align="center" className="py-4">
      <h2>Shopping Cart</h2>
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
            <Link to={"/delete-cart-item?cartid=" + productObj.id}>
              <button type="button" className="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </Link>
            <hr />
            <hr />
          </div>
        );
      })}{" "}
      <Link to={"/shop"}>
        <button className="btn btn-warning me-2">Continue Shopping</button>
      </Link>
      <Link to={"/checkout?userid=" + searchParams.get("userid")}>
        <button className="btn btn-dark">Checkout</button>
      </Link>
    </div>
  );
};

export default Cart;
