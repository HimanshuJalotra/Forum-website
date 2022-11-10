<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Threads</title>
</head>

<body>
    <?php include 'partials/_header.php'?>
    <?php include 'partials/_dbconnect.php'?>

    <!-- Clicked Thread displays here-->
    <div class="container my-5" style="font-size:larger;">
        <?php
         $id = $_GET['threadid'];
         $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
         $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_assoc($result)){
             $title = $row['thread_title'];
             $desc = $row['thread_desc'];
             $thread_user_id = $row['thread_user_id'];

             $sql1 = "SELECT * FROM `users` WHERE sno = '$thread_user_id'";
             $result1 =mysqli_query($conn,$sql1);
             $row1 = mysqli_fetch_assoc($result1);

             $u_name = $row1['user_Email'];


               echo "<h1>$title</h1>
                     <p>$desc</p>
                     <h6>Posted by: $u_name</h6>";
         } 

          ?>
           <hr>
                <p>
                    No Spam / Advertising / Self-promote in the forums is not allowed
                    Do not post copyright-infringing material.
                    Do not post “offensive” posts, links or images.
                    Do not cross post questions.
                    Do not PM users asking for help.
                    Remain respectful of other members at all times.

                </p>
    </div>

    <!-- Enter your comment -->

    <div class="container my-4">
        <h1 class="text-center">Post your comments</h1>

        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $comment = $_POST['comment'];
          $comment = str_replace("<","&lt;",$comment);
          $comment = str_replace(">","&gt;",$comment);

          $alpha = $_SESSION['username'];
          $sql1 = "SELECT * FROM `users` WHERE user_Email='$alpha'";
          $result1 = mysqli_query($conn,$sql1);
          $row1 = mysqli_fetch_assoc($result1);
          $sno = $row1['sno'];

          $sql ="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
        }

        ?>

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post">
        <div class="mb-3">
            <label for="comment" class="form-label">Type your comments</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>';
        }
        else{
            echo '<div class="container">
            <P class="lead">You are not logged in. Kindly login to be able to add comments</p>
            </div>';
        }
    ?>


    <!-- Display comments -->

    <div class="container">
      <h1>Discussions</h1>
      <?php
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $comment = $row['comment_content'];
          $person = $row['comment_by'];

          
          $sql1 = "SELECT * FROM `users` WHERE sno = '$person'";
          $result1 =mysqli_query($conn,$sql1);
          $row1 = mysqli_fetch_assoc($result1);

          $u_name = $row1['user_Email'];

         echo '
         <div style="display:flex;flex-direction:row">
          <img src="userimg.png" height="60px" width="60pxpx" alt="">
         <div class="container">
         <p>'.$comment.'</p>
          <p>'.$u_name.'</p>
          </div>
          </div>
          <br>';
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