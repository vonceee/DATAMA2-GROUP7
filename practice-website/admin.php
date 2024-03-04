<?php

include 'database.php';
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["logout"])){
        session_start();
        session_destroy();
        header("Location:index.php");

     } else if (isset($_POST["movie_id"])) {
        $movieId = $_POST["movie_id"];

        $sql = "UPDATE tbl_seats SET seat_status = 'available' WHERE movie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $movieId);
        if ($stmt->execute()) {
            $message="Seats status for movie ID $movieId reset successfully.";
        } else {
            $message="Error resetting seats status: " . $conn->error;
        }
    } else {
        $message="Please enter a movie ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Reset Seats Status</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        


    
</head>
<body>


<div class="container vh-100 d-flex align-items-center">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">

            <?php if(isset($message)): ?>
            <div class='alert alert-primary my-3 shadow' style='font-size: calc(1.375rem + 0.2vw);'><?php echo $message; ?></div>
            <?php endif; ?>

            <h1 class='mb-2'>Admin - Reset Seats Status</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label class="mt-3" for="movie_id" style='font-size: 3vh'>Movie ID:</label>
                <select id="movie_id" name="movie_id">
                    <option value="">Select Movie ID</option>
                    <option value="1">Rewind</option>
                    <option value="2">Demon Slayer</option>                    
                </select>
                <div class='my-3 d-flex justify-content-center'>
                    <div class='mr-3'> <!-- Add margin to the right of the first button for spacing -->
                        <input class="btn btn-outline-secondary" type="submit" value="Reset Seats Status">
                    </div>
                    <div> <!-- Wrap the logout button in a div to align it next to the reset button -->                            
                            <button type="submit" class="btn btn-outline-secondary" name="logout">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                            </button>                        
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>




</body>
</html>
