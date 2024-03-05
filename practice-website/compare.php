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