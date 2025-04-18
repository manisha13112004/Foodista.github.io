<?php
session_start();

if (!isset($_SESSION['pay_amount'])) {
    die("Payment amount not set. Please go back and try again.");
}

$amount = $_SESSION['pay_amount'] * 100; // Razorpay needs amount in paisa
$_SESSION['payment_amount'] = $amount;
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body onload="pay_now()">

<script>
function pay_now() {
    var options = {
        "key": "rzp_test_6rOnXxPx0HCyGF", // Replace with your Razorpay key_id
        "amount": "<?php echo $amount; ?>",
        "currency": "INR",
        "name": "Foodista",
        "description": "Test Transaction",
        "handler": function (response){
            window.location.href = "payment_success.php?payment_id=" + response.razorpay_payment_id;
        },
        "prefill": {
            "name": "<?php echo $_SESSION['username'] ?? 'Guest'; ?>",
            "email": "test@example.com"
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
}
</script>

</body>
</html>
