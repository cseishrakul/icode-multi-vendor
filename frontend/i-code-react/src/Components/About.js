import React, { useEffect, useState } from "react";
import axios from 'axios';

const About = () => {
  const [page, setPage] = useState([]);
  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/about-us")
      .then((response) => setPage(response.data["cmsPageDetails"]));
  };
  useEffect(()=>{
    fetchData();
  },[]);
  return <div>
    {page.map((pageObj)=>{
      return <div>
        <h1> {pageObj.title} </h1>
        <p> {pageObj.description} </p>
      </div>
    })}
  </div>;
};

export default About;
