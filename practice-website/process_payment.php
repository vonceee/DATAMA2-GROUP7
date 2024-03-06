<?php

session_start();

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_SESSION["movieId"];
    $selectedSeats = $_SESSION["selectedSeats"];
    $selectedTime = $_SESSION["selectedTime"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];

    $sql = "SELECT * FROM tbl_customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $sql = "UPDATE tbl_customers SET first_name = ?, last_name = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $firstName, $lastName, $email);
        $stmt->execute();
  
        $sql = "SELECT id FROM tbl_customers WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
        $customerId = $customer['id'];
    } else {

        $sql = "INSERT INTO tbl_customers (first_name, last_name, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $firstName, $lastName, $email);
        $stmt->execute();
        $customerId = $stmt->insert_id;

    }

    // Update the tbl_movie_seats table to mark the selected seats as booked
    foreach ($selectedSeats as $seatNumber) {
        $sql = "UPDATE tbl_seats SET seat_status = 'booked' WHERE seat_number = ? AND movie_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $seatNumber, $movieId);
        $stmt->execute();
    }
    
    // Insert into the tbl_reservations table using the customer ID
    $selectedSeatsString = implode(",", $selectedSeats);
    $sql = "INSERT INTO tbl_reservations (customer_id, movie_id, selected_seats, selected_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $customerId, $movieId, $selectedSeatsString, $selectedTime);
    $stmt->execute();

    // Retrieve UID from transaction_reference column
    $sql = "SELECT transaction_reference FROM tbl_reservations WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $transaction = $result->fetch_assoc();
    $transactionReference= $transaction['transaction_reference'];

    // After successfully inserting the reservation and updating the seats
    $_SESSION["customerId"] = $customerId;
    $_SESSION["movieId"] = $movieId;
    $_SESSION["selectedSeats"] = implode(", ", $selectedSeats);
    $_SESSION["selectedTime"] = $selectedTime;
    $_SESSION["firstName"] = $firstName;
    $_SESSION["lastName"] = $lastName;
    $_SESSION["email"] = $email;
    $_SESSION["transactionReference"] = $transactionReference;



    // Redirect to ticket.php
    header("Location: ticket.php");
    exit;

} else {

    header("Location: payment_form.php");
    exit;

}
?>
