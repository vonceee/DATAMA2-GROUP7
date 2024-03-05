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
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
    <!-- CSS -->
    <link rel="stylesheet" href="css/payment_form.css">
    <title>Payment Form</title>
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


<h2 class="text-center my-3">Payment Form</h2>
<p>Movie Name: <?php echo htmlspecialchars($movieName); ?></p>
    <p>Price: <?php echo htmlspecialchars($payment); ?></p>
    <p>Selected Seats: <?php echo htmlspecialchars(implode(", ", $_SESSION["selectedSeats"])); ?></p>
    <p>Selected Time: <?php echo htmlspecialchars($_SESSION["selectedTime"]); ?></p>

    

<div class="btn-group float-end">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Submit
  </button>
  <div class="dropdown-menu">
  <form class="px-4 py-3" action="process_payment.php" method="post">  
    <div class="mb-3">
      <label for="firstName" class="form-label">First Name:</label>
      <input type="text" class="form-control" id="firstName" name="firstName" placeholder="John" required>
    </div>
    <div class="mb-3">
      <label for="lastName" class="form-label">Last Name:</label>
      <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Doe" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit Payment</button>
  </form>
  <div class="dropdown-divider"></div>  
  <a class="dropdown-item" href="transaction.php">Change seats?</a>
</div>
</div>

</body>
</html>
