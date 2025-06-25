<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ติดต่อเรา - Q&A สิทธิมนุษยชน</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    :root { --primary: #00bcd4; --secondary: #009688; --accent: #64dd17; --success: #00c853; --dark: #004d40; --light: #e0f7fa; --background: #f5fefe; }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Kanit', sans-serif; background: var(--background); display: flex; height: 100vh; overflow: hidden; }

    .sidebar {
      width: 240px;
      background: linear-gradient(to bottom, var(--secondary), var(--primary));
      color: white;
      padding: 20px;
      box-shadow: 3px 0 10px rgba(0,0,0,0.2);
    }
    .sidebar h2 { font-size: 1.8rem; margin-bottom: 40px; text-align: center; }
    .sidebar a {
      display: block; color: white; text-decoration: none;
      margin-bottom: 15px; font-size: 1.1rem;
      padding: 10px 20px; border-radius: 10px; transition: 0.3s;
    }
    .sidebar a:hover { background: rgba(255,255,255,0.15); }

    .main { flex: 1; padding: 40px; overflow-y: auto; }
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 40px 30px;
      border-radius: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    h1 { color: var(--secondary); font-size: 2rem; text-align: center; margin-bottom: 40px; }
    p { font-size: 1rem; color: #555; line-height: 1.7; }

    .contact-box {
      margin-top: 30px;
      padding: 20px;
      background: var(--light);
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    .contact-box p { font-size: 1rem; margin: 10px 0; }
  </style>
</head>
<body>

  <!-- Sidebar -->
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

  <!-- Main Content -->
  <div class="main">
    <div class="container">
      <h1>ติดต่อเรา</h1>

      <p>หากคุณมีข้อสงสัย ต้องการขอคำแนะนำ แจ้งปัญหาการใช้งาน หรือให้ข้อเสนอแนะเกี่ยวกับเว็บไซต์ Q&A สิทธิมนุษยชน กรุณาติดต่อทีมงานผ่านช่องทางด้านล่างนี้</p>

      <div class="contact-box">
        <p><strong>อีเมล:</strong> support@humanrightsqa.com</p>
        <p><strong>เบอร์โทรศัพท์:</strong> 02-123-4567 (เวลาทำการ 09.00-17.00 น.)</p>
        <p><strong>Facebook:</strong> facebook.com/humanrightsqa</p>
        <p><strong>ที่อยู่สำนักงาน:</strong> ศูนย์ข้อมูลสิทธิมนุษยชน เลขที่ 99 ถนนประชาธิปไตย แขวงเสรีภาพ เขตกลางเมือง กรุงเทพมหานคร 10000</p>
      </div>

      <p style="margin-top: 30px;">ทีมงานจะดำเนินการตรวจสอบและตอบกลับโดยเร็วที่สุด ขอบคุณที่ร่วมเป็นส่วนหนึ่งในการสร้างสังคมแห่งการเคารพสิทธิมนุษยชนร่วมกัน</p>
    </div>
  </div>

</body>
</html>
