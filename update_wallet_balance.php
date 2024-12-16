<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_wallet_balance = $_POST['wallet_balance']; // Amount to add

    // Fetch the current wallet balance
    $stmt = $conn->prepare("SELECT wallet_balance FROM wallets WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_balance);
    $stmt->fetch();
    $stmt->close();

    // Calculate the new balance
    $updated_balance = $current_balance + $new_wallet_balance;

    // Update the wallet balance in the database
    $stmt = $conn->prepare("UPDATE wallets SET wallet_balance = ? WHERE user_id = ?");
    $stmt->bind_param("ds", $updated_balance, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "Balance updated successfully!";
}

$conn->close();
?>



<!-- 
<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $wallet_balance = $_POST['wallet_balance'];

    // Update wallet balance
    $stmt = $conn->prepare("UPDATE wallets  SET wallet_balance = ? WHERE user_id = ?");
    $stmt->bind_param("ds", $wallet_balance, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "Balance updated successfully!";
}

$conn->close();
?> -->
