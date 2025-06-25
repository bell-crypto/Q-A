<?php
require 'db_connect.php';
session_start();

// ตรวจสอบว่าได้รับ 'id' จาก URL หรือไม่
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];  // ดึง id จาก URL

    // ดึงข้อมูลโพสต์จากฐานข้อมูล
    $sql = "SELECT p.*, u.username 
            FROM posts p 
            JOIN users u ON p.user_id = u.user_id 
            WHERE p.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);  // ตรวจสอบการรับ id
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ดึงข้อมูลโพสต์
        $post = $result->fetch_assoc();
    } else {
        echo "ไม่พบโพสต์";
        exit;
    }

    // ดึงคอมเมนต์ทั้งหมดที่เกี่ยวข้องกับโพสต์นี้
    $sql_comments = "SELECT c.*, u.username 
                     FROM comments c 
                     JOIN users u ON c.user_id = u.user_id 
                     WHERE c.post_id = ? 
                     ORDER BY c.created_at DESC";
    $stmt_comments = $conn->prepare($sql_comments);
    $stmt_comments->bind_param("i", $post_id);  // ใช้ post_id จากโพสต์
    $stmt_comments->execute();
    $comments_result = $stmt_comments->get_result();

} else {
    echo "ไม่พบ ID ของโพสต์";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>โพสต์ - Q&A สิทธิมนุษยชน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    /* ใส่สไตล์ต่าง ๆ ที่ใช้ในหน้า index.php */
  </style>
</head>

<body>

<div class="main">
  <!-- แสดงข้อมูลโพสต์ -->
  <h1><?php echo htmlspecialchars($post['title']); ?></h1>
  <p>โดย <?php echo htmlspecialchars($post['username']); ?> | วันที่ <?php echo $post['created_at']; ?></p>
  <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

  <!-- ฟอร์มสำหรับคอมเมนต์ -->
  <h3>แสดงความคิดเห็น</h3>
  <form action="post_comment.php" method="post">
    <textarea name="comment" rows="4" cols="50" placeholder="เขียนคอมเมนต์..." required></textarea><br><br>
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <button type="submit">โพสต์คอมเมนต์</button>
  </form>

  <h3>ความคิดเห็นจากผู้ใช้</h3>
  <?php if ($comments_result->num_rows > 0): ?>
    <?php while ($comment = $comments_result->fetch_assoc()): ?>
      <div class="comment">
        <p><strong><?php echo htmlspecialchars($comment['username']); ?></strong> | <?php echo $comment['created_at']; ?></p>
        <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>ยังไม่มีคอมเมนต์</p>
  <?php endif; ?>
</div>

</body>
</html>
