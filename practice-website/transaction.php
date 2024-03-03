<?php

include 'database.php';

if (isset($_GET["id"])) {
    $movieId = $_GET["id"];
    
    $sql = "SELECT movie_name FROM tbl_movies WHERE id = ?";
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

$sqlSeats = "SELECT seat_number, seat_status FROM tbl_seats WHERE movie_id =?";
$stmtSeats = $conn->prepare($sqlSeats);
$stmtSeats->bind_param("i", $movieId);
$stmtSeats->execute();
$resultSeats = $stmtSeats->get_result();

$seats = array();

if ($resultSeats && $resultSeats->num_rows > 0) {
    while($row = $resultSeats->fetch_assoc()) {
        $seats[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Queue | Transaction</title>

    <script>
        function submitForm() {
            document.getElementById('paymentForm').submit();
        }
    </script>

</head>
<body>

<p>Movie Name: <?php echo $movie['movie_name']; ?></p>

<form id="paymentForm" action="payment_form.php" method="post">
    <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
    <div id="seat-container" class="seat-container">
        <?php foreach ($seats as $seat): ?>
            <div class="seat <?php echo $seat['seat_status'] === 'available' ? 'seat-available' : 'seat-booked'; ?>">
                <input type="checkbox" id="seat-<?php echo $seat['seat_number']; ?>" name="selectedSeats[]" value="<?php echo $seat['seat_number']; ?>" <?php echo $seat['seat_status'] === 'booked' ? 'disabled' : ''; ?>>
                <label for="seat-<?php echo $seat['seat_number']; ?>"><?php echo $seat['seat_number']; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <select name="selectedTime" id="select-time">
                <option value="1PM">1:00 PM</option>
                <option value="4PM">4:00 PM</option>
                <option value="7PM">7:00 PM</option>
    </select>

    <button type="button" onclick="submitForm()" id="confirm-button">Confirm</button>
</form>

</body>
</html>



