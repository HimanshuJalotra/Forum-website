<!-- Nav Bar -->
<?php
include '_dbconnect.php';
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">New Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/new_forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                            
                        $sql = "SELECT * FROM `categories`";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $category_name = $row['category_name'];
                            $cat_id = $row['category_id'];
                            echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$cat_id.'">'.$category_name.'</a></li>';

                        }
             
                    echo '</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>';
            if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){

            echo '<form class="d-flex" method ="get" action="search.php">
              <p class="text-light mx-4 my-1">Welcome '.$_SESSION['username'].'</p>
                <input class="form-control me-2 my-2" type="search" name="search" placeholder="Search" style="height:50%" aria-label="Search">
                <button style="width:40%;height:50%" class="btn btn-outline-success mx-2 my-2" type="submit">Search</button>
                <a href="/new_forum/partials/_logout.php" style="width:40%;height:50%" class="btn btn-primary btn-success mx-2 my-2">Logout</a>
                
                </form>';}

                else{
                    echo '<form class="d-flex" method ="get" action="search.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    <a href="/new_forum/partials/_signup.php" class="btn btn-primary btn-success mx-1">Signup</a>
                    <a href="/new_forum/partials/_login.php" class="btn btn-primary btn-success">Login</a>
                    </form>';

                }

        echo '</div>
    </div>
</nav>';
?>

<?php

 ?>