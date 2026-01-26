<?php 
    session_start();
    include_once("../../includes/dbcon.php");

    $id = $_POST['roomId'];
    $price = $_POST['updatePrice'];
    $updater= $_SESSION['MadhusData']['Madhus_id'];
    $updatedAt= $_POST['updatedAt'];

    if ($price>0) {

    $stmt = $con->prepare("CALL updateRoomPrice(?, ?, ?, ?)");
    
    if (!$stmt) {
        echo "❌ Prepare failed: " . $con->error;
        exit;
    }

    $stmt->bind_param("iiss", 
        $id, 
        $price,
        $updater,
        $updatedAt
    );

    if ($stmt->execute()) {
        $result = $stmt->get_result();
            if ($result && $row = $result->fetch_assoc()) {               
                echo  $row['message']; 
            }    
    } else {
        echo "❌ Error Updating : " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "❌ Missing required fields! partner:". $partnerId .",privilege:". $privilege;
}
?>