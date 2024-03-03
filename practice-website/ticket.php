<?php

session_start(); 

include 'database.php';

$sql = "SELECT movie_name FROM tbl_movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["movieId"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
    $movieName = $movie['movie_name'];
} else {
    $movieName = "Movie not found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>
<body>

<h2>Your Ticket</h2>

<p>Customer Name: <?php echo htmlspecialchars($_SESSION["firstName"] . " " . $_SESSION["lastName"]); ?></p>
<p>Email: <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
<p>Movie Name: <?php echo htmlspecialchars($movieName); ?></p>
<p>Selected Seats: <?php echo htmlspecialchars($_SESSION["selectedSeats"]); ?></p>
<p>Selected Time: <?php echo htmlspecialchars($_SESSION["selectedTime"]); ?></p>

<p>Reservation Successful!</p>

</body>
</html>

<?php
$conn->close();
?>
