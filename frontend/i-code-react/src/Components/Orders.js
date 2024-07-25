import axios from "axios";
import React, { useEffect, useState } from "react";
import { Link, useNavigate, useSearchParams } from "react-router-dom";

const Orders = () => {
  const [orders, setOrders] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();
  const fetchData = () => {
    return axios
      .get(
        "http://127.0.0.1:8000/api/user-orders/" + searchParams.get("userid")
      )
      .then((response) => setOrders(response.data["orders"]));
  };
  useEffect(() => {
    fetchData();
  }, []);

  return (
    <div>
      <h4>User Orders</h4>
      {orders.map((orderObj) => {
        return (
          <div key={orderObj.id}>
           <h4>Order ID: {orderObj.id}</h4>
           <h4>Grand Total: {orderObj.grand_total} Tk.</h4>
           <h4>Created on: {orderObj.created_on} Tk.</h4>
            <hr />
            <hr />
          </div>
        );
      })}
    </div>
  );
};

export default Orders;
