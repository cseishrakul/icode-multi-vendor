import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import Home from "./Components/Home";
import About from "./Components/About";
import Navbar from "./Components/Navbar";
import Contact from "./Components/Contact";
import Register from "./Components/Register";
import Thanks from "./Components/Thanks";

const App = () => {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/contact" element={<Contact /> } />
        <Route path="/register" element={<Register /> } />
        <Route path="/thanks" element={<Thanks /> } />
      </Routes>
    </BrowserRouter>
  );
};

export default App;
