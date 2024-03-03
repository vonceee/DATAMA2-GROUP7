<?php

session_start();

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["movieId"] = $_POST["movieId"];
    $_SESSION["selectedSeats"] = $_POST["selectedSeats"];
    $_SESSION["selectedTime"] = $_POST["selectedTime"];
}

$sql = "SELECT movie_name, price FROM tbl_movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["movieId"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
    $movieName = $movie['movie_name'];
    $payment = $movie['price'];
} else {
    $movieName = "Movie not found";
    $payment = "N/A";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>
<body>

<h2>Payment Form</h2>

<form action="process_payment.php" method="post">
    <p>Movie Name: <?php echo htmlspecialchars($movieName); ?></p>
    <p>Price: <?php echo htmlspecialchars($payment); ?></p>
    <p>Selected Seats: <?php echo htmlspecialchars(implode(", ", $_SESSION["selectedSeats"])); ?></p>
    <p>Selected Time: <?php echo htmlspecialchars($_SESSION["selectedTime"]); ?></p>

    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Submit Payment</button>
</form>

</body>
</html>
