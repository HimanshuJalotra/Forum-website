<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php include '_header.php'?>
    <?php include '_dbconnect.php'?>


    <div class="container my-4">
        <h1 class="text-center">Signup for your new Account</h1>

        <?php
        $signup = false;
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            
            $sql = "SELECT * FROM `users` WHERE user_Email='$email'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_num_rows($result);
            if($row==0){
            
                if($password==$cpassword){
                    $hash = password_hash($password,PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`user_Email`, `user_pass`, `timestamp`) VALUES ('$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Your account is craeated</strong> To login <a href="_login.php">click here<a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $signup = true;
                }

                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password do not match</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
           }
           else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Username already exists</strong> Kindly choose a new one
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';

            }

        }
        ?>
    <form action="_signup.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    if($signup == true){
        echo '<a class="btn btn-primary btn-success my-4" href="_login.php">Login</a>';
    }
     ?>
    </div>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>