<?php
require 'db_connect.php';
session_start();

$sql = "SELECT p.*, u.username FROM posts p 
        JOIN users u ON p.user_id = u.user_id 
        ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ศูนย์ข้อมูลสิทธิมนุษยชน - หน้าหลัก</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00bcd4;
      --secondary: #009688;
      --accent: #64dd17;
      --success: #00c853;
      --light: #e0f7fa;
    }
    body { font-family: 'Kanit', sans-serif; margin: 0; background: var(--light); color: #333; }
    .header {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      padding: 20px 30px;
      color: white;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .hamburger { font-size: 2rem; cursor: pointer; }
    .sidebar {
      height: 100vh; width: 0; position: fixed; top: 0; left: 0;
      background-color: #fff; overflow-x: hidden;
      transition: 0.3s; box-shadow: 2px 0 10px rgba(0,0,0,0.3);
      z-index: 1000; padding-top: 60px;
    }
    .sidebar a {
      padding: 15px 30px; display: block; text-decoration: none;
      font-size: 1.2rem; color: var(--secondary);
    }
    .sidebar a:hover { background: var(--light); }
    .container { max-width: 1000px; margin: 40px auto; padding: 20px; }
    .post-card {
      background: #fff; padding: 25px; border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15); margin-bottom: 25px;
      transition: 0.3s;
    }
    .post-card:hover { transform: translateY(-5px); }
    .post-card h3 { color: var(--secondary); margin-bottom: 15px; }
    .meta { font-size: 0.9rem; color: #777; margin-top: 10px; }
    a.button {
      display: inline-block; margin-top: 15px;
      background: linear-gradient(to right, var(--success), var(--accent));
      color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none;
    }
    a.button:hover { transform: scale(1.05); }
    .add-button {
      display: inline-block; margin-bottom: 30px;
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-size: 1.2rem;
    }
  </style>
</head>

<body>

<div class="header">
  <div class="hamburger" onclick="openSidebar()">☰</div>
  <h2>ศูนย์ข้อมูลสิทธิมนุษยชน</h2>
</div>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" onclick="closeSidebar()">✖ ปิดเมนู</a>
  <a href="index.php">หน้าแรก</a>
  <a href="category.php">หมวดหมู่</a>
  <a href="toptopic.php">กระทู้ยอดนิยม</a>
  <a href="article.php">บทความ</a>
  <a href="rules.php">กฎกติกา</a>
  <a href="contactus.php">ติดต่อเรา</a>
  <a href="test.php">แบบฝึกหัด</a>
</div>

<div class="container">
  <?php if (isset($_SESSION['user_id'])): ?>
    <a href="add_post.php" class="add-button">➕ เพิ่มโพสต์ใหม่</a>
  <?php endif; ?>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="post-card">
        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
        <div class="meta">
          โดย <?php echo htmlspecialchars($row['username']); ?> | วันที่ <?php echo $row['created_at']; ?> | หมวดหมู่: <?php echo htmlspecialchars($row['category']); ?>
        </div>
        <a class="button" href="view_post.php?post_id=<?php echo $row['post_id']; ?>">อ่านเพิ่มเติม</a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align:center;">ยังไม่มีโพสต์</p>
  <?php endif; ?>
</div>

<script>
function openSidebar() {
  document.getElementById("mySidebar").style.width = "260px";
}
function closeSidebar() {
  document.getElementById("mySidebar").style.width = "0";
}
</script>

</body>
</html>
