<?php
require __DIR__ . '/db.php'; // ✅ ปลอดภัยและใช้ได้แน่นอน
session_start();

// ตั้ง default category เริ่มต้น
$category = isset($_GET['category']) ? $_GET['category'] : 'สิทธิในชีวิต';

// ดึงโพสต์ตาม category
$stmt = $conn->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.user_id WHERE p.category = ? ORDER BY p.created_at DESC");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>หมวดหมู่ - Q&A สิทธิมนุษยชน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00bcd4; --secondary: #009688; --accent: #64dd17;
      --success: #00c853; --dark: #004d40; --light: #e0f7fa; --bg: #f5fefe;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Kanit', sans-serif; background: var(--bg); display: flex; min-height: 100vh; }

    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, var(--secondary), var(--primary));
      color: white;
      padding: 20px;
      box-shadow: 3px 0 10px rgba(0,0,0,0.2);
    }
    .sidebar h2 { font-size: 1.8rem; margin-bottom: 40px; text-align: center; }
    .sidebar a { display: block; color: white; text-decoration: none; margin-bottom: 15px; font-size: 1.1rem; padding: 10px 20px; border-radius: 10px; transition: 0.3s; }
    .sidebar a:hover { background: rgba(255,255,255,0.15); }

    .main { flex: 1; padding: 40px 60px; }

    .category-buttons {
      display: flex; gap: 15px; margin-bottom: 40px; flex-wrap: wrap;
    }
    .category-buttons a {
      background: var(--primary); color: white;
      padding: 12px 30px; border-radius: 50px;
      font-size: 1.1rem; text-decoration: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      transition: 0.3s;
    }
    .category-buttons a:hover { transform: scale(1.05); }

    .post-card {
      background: white; border-radius: 20px; padding: 25px 30px;
      margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); transition: 0.3s;
    }
    .post-card:hover { transform: translateY(-5px); }
    .post-card h3 { font-size: 1.4rem; color: var(--secondary); margin-bottom: 10px; }
    .post-card p { font-size: 1rem; color: #555; }
    .post-meta { margin-top: 15px; display: flex; justify-content: space-between; align-items: center; color: #777; }
    .category-label { background: var(--primary); color: white; padding: 5px 20px; border-radius: 30px; font-size: 0.85rem; }
  </style>
</head>

<body>

<div class="sidebar">
  <h2>สิทธิมนุษยชน</h2>
  <a href="index.php">หน้าแรก</a>
  <a href="category.php">หมวดหมู่</a>
  <a href="toptopic.php">กระทู้ยอดนิยม</a>
  <a href="article.php">บทความ</a>
  <a href="rules.php">กฎกติกา</a>
  <a href="contactus.php">ติดต่อเรา</a>
  <a href="test.php">แบบฝึกหัด</a>
</div>

<div class="main">
  <h1 style="font-size: 2rem; color: var(--secondary); margin-bottom: 30px;">เลือกหมวดหมู่</h1>

  <div class="category-buttons">
    <a href="category.php?category=สิทธิในชีวิต">สิทธิในชีวิต</a>
    <a href="category.php?category=สิทธิแรงงาน">สิทธิแรงงาน</a>
    <a href="category.php?category=สิทธิเด็ก">สิทธิเด็ก</a>
    <a href="category.php?category=เสรีภาพส่วนบุคคล">เสรีภาพส่วนบุคคล</a>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="post-card">
        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 200))); ?>...</p>
        <div class="post-meta">
          <span>โดย <?php echo htmlspecialchars($row['username']); ?> | <?php echo $row['created_at']; ?></span>
          <span class="category-label"><?php echo htmlspecialchars($row['category']); ?></span>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align:center;">ยังไม่มีโพสต์ในหมวดหมู่นี้</p>
  <?php endif; ?>
</div>

</body>
</html>
