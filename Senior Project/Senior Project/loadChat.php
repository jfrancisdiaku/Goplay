<?php 
require 'config/db.php';
require_once 'controllers/authController.php';

$outgoing_id = $_SESSION['id'];
$toUser = $_POST['toUser'];


$query = "SELECT * FROM users WHERE username LIKE '%$toUser%' ";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$userCount = $result->num_rows;
$user = mysqli_fetch_assoc($result);
$incoming_id = $user['id'];

    
$output = "";

$sql = "SELECT * FROM messages LEFT JOIN users ON users.id = messages.outgoing_msg_id
        WHERE outgoing_msg_id = $outgoing_id AND incoming_msg_id = $incoming_id
        OR outgoing_msg_id = $incoming_id AND incoming_msg_id = $outgoing_id ORDER BY msg_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$userCount = $result->num_rows;

if($userCount > 0){
    while($row = mysqli_fetch_assoc($result)){
        if($row['outgoing_msg_id'] === $outgoing_id){
            $output .= '<p class="rounded outgoing">'.$row['msg'].'</p>';
        }else{
            $output .= '<p class="rounded incoming">'.$row['msg'].'e</p>';
        }
    }
}else{
    $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
}

echo $output;


?>