import React from 'react';
import GoogleLogin from 'react-google-login';
// or
// import { GoogleLogin } from 'react-google-login';

const responseGoogle = (response) => {
  console.log(response);
}

function App() {
  return (
    <div>
<GoogleLogin
    clientId="266747388497-m2sc8tlu0vl5iavl6uqd79jli6ekm097.apps.googleusercontent.com"
    buttonText="Login"
    onSuccess={responseGoogle}
    onFailure={responseGoogle}
    cookiePolicy={'single_host_origin'}
    accessType={'offline'}
  />
    </div>
  );
}

export default App;
