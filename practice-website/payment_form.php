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
<body style="50vh">

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
<div class="container d-flex align-items-center my-5">
 <div class="row justify-content-center">        
      <div class="col-md-6">
          <div class="card border rounded-3 shadow">
              <div class="card-body">
                 <h5 class="card-title text-center">Movie Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td class="fw-bold">Movie Name: </td>
                            <td><?php echo htmlspecialchars($movieName); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Price: </td>
                            <td><?php echo htmlspecialchars($payment); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Selected Seats: </td>
                            <td><?php echo htmlspecialchars(implode(", ", $_SESSION["selectedSeats"])); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Selected Time</td>
                            <td><?php echo htmlspecialchars($_SESSION["selectedTime"]); ?></td>
                        </tr>                        
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Submit Button To be Centered -->
    <div class="container d-flex align-items-center my-5">
    <div class="row justify-content-center">
        <div class="col-md-1">            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Submit
            </button>                
        </div>
    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details Before Proceeding</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="padding: 3px 15px; background-color: #ff0000; color: #ffffff; border: none; cursor: pointer; border-radius: 5px;">X</button>
</button>

      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Submit Button -->






</body>
</html>
