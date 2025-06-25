<?php
require 'db_connect.php';
session_start();
 
// ระบบค้นหา
$keyword = "";
if (isset($_GET['keyword'])) {
    $keyword = trim($_GET['keyword']);
    $sql = "SELECT p.*, u.username
            FROM posts p
            JOIN users u ON p.user_id = u.user_id
            WHERE p.title LIKE ? OR p.content LIKE ?
            ORDER BY p.created_at DESC";
    $stmt = $conn->prepare($sql);
    $searchParam = "%" . $keyword . "%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT p.*, u.username FROM posts p
            JOIN users u ON p.user_id = u.user_id
            ORDER BY p.created_at DESC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>กระดานสนทนา - Q&A สิทธิมนุษยชน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00bcd4;
      --secondary: #009688;
      --accent: #64dd17;
      --success: #00c853;
      --light: #e0f7fa;
      --bg: #f5fefe;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Kanit', sans-serif; background: var(--bg); display: flex; min-height: 100vh; }
 
    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, var(--secondary), var(--primary));
      color: white;
      padding: 20px;
      box-shadow: 3px 0 15px rgba(0,0,0,0.2);
    }
    .sidebar h2 { font-size: 1.8rem; margin-bottom: 40px; text-align: center; }
    .sidebar a { display: block; color: white; text-decoration: none; margin-bottom: 15px; font-size: 1.1rem; padding: 10px 20px; border-radius: 10px; transition: 0.3s; }
    .sidebar a:hover { background: rgba(255,255,255,0.15); }
 
    .main { flex: 1; padding: 40px 60px; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .search-box input { padding: 12px 25px; border-radius: 50px; border: 1px solid #ccc; font-size: 1rem; width: 300px; }
    .add-button { background: linear-gradient(to right, var(--primary), var(--secondary)); color: white; padding: 12px 30px; border-radius: 50px; font-size: 1.1rem; text-decoration: none; box-shadow: 0 5px 15px rgba(0,0,0,0.3); transition: 0.3s; }
    .add-button:hover { transform: scale(1.05); }
    .search-btn { margin-left: 10px; background: linear-gradient(to right, var(--primary), var(--secondary)); color: white; border: none; padding: 12px 30px; border-radius: 50px; font-size: 1rem; cursor: pointer; }
 
    .stats { background: linear-gradient(to right, #b2dfdb, #e0f7fa); padding: 20px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 30px; font-size: 1rem; }
 
    .post-card { background: white; border-radius: 20px; padding: 25px 30px; margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); transition: 0.3s; }
    .post-card:hover { transform: translateY(-5px); }
    .post-card h3 { font-size: 1.4rem; color: var(--secondary); margin-bottom: 10px; }
    .post-card p { font-size: 1rem; color: #555; }
    .post-meta { margin-top: 15px; display: flex; justify-content: space-between; align-items: center; color: #777; }
    .category-label { background: var(--primary); color: white; padding: 5px 20px; border-radius: 30px; font-size: 0.85rem; }
 
    .read-more {
      display: inline-block; margin-top: 15px; background: linear-gradient(to right, var(--success), var(--accent));
      color: white; padding: 10px 30px; border-radius: 50px; text-decoration: none; font-size: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.3); transition: 0.3s;
    }
    .read-more:hover { transform: scale(1.05); }
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
 
  <hr style="border-color: rgba(255,255,255,0.3); margin: 20px 0;">
 
 
  <?php if (isset($_SESSION['user_id'])): ?>
    <div style="margin-bottom: 10px; font-size: 1rem;">👋 สวัสดี, <?php echo $_SESSION['username']; ?></div>
    <a href="logout.php" style="background: #c62828;">ออกจากระบบ</a>
  <?php else: ?>
    <a href="login.php" style="background: #00796b;">เข้าสู่ระบบ</a>
    <a href="register.php" style="background: #388e3c;">สมัครสมาชิก</a>
  <?php endif; ?>
</div>
 
 
<div class="main">
  <div class="header-top">
    <form method="get" class="search-box" style="display:flex;">
      <input type="text" name="keyword" placeholder="ค้นหาโพสต์..." value="<?php echo htmlspecialchars($keyword); ?>">
      <button type="submit" class="search-btn">ค้นหา</button>
    </form>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="add_post.php" class="add-button">➕ เพิ่มคำถามใหม่</a>
    <?php else: ?>
      <a href="login.php" class="add-button">➕ เพิ่มคำถามใหม่</a>
    <?php endif; ?>
  </div>
 
  <div class="stats">
    กระทู้ทั้งหมด: <strong>128</strong> | สมาชิก: <strong>523</strong> | ความคิดเห็น: <strong>1245</strong><br>
    "สิทธิมนุษยชนคือสิทธิพื้นฐานที่ทุกคนควรได้รับอย่างเท่าเทียม"
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
       <a class="read-more" href="view_post.php?id=<?php echo $row['id']; ?>">อ่านเพิ่มเติม</a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align:center;">ยังไม่มีโพสต์</p>
  <?php endif; ?>
</div>
 
</body>  
</html>
 