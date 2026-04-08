<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css"><span
        class="pln">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="column">Login to Dashboard</h1>
        </div>
        <div class="row">
            <div class="column">
                <label for="emailId">Email</label>
                <input type="text" id="emailId">

                <label for="passwordId">Password</label>
                <input type="text" id="passwordId">
                <button onclick="login()">Login</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async function login(){
            let emailValue = document.getElementById('emailId').value;
            let passwordValue = document.getElementById('passwordId').value;

            let obj = {
                "email": emailValue,
                "password": passwordValue,
            }

            try {
                let URL = 'http://127.0.0.1:8000/api/v1/login';
            let response = await axios.post(URL, obj);

            // console.log(response);
            // Storage Token in localStorage
            localStorage.setItem('token', response.data['access_token']);
                window.location = "/";
            } catch (error) {
                alert("Login failed. Please check your credentials");
                console.log(error);
            }

        }
    </script>
</body>

</html>
