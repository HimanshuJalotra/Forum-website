<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Threadlist</title>
</head>

<body>
    <?php include 'partials/_header.php'?>
    <?php include 'partials/_dbconnect.php'?>

    <!-- Display full Category here -->

    <div class="container my-5" style="font-size:larger;">
        <?php
         $id = $_GET['catid'];
         $sql = "SELECT * FROM `categories` WHERE category_id =$id";
         $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_assoc($result)){
             $title = $row['category_name'];
             $desc = $row['category_description'];

               echo "<h1>Welcome to $title Forums</h1>
                     <p>$desc</p>";
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
        <button class="btn-primary btn-success btn">Learn More</button>

    </div>

    <!-- Form to submit thread starts here -->

    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title = $_POST['title'];
        $concern = $_POST['concern'];

        $title = str_replace("<","&lt;",$title);
        $title = str_replace(">","&gt;",$title);

        $concern = str_replace("<","&lt;",$concern);
        $concern = str_replace(">","&gt;",$concern);

        $alpha = $_SESSION['username'];
        $sql1 = "SELECT * FROM `users` WHERE user_Email='$alpha'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $sno = $row1['sno'];
        // echo var_dump($sno);
        
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$concern', '$id', '$sno', '2022-01-15 19:19:47.000000')";
        $result = mysqli_query($conn,$sql);


    }
    ?>

    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo '<div class="container">
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem title</label>
                <input type="title" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title short and simple</div>
            </div>
            <div class="mb-3">
                <label for="concern" class="form-label">Type your concern</label>
                <textarea class="form-control" id="concern" name="concern" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>';}
    
    else{
        echo '<div class="container">
        <P class="lead">You are not logged in. Kindly login to be able to add theads</p>
        </div>';
    }
    ?>

    <!-- Display threads here -->
    <div class="container">
        <h1>Browse Questions</h1>

        <?php
         $sql = "SELECT * FROM `threads` WHERE thread_cat_id =$id"; 
         $result = mysqli_query($conn,$sql);
         while($row=mysqli_fetch_assoc($result)){
             $title = $row['thread_title'];
             $desc = $row['thread_desc'];
             $t_id = $row['thread_id'];
             $thread_user_id = $row['thread_user_id'];

             $sql1 = "SELECT * FROM `users` WHERE sno = '$thread_user_id'";
             $result1 =mysqli_query($conn,$sql1);
             $row1 = mysqli_fetch_assoc($result1);

             $u_name = $row1['user_Email'];


            //  echo var_dump($email);
            

             echo '
                    <div class="container" style="display:flex;flex-dirextion:column">
                        <img src="userimg.png" width="60px" height="60px" alt="">
                        <div class="alpha mx-3">
                            <h4><a href="thread.php?threadid='.$t_id.'" class="text-dark">'.$title.'<a></h4>
                            <p>'.$desc.'</p>
                            <p>By <b>'.$u_name.'</b></p>
                        </div>
            
                    </div>';


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