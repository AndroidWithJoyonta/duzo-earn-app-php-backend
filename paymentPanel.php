<?php
require 'connect.php';

$sql = "SELECT * FROM payment_requests WHERE status = 'pending'";
$result = $conn->query($sql);

echo "<table class='table'>";
echo "<tr><th>ID</th>
<th>User ID</th>
<th>Method</th>
<th>Amount</th>
<th>Address</th>
<th>Action</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['user_id']}</td>
         <td>{$row['method']}</td>
        <td>{$row['amount']}</td>
        <td>{$row['address']}</td>
        <td>
            <button onclick='approveRequest({$row['id']})' class='btn btn-success'>Approve</button>
            <button onclick='rejectRequest({$row['id']})' class='btn btn-danger'>Reject</button>
        </td>
    </tr>";
}
echo "</table>";
?>

<script>
function approveRequest(id) {
    fetch(`approve_request.php?id=${id}&status=approved`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Request approved.");
                location.reload();
            } else {
                alert("Failed to approve request.");
            }
        });
}

function rejectRequest(id) {
    fetch(`approve_request.php?id=${id}&status=rejected`)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Request rejected.");
                location.reload();
            } else {
                alert("Failed to reject request.");
            }
        });
}
</script>
