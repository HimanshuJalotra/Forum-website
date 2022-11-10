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
        <h1 class="text-center">Login to your Account</h1>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $email = $_POST['email'];
          $password = $_POST['password'];
          

          $sql = "SELECT * FROM `users` WHERE user_Email='$email'";
          $result=mysqli_query($conn,$sql);
          $num = mysqli_num_rows($result);
          if($num==1){
           while($row=mysqli_fetch_assoc($result)){
             if(password_verify($password,$row['user_pass'])){
               session_start();
               $_SESSION['username']=$row['user_Email'];
               $_SESSION['id']=$row['sno'];
               $_SESSION['loggedin']=true;
               header("location:/new_forum/index.php");
              // echo $row['sno'];
      

             }else{
               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Password Incorrect</strong>  Please try again
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
             }

           }
          }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid Username</strong>  Please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

          }
        }
        ?>


        <form action="_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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