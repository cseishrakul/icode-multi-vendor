import React from "react";
import Home from "./Components/Home";
import Function from "./Components/Function";
import Text1 from "./Components/Function";
import User from "./Components/User";

const App = () => {
  return (
    <div>
      <Function text="This is a functional component.We dont believe in class component" />
      <Text1 text="This is a test of using two function in one component" />
      <User name={{data:'amit'}} address={{data:'Sylhet'}} />
      <Home text="This is class component and we are try to use props in it." />
    </div>
  );
};

export default App;
