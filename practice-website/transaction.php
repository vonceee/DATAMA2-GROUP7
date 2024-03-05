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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href=css/cinema-seat.css>
    <link rel="stylesheet" href="css/transaction.css">

    <script>
        function submitForm() {
            document.getElementById('paymentForm').submit();
        }
    </script>

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


<h1 class='text-center my-3'>Movie Name: <?php echo $movie['movie_name']; ?></h1>

<div class="text-center px-5 mb-5" >
    <p style="color: white; font-size: 12vh; background-color: black;">MOVIE SCREEN</p>
</div>


<div class="container">
    <form id="paymentForm" action="payment_form.php" method="post">
        <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
    <?php $count = 0; ?>
    <div class="row d-flex justify-content-center"> <!-- Added d-flex and justify-content-center here -->
        <?php foreach ($seats as $seat): ?>
            <div class="col-md-1" > <!-- Adjust the column size as per your layout -->
                <div class="seat form-check form-check-inline">
                    <input type="checkbox" id="seat-<?php echo $seat['seat_number']; ?>" name="selectedSeats[]" value="<?php echo $seat['seat_number']; ?>" class="form-check-input" <?php echo $seat['seat_status'] === 'booked' ? 'disabled' : ''; ?>>
                    <label for="seat-<?php echo $seat['seat_number']; ?>" class="form-check-label"><?php echo $seat['seat_number']; ?></label>
                </div>
            </div>
            <?php if (++$count % 4 === 0): ?> <!-- Start a new row after every 4 seats -->
                </div>
                <div class="row d-flex justify-content-center"> <!-- Added d-flex and justify-content-center here -->
            <?php endif; ?>
        <?php endforeach; ?>
    </div>



        <div class="form-group mt-5">
            <label for="select-time">Select Time:</label>
            <select name="selectedTime" id="select-time" class="form-control" style='width: 16vw;'>
                <option value="1PM">1:00 PM</option>
                <option value="4PM">4:00 PM</option>
                <option value="7PM">7:00 PM</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3" id="confirm-button">Confirm</button>
    </form>
    </div>



</body>
</html>



