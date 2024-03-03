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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href=css/index.css>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Movie Queue</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    
<div class="movies-grid">
    
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<div class="movie-container">';
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