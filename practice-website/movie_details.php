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
    <nav class="navbar navbar-expand-sm navbar-light bg-light">        
        <div class="container">
            <div id="logo">
                <a class="navbar-brand" href="#">
                    <img src="https://www.smsupermalls.com/themes/revamp2022/assets/img/logo.svg" class="d-inline-block align-top" alt="">
                </a>
            </div>
        <a class="navbar-brand ml-5" href="#">Movie Queue</a>        
      </div>                    
    </nav>
</header>

<div class="container d-flex align-items-center" style="height: 90vh;">
    <div class="row justify-content-center">
        <div class="col-md-6 my-4">
            <?php
            $youtubeVideoId = $movie['youtube_trailer'];
            echo '<iframe width="100%" class="youtube-embed" height="315" src="https://www.youtube.com/embed/' . $youtubeVideoId . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="display: block; margin: 0 auto;"></iframe>';
            ?>
        </div>
        <div class="col-md-6">
            <div class="card border rounded-3 shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">Movie Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">Movie Name</td>
                            <td><?php echo $movie['movie_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Movie Rating</td>
                            <td><?php echo $movie['movie_rating']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Release Date</td>
                            <td><?php echo $movie['release_date']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Run Time</td>
                            <td><?php echo $movie['run_time']; ?> minutes</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Genre</td>
                            <td><?php echo $movie['genre']; ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Price</td>
                            <td>$<?php echo $movie['price']; ?></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <a href="transaction.php?id=<?php echo $movie['id']; ?>" class="btn btn-primary">Watch Movie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





</body>
</html>
