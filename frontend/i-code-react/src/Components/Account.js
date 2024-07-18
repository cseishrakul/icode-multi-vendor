import React from "react";

const Account = () => {
  let user = JSON.parse(localStorage.getItem("user"));
  return (
    <div className="container">
      {localStorage.getItem("user") ? (
        <>Welcome {user.userDetails.name}</>
      ) : null}
    </div>
  );
};

export default Account;
