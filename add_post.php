<?php
require 'db_connect.php';
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินก่อน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $category = $_POST['category'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, category, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $user_id, $title, $content, $category);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "เกิดข้อผิดพลาดในการเพิ่มโพสต์";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เพิ่มคำถามใหม่ - Q&A สิทธิมนุษยชน</title>
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

    .container {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      max-width: 700px;
      margin: auto;
    }
    h1 { font-size: 2rem; color: var(--secondary); text-align: center; margin-bottom: 40px; }
    label { font-size: 1.1rem; margin-bottom: 10px; display: block; }
    input, textarea, select {
      width: 100%;
      padding: 15px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 1rem;
      margin-bottom: 20px;
    }
    button {
      background: linear-gradient(to right, var(--primary), var(--secondary));
      color: white;
      border: none;
      padding: 15px 40px;
      font-size: 1.1rem;
      border-radius: 50px;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      transition: 0.3s;
    }
    button:hover { transform: scale(1.05); }
    .error { color: red; text-align: center; margin-bottom: 20px; }
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
  <div class="container">
    <h1>เพิ่มคำถามใหม่</h1>

    <?php if (isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
      <label>หัวข้อคำถาม</label>
      <input type="text" name="title" required>

      <label>รายละเอียด</label>
      <textarea name="content" rows="6" required></textarea>

      <label>เลือกหมวดหมู่</label>
      <select name="category" required>
        <option value="สิทธิในชีวิต">สิทธิในชีวิต</option>
        <option value="สิทธิแรงงาน">สิทธิแรงงาน</option>
        <option value="สิทธิเด็ก">สิทธิเด็ก</option>
        <option value="เสรีภาพส่วนบุคคล">เสรีภาพส่วนบุคคล</option>
      </select>

      <button type="submit">บันทึกคำถาม</button>
    </form>
  </div>
</div>

</body>
</html>
