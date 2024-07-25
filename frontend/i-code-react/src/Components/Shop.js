import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";

const Shop = () => {
  const [shop, setShop] = useState([]);
  const fetchData = () => {
    return axios
      .get("http://127.0.0.1:8000/api/menu")
      .then((response) => setShop(response.data["categories"]));
  };
  useEffect(() => {
    fetchData();
  }, []);
  return (
    <div>
      {shop.map((shopObj) => {
        return (
          <div>
            <h3>&nbsp;&nbsp; {shopObj.name} </h3>
            {shopObj.categories.map((catObj) => {
              return (
                <h6>
                  {" "}
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <Link to={"/listing?url=" + catObj.url}>
                    {" "}
                    {catObj.category_name}
                  </Link>
                </h6>
              );
            })}
          </div>
        );
      })}
    </div>
  );
};

export default Shop;
