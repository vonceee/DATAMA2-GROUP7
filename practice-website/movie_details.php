<?php

include 'database.php';

if (isset($_GET["id"])) {
    $movieId = $_GET["id"];
    
    $sql = "SELECT * FROM tbl_movies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "No movie found with this ID.";
        exit;
    }
} else {
    echo "No movie ID provided.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Queue | Movie Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href=css/movie_details.css>
    
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

<div class="movie-grid">
    <div class="col-md-8">
        <?php
        $youtubeVideoId = $movie['youtube_trailer'];
        echo '<iframe width="50%" height="315" src="https://www.youtube.com/embed/' . $youtubeVideoId . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        ?>
    </div>
</div>


<div class="movie-grid">
    <div class="col-md-4 movie-details">
        <p>Movie Name: <?php echo $movie['movie_name']; ?></p>
        <p>Movie Rating: <?php echo $movie['movie_rating']; ?></p>
        <p>Release Date: <?php echo $movie['release_date']; ?></p>
        <p>Run Time: <?php echo $movie['run_time']; ?> minutes</p>
        <p>Genre: <?php echo $movie['genre']; ?></p>
        <p>Price: $<?php echo $movie['price']; ?></p>
        <a href="transaction.php?id=<?php echo $movie['id']; ?>">Watch Movie</a>
    </div>
</div>

</body>
</html>
