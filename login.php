<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_db.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * from users where username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
    }
    else {
        $showError = true;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
</head>

<body class="bg-dark">
    <?php 
        // include 'partials/_nav.php'; 
    ?>
    <?php
    if ($login) {
        echo '<div onclick="hideAlerts()" class="alert alert-success close" role="alert">
                Success! You are logged in.
            </div>';
    }
    if ($showError) {
        echo '<div onclick="hideAlerts()" class="alert alert-warning" role="alert">
              Invalid credentials!
            </div>';
    }
    ?>

    <div class="container">
        <h3 style="text-align: center;" class="text-white my-4">Login To Enter Your Cave!</h3>
        <div class="row border border-warning bg-secondary">
            <img src="batman.jpg" alt="login" class="col-6 w-50 my-3">
            <form method="post" action="/demo/login.php" class="col-6 d-flex flex-column justify-content-center">
                <div class="mb-3 text-white">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control bg-dark text-white" id="username" name="username">
                </div>
                <div class="mb-3 text-white">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control bg-dark text-white" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <h3 style="text-align: center;" class="text-white my-5">Not A Batman Yet? 
            <a class="nav-link active" id="signin" aria-current="page" href="/demo/signin.php">Be One Here!</a>
        </h3>
        
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script>

        function hideAlerts() {
            var alerts = document.getElementsByClassName("alert");
            for (var i = 0; i < alerts.length; i++) {
                alerts[i].style.display = "none";
            }
        }

    </script>

</body>

</html>