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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height:  100vh;
            margin:  0;
        }
        .ticket {
            width:  80%;
            max-width:  600px;
            background-color: #fff;
            border-radius:  10px;
            box-shadow:  0  4px  6px rgba(0,  0,  0,  0.1);
            padding:  30px;
            text-align: center;
        }
        .ticket h2 {
            margin-top:  0;
            color: #333;
            font-size:  24px;
        }
        .ticket p {
            margin-bottom:  10px;
            color: #666;
            font-size:  18px;
        }
        .ticket img {
            width:  150px;
            height:  150px;
            object-fit: cover;        
            margin:  20px auto;
            display: block;
        }
    </style>
</head>
<body>
<div class="ticket">
    <h2>Your Ticket</h2>

    <p>Customer Name: <?php echo htmlspecialchars($_SESSION["firstName"] . " " . $_SESSION["lastName"]); ?></p>
    <p>Email: <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
    <p>Movie Name: <?php echo htmlspecialchars($movieName); ?></p>
    <p>Selected Seats: <?php echo htmlspecialchars($_SESSION["selectedSeats"]); ?></p>
    <p>Selected Time: <?php echo htmlspecialchars($_SESSION["selectedTime"]); ?></p>
    
    <!-- QR  -->
    <img src="" alt="" id="qrImage">
    <!-- QR  -->

    <p id="reservationText">Reservation Successful!</p>
</div>   

<script>
    document.addEventListener("DOMContentLoaded", function() {        
        let reservationStatus = document.getElementById("reservationText");
        let qrImage = document.getElementById("qrImage");
        let transactionReference = "<?php echo htmlspecialchars($_SESSION["transactionReference"]); ?>";
        
        if (transactionReference.length > 0) {
            generateQR();            
        } else {
            reservationStatus.innerHTML = "Reservation Unsuccessful!"
        }

        function generateQR() {
            qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + transactionReference;
        }
    });    
</script>

</body>
</html>

<?php
$conn->close();
?>
