<?php
require 'db_connect.php';
session_start();

$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>บทความความรู้ - Q&A สิทธิมนุษยชน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00bcd4;
      --secondary: #009688;
      --accent: #64dd17;
      --success: #00c853;
      --light: #e0f7fa;
      --background: #f5fefe;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Kanit', sans-serif;
      background: var(--background);
      display: flex;
      height: 100vh;
      overflow: hidden;
      line-height: 1.6;
    }

    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, var(--secondary), var(--primary));
      color: white;
      padding: 20px;
      box-shadow: 3px 0 10px rgba(0,0,0,0.2);
    }
    .sidebar h2 {
      font-size: 1.8rem;
      margin-bottom: 40px;
      text-align: center;
    }
    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      margin-bottom: 15px;
      font-size: 1.1rem;
      padding: 10px 20px;
      border-radius: 10px;
      transition: 0.3s;
    }
    .sidebar a:hover {
      background: rgba(255,255,255,0.15);
    }

    .main {
      flex: 1;
      padding: 40px;
      overflow-y: auto;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 40px 30px;
      border-radius: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    h1 {
      color: var(--secondary);
      font-size: 2rem;
      text-align: center;
      margin-bottom: 40px;
      font-weight: 700;
    }

    .article-card {
      background: var(--light);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
      transition: 0.3s;
    }
    .article-card:hover {
      transform: translateY(-5px);
    }
    .article-card h3 {
      font-size: 1.4rem;
      color: var(--secondary);
      margin-bottom: 15px;
    }
    .article-card p {
      font-size: 1rem;
      color: #555;
    }
    .article-card .meta {
      font-size: 0.85rem;
      color: #777;
      margin-top: 10px;
    }

    .article h2 {
      font-size: 1.6rem;
      color: var(--primary);
      margin-bottom: 15px;
      font-weight: 600;
    }
    .article p {
      color: #444;
      font-size: 1rem;
      line-height: 1.8;
      margin-bottom: 20px;
    }
    .date {
      font-size: 0.9rem;
      color: #777;
      text-align: right;
      margin-top: 10px;
    }
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
    <h1>บทความน่ารู้เกี่ยวกับสิทธิมนุษยชน</h1>

    <div class="article-card">
      <h3>สิทธิมนุษยชนคืออะไร?</h3>
      <p>สิทธิมนุษยชนคือสิทธิขั้นพื้นฐานที่ทุกคนพึงมีตั้งแต่เกิด ไม่ว่าจะเป็นสิทธิในการมีชีวิต เสรีภาพในการแสดงออก สิทธิในการได้รับการศึกษา และสิทธิในการได้รับความปลอดภัยจากความรุนแรง การละเมิดสิทธิมนุษยชนส่งผลกระทบต่อคุณภาพชีวิตและความยุติธรรมในสังคม</p>
      <div class="meta">
        <span>เผยแพร่เมื่อ 20 มิถุนายน 2025</span>
      </div>
    </div>

    <div class="article-card">
      <h3>ความสำคัญของสิทธิเสรีภาพในการแสดงความคิดเห็น</h3>
      <p>เสรีภาพในการแสดงความคิดเห็นเป็นหัวใจสำคัญของสังคมประชาธิปไตย เปิดโอกาสให้ประชาชนสามารถแลกเปลี่ยนความคิดเห็น ตรวจสอบการทำงานของภาครัฐ และร่วมกันพัฒนาสังคม หากสิทธินี้ถูกจำกัด อาจนำไปสู่การขาดความโปร่งใสและการละเมิดสิทธิอื่นๆ ตามมา</p>
      <div class="meta">
        <span>เผยแพร่เมื่อ 18 มิถุนายน 2025</span>
      </div>
    </div>

    <div class="article-card">
      <h3>สิทธิเด็ก: การปกป้องอนาคตของสังคม</h3>
      <p>เด็กทุกคนมีสิทธิได้รับการดูแล การศึกษา และความคุ้มครองจากความรุนแรง การล่วงละเมิดและการแสวงหาประโยชน์โดยมิชอบ สังคมต้องร่วมกันสร้างสภาพแวดล้อมที่ปลอดภัย สนับสนุนการเติบโตอย่างมีคุณภาพ และให้ความสำคัญกับเสียงของเด็กในทุกมิติ</p>
      <div class="meta">
        <span>เผยแพร่เมื่อ 15 มิถุนายน 2025</span>
      </div>
    </div>

  </div>
</div>

</body>
</html>
