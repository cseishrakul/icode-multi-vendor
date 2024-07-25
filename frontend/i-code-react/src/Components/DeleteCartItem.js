import axios from "axios";
import React, { useEffect, useState } from "react";
import { Link, useNavigate, useSearchParams } from "react-router-dom";

const DeleteCartItem = () => {
  let user = JSON.parse(localStorage.getItem("user"));
  const [userid, setUserid] = useState(user.userDetails.id);
  const [products, setProducts] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const navigate = useNavigate();
  const fetchData = () => {
    return axios
      .get(
        "http://127.0.0.1:8000/api/delete-cart-item/" +
          searchParams.get("cartid")
      )
      .then((response) => setProducts(response.data["message"]));
  };
  useEffect(() => {
    fetchData();
    navigate("/cart?userid=" + userid);
    alert("Deleted Cart Item");
  }, []);
  return <div>DeleteCartItem</div>;
};

export default DeleteCartItem;
