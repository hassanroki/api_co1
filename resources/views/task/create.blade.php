<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ajax</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css"><span
        class="pln">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="column"><a href="{{ url('/') }}">Back</a></h1>
            <h1 class="column">Add Task</h1>
        </div>
        <div class="row">
            <div class="column">
                <label for="title">Title</label>
                <input type="text" id="title">

                <label for="description">Description</label>
                <input type="text" id="description">

                <button onclick="addNewTask()">Add New Task</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async function addNewTask() {
            let token = localStorage.getItem('token');
            // console.log(token);

            if (!token) {
                window.location = "/login"
                return;
            }

            let titleValue = document.getElementById('title').value;
            let descriptionValue = document.getElementById('description').value;

            let obj = {
                "title": titleValue,
                "description": descriptionValue,
            }

            try {
                let url = "/api/v1/store";
                let response = await axios.post(url, obj, {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    }
                });
                window.location = '/';
            } catch (error) {
                alert(error.message);
            }
        }
    </script>
</body>

</html>
