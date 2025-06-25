<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);  // ไม่มี hash

  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $password);

  if ($stmt->execute()) {
    header("Location: login.php");
    exit;
  } else {
    $error = "ชื่อผู้ใช้นี้มีอยู่แล้ว!";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>สมัครสมาชิก</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00bcd4;
      --secondary: #009688;
      --accent: #64dd17;
      --success: #00c853;
      --dark: #004d40;
      --light: #e0f7fa;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Kanit', sans-serif;
      background: linear-gradient(135deg, var(--light), #ffffff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: rgba(255, 255, 255, 0.98);
      padding: 50px 40px;
      border-radius: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      width: 400px;
      max-width: 90%;
      text-align: center;
      backdrop-filter: blur(10px);
    }

    h2 {
      font-size: 2rem;
      color: var(--secondary);
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 15px;
      margin: 15px 0;
      border-radius: 50px;
      border: 1px solid #ccc;
      font-size: 1rem;
      box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
      outline: none;
    }

    button {
      background: linear-gradient(to right, var(--success), var(--accent));
      color: white;
      padding: 15px;
      border: none;
      border-radius: 50px;
      width: 100%;
      font-size: 1.2rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.05);
    }

    .error {
      color: red;
      margin-bottom: 20px;
    }

  </style>
</head>
<body>

  <div class="card">
    <h2>สมัครสมาชิก</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
      <input type="password" name="password" placeholder="รหัสผ่าน" required>
      <button type="submit">สมัครสมาชิก</button>
    </form>
  </div>

</body>
</html>
