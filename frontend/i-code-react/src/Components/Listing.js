import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link, useSearchParams } from "react-router-dom";

const Listing = (props) => {
  const [products, setProducts] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/listing/" + searchParams.get("url"))
      .then((response) => setProducts(response.data["products"]));
  };
  useEffect(() => {
    fetchData();
  }, []);
  return (
    <div className="container">
      <div className="row my-3">
        {products.map((productObj) => {
          return (
            <div key={productObj.id} className="col-md-3 my-2">
              <div className="card">
                <Link to={"/detail?id=" + productObj.id}>
                  <img
                    src={productObj.product_image}
                    style={{ width: "100%" }}
                  />
                </Link>
                <hr />
                <div className="card-body text-center">
                  {" "}
                  <h5> {productObj.product_name} </h5>
                  <h6>Price: {productObj.final_price} </h6>
                </div>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default Listing;
