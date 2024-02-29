import logo from "./logo.svg";
import "./App.css";
import Button from "react-bootstrap/Button";
import axios from "axios";
import { useEffect, useState } from "react";
import Home from './Components/Home';
import Function from "./Components/Function";

function App() {
  // Declare variable to to fetch users data from database
  const [user, setUser] = useState([]);

  // Via Axios

  // const fetchData = () => {
  //   return axios
  //     .get("http://127.0.0.1:8000/api/users")
  //     .then((response) => setUser(response.data["users"]));
  // };

  // Via Fetch

  const fetchData = () => {
    return fetch("http://127.0.0.1:8000/api/users")
      .then((response) => response.json())
      .then((data) => setUser(data["users"]));
  };

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <div className="App">
      <h2> User List </h2>
      <ul>
        {user &&
          user.length > 0 &&
          user.map((userObj, index) => (
            <li key={userObj.id}> {userObj.name} {userObj.email} </li>
          ))}
      </ul>
      <Home />
      <Function />
    </div>
  );
}

export default App;
