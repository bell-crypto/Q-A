<?php
require 'db_connect.php';
session_start();

// ตรวจสอบการรับข้อมูลจาก AJAX
if (isset($_POST['post_id']) && isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];  // สมมุติว่าเก็บ user_id ใน session

    // คำสั่ง SQL สำหรับบันทึกคอมเมนต์
    $sql = "INSERT INTO comments (post_id, user_id, comment, created_at) 
            VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $post_id, $user_id, $comment);
    $stmt->execute();

    // ตรวจสอบว่าการเพิ่มคอมเมนต์สำเร็จ
    if ($stmt->affected_rows > 0) {
        echo "Comment added successfully!";
    } else {
        echo "Failed to add comment.";
    }
}
?>
