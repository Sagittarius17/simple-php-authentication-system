<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_db.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST['cpassword'];
    // $exists = true;
    $existsql = "SELECT * FROM `users` WHERE username='$username'"; // AND email='$email'
    $result = mysqli_query($conn, $existsql);
    if(mysqli_num_rows($result)>= 1){
        $showError = "Username already exists!";
    }
    else {
        if ($password == $cpassword) {
            $sql = "INSERT INTO `users` (`username`, `email`, `password`, `create_date`) VALUES ('$username', '$email', '$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // $showAlert = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: homepage.php");
            }
        }
        else {
            $showError = "Something went wrong!";
        }
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

    <title>Signin</title>
</head>

<body class="bg-dark">
    <?php 
        // include 'partials/_nav.php'; 
    ?>
    <?php
    if($showAlert){
      echo '<div onclick="hideAlerts()" class="alert alert-success close" role="alert">
              Success!
            </div>';
    }
    if($showError){
      echo '<div onclick="hideAlerts()" class="alert alert-warning" role="alert">
              Error! '. $showError.'
            </div>';
    }
    ?>


    <div class="container">
        <h3 style="text-align: center;" class="text-white my-4">Signin To Be One Of Us!</h3>  
        <div class="row border border-warning bg-secondary">
            <img src="batman.jpg" alt="login" class="col-6 w-50 my-3">
            <form id="myForm" method="post" action="/demo/signin.php" class="col-6 d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <input type="text" class="form-control bg-dark text-white" id="username" name="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control bg-dark text-white" id="email" name="email" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control bg-dark text-white" id="password" name="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control bg-dark text-white" id="cpassword" name="cpassword" placeholder="Confirm Password">
                </div>
                <div class="mb-3 text-white">
                    <input type="checkbox" class="" id="checkbox" name="checkbox">
                    <span>I accept all the Terms and Conditions.</span>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Signin</button> -->
                <!-- Button trigger modal -->
                <button type="submit" id="signinbtn" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Signin
                </button>
            </form>

            <!-- Modal -->
            <!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        
        <h3 style="text-align: center;" class="text-white my-5">You Already One Of Us? What Are You Doing Here Then?
            <a class="nav-link active" aria-current="page" href="/demo/login.php">Your Cave Is Waiting For You!</a>
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
        // Hides alerts
        function hideAlerts() {
            var alerts = document.getElementsByClassName("alert");
            for (var i = 0; i < alerts.length; i++) {
                alerts[i].style.display = "none";
            }
        }

        // Validations
        const form = document.getElementById("myForm");

        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting by default

            // Perform validation
            const username = document.getElementById("username");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const cpassword = document.getElementById("cpassword");

            if (username.value === "" || email.value === "" || password.value === "" || cpassword.value === "") {
                alert("Please fill in all the required fields.");
                username.style.border = "2px solid orange";
                email.style.border = "2px solid orange";
                password.style.border = "2px solid orange";
                cpassword.style.border = "2px solid orange";
                return; // Stop the form from submitting if validation fails

                // Popup for checkbox
                const checkbox = document.getElementById("checkbox");
                const modal = document.getElementById("staticBackdrop");
                const signinbtn = document.getElementById('signinbtn');

                checkbox.addEventListener("change", function() {
                    if (checkbox.checked) {
                        modal.style.display = "none";
                        signinbtn.disable = false;
                    } else {
                        modal.style.display = "block";
                    }
                });
                // if (!document.getElementById("checkbox").checked) {
                //     event.preventDefault(); // Prevent form submission
                    
                // }
            }
            // If validation passes, you can submit the form
            form.submit();
        });


    </script>


</body>

</html>