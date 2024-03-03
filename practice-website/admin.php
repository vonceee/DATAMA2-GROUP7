<?php

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["movie_id"])) {
        $movieId = $_POST["movie_id"];

        $sql = "UPDATE tbl_seats SET seat_status = 'available' WHERE movie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $movieId);
        if ($stmt->execute()) {
            echo "Seats status for movie ID $movieId reset successfully.";
        } else {
            echo "Error resetting seats status: " . $conn->error;
        }
    } else {
        echo "Please enter a movie ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Reset Seats Status</title>
</head>
<body>

<h1>Admin - Reset Seats Status</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="movie_id">Movie ID:</label>
    <input type="number" id="movie_id" name="movie_id" required>
    <input type="submit" value="Reset Seats Status">
</form>

</body>
</html>
