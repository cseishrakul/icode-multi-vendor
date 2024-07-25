import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import Home from "./Components/Home";
import About from "./Components/About";
import Navbar from "./Components/Navbar";
import Contact from "./Components/Contact";
import Register from "./Components/Register";
import Thanks from "./Components/Thanks";
import Login from "./Components/Login";
import Account from "./Components/Account";
import Logout from "./Components/Logout";
import Shop from "./Components/Shop";
import Listing from "./Components/Listing";
import Detail from "./Components/Detail";
import Cart from "./Components/Cart,";
import DeleteCartItem from "./Components/DeleteCartItem";
import Checkout from "./Components/Checkout";
import Usernavbar from "./Components/Usernavbar";
import ThanksOrder from "./Components/ThanksOrder";
import Orders from "./Components/Orders";

const App = () => {
  let user = JSON.parse(localStorage.getItem("user"));
  return (
    <BrowserRouter>
      {
        localStorage.getItem('user')?
        <>
          <Usernavbar />
        </>
        :
        <>
          <Navbar />
        </>
      }
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/register" element={<Register />} />
        <Route path="/login" element={<Login />} />
        <Route path="/thanks" element={<Thanks />} />
        <Route path="/account" element={<Account />} />
        <Route path="/logout" element={<Logout />} />
        <Route path="/shop" element={<Shop />} />
        <Route path="/listing" element={<Listing />} />
        <Route path="/detail" element={<Detail />} />
        <Route path="/cart" element={<Cart />} />
        <Route path="/delete-cart-item" element={<DeleteCartItem />} />
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/thanks-order" element={<ThanksOrder />} />
        <Route path="/orders" element={<Orders />} />
      </Routes>
    </BrowserRouter>
  );
};

export default App;
