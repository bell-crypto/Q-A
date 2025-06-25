<?php
require 'db_connect.php';
session_start();

// ดึงโพสต์ทั้งหมดแบบเรียงล่าสุด
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
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <style>
    :root {
      --primary: #00bcd4;
      --secondary: #009688;
      --accent: #64dd17;
      --success: #00c853;
      --light: #e0f7fa;
    }
    body { font-family: 'Kanit', sans-serif; background: var(--light); color: #333; margin: 0; }
    .w3-sidebar { box-shadow: 2px 0 10px rgba(0,0,0,0.2); }
    .w3-bar-item:hover { background: var(--secondary) !important; color: white !important; }
    .container {
      padding: 40px;
      max-width: 1100px;
      margin: auto;
    }
    .post-card {
      background: #fff; border: 1px solid #ddd; padding: 25px; border-radius: 15px; 
      box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 25px; transition: 0.3s;
    }
    .post-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
    .post-card h3 { color: var(--secondary); margin-bottom: 15px; font-size: 1.3rem; }
    .post-card p { font-size: 1rem; color: #555; }
    .meta { display: flex; justify-content: space-between; margin-top: 15px; font-size: 0.9rem; color: #777; }
    .category-label { background: var(--primary); color: white; padding: 5px 20px; border-radius: 30px; font-size: 0.85rem; }
    a.button {
      display: inline-block; margin-top: 15px;
      background: linear-gradient(to right, var(--success), var(--accent));
      color: white; padding: 12px 30px; border-radius: 50px;
      text-decoration: none; font-size: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    a.button:hover { transform: scale(1.05); }
    .add-button {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white; padding: 15px 30px; border-radius: 50px;
      text-decoration: none; font-size: 1.2rem; display: inline-block; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
  </style>
</head>

<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-light-grey" style="width:220px;">
  <h3 class="w3-bar-item" style="color: var(--primary);">ศูนย์สิทธิมนุษยชน</h3>
  <a href="homepage.php" class="w3-bar-item w3-button">หน้าแรก</a>
  <a href="category.php" class="w3-bar-item w3-button">หมวดหมู่</a>
  <a href="toptopic.php" class="w3-bar-item w3-button">กระทู้ยอดนิยม</a>
  <a href="article.php" class="w3-bar-item w3-button">บทความน่ารู้</a>
  <a href="rules.php" class="w3-bar-item w3-button">กฎกติกา</a>
  <a href="contactus.php" class="w3-bar-item w3-button">ติดต่อเรา</a>
  <a href="test.php" class="w3-bar-item w3-button">แบบฝึกหัด</a>
  <hr>
  <?php if (isset($_SESSION['user_id'])): ?>
    <span class="w3-bar-item">สวัสดี, <?php echo $_SESSION['username']; ?></span>
    <a href="logout.php" class="w3-bar-item w3-button w3-red">ออกจากระบบ</a>
  <?php else: ?>
    <a href="login.php" class="w3-bar-item w3-button w3-green">เข้าสู่ระบบ</a>
    <a href="register.php" class="w3-bar-item w3-button w3-blue">สมัครสมาชิก</a>
  <?php endif; ?>
</div>

<!-- Page content -->
<div style="margin-left:220px;">
  <div class="container">
    <h1>กระดานสนทนา</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="add_post.php" class="add-button">➕ เพิ่มโพสต์ใหม่</a>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="post-card">
          <h3><?php echo htmlspecialchars($row['title']); ?></h3>
          <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
          <div class="meta">
            <span>โดย <?php echo htmlspecialchars($row['username']); ?> | วันที่ <?php echo $row['created_at']; ?></span>
            <span class="category-label"><?php echo htmlspecialchars($row['category']); ?></span>
          </div>
          <a class="button" href="view_post.php?post_id=<?php echo $row['post_id']; ?>">อ่านเพิ่มเติม</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">ยังไม่มีโพสต์</p>
    <?php endif; ?>

  </div>
</div>

</body>
</html>
