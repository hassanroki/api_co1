<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Task</title>
    </span>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css"><span
        class="pln">
</head>

<body>
    <div class="container">
        <h1>Task Data</h1>
        <a href="{{ route('task.create') }}" class="button">Add New</a>
        <button class="button" onclick="logout()">Logout</button>

        <div class="row">
            <div class="column">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>

                    <tbody id="taskData">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Get Task
        async function getTask() {
            // With Out Token
            // let URL = "api/v1/listTest"
            // let response = await axios.get(URL);

            // Token Used
            let token = localStorage.getItem('token');
            // console.log(token);

            if (!token) {
                window.location = "/login"
                return;
            }

            try {
                let URL = "api/v1/list"
                let response = await axios.get(URL, {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    }
                });

                let tasks = response.data['data']['data'];
                tasks.forEach(task => {
                    document.getElementById('taskData').innerHTML += (`<tr>
                            <td>${task['taskTitle']}</td>
                            <td>${task['description']}</td>
                            <td><button onclick="">Delete</button></td>
                            <td><button onclick="">Edit</button></td>
                        </tr>`);
                });
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('token');
                    window.location = "/login";
                } else {
                    alert("Failed to load tasks.")
                    console.log(error);
                }
            }


        }
        getTask();


        // Logout
        async function logout() {
            let token = localStorage.getItem('token');

            if (!token) {
                window.location = "/login"
                return;
            }

            try {
                let URL = "v1/logout";
                let response = await axios.post(URL, {}, {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    }
                });
                localStorage.removeItem('token');
                window.location = "/login";
            } catch (error) {
                localStorage.removeItem('token');
                window.location = "/login";
            }

        }
    </script>
</body>

</html>
