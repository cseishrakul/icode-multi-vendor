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

const App = () => {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/contact" element={<Contact /> } />
        <Route path="/register" element={<Register /> } />
        <Route path="/login" element={<Login /> } />
        <Route path="/thanks" element={<Thanks /> } />
        <Route path="/account" element={<Account />} />
        <Route path="/logout" element={<Logout />} />
      </Routes>
    </BrowserRouter>
  );
};

export default App;
