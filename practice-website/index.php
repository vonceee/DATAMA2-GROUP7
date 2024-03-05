<?php

include 'database.php';

$sql = "SELECT id, movie_name FROM tbl_movies";
$result = $conn->query($sql)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Queue | Select Movie</title>
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href=css/index.css>


</head>
<body>

<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">        
        <!-- Ovveride bootstrap default justify-content: space-between; -->
        <div class="container " style="justify-content: flex-start;">
        <!-- Ovveride bootstrap default justify-content: space-between; -->

            <div id="logo">
                <a class="navbar-brand" href="#">
                    <img src="https://www.smsupermalls.com/themes/revamp2022/assets/img/logo.svg" class="d-inline-block align-top" alt="">
                </a>
            </div>
        <a class="navbar-brand ml-5" href="#">Movie Queue</a>        
        <!-- Admin Login Page Button -->
        <button class="btn btn-outline-success btn-lg ml-auto" onclick="window.location.href='login.php'" id="adminLogin">Admin View</button>
        <!-- Admin Login Page Button -->
      </div>                    
    </nav>
</header>                
    
<div class="movies-grid justify-content-center my-5 ">    
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="movie-container shadow-lg p-3 mb-5 bg-white rounded ">';
        echo '<img src="movie_poster/' . $row["movie_name"] . '.jpg">';
        echo '<h2 class="movie_title">' . $row["movie_name"] . '</h2>';
        echo '<a href="movie_details.php?id=' .$row["id"] .'">More Details..</a>';
        echo '</div>';

    }
} else {
    echo "0 results";
}

$conn->close();
?>

</div>

</body>
</html>