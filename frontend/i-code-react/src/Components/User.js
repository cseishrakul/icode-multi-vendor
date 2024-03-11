import React from 'react'

const User = (props) => {
  return (
    <div>
        <h2>{props.name.data}</h2>
        <h2>{props.address.data}</h2>
    </div>
    
  )
}

export default User