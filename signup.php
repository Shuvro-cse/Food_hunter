<?php
include "db.php";

$message = "";
$name = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirmPassword"] ?? "";

    if ($name === "" || $email === "" || $password === "" || $confirmPassword === "") {
        $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if ($checkStmt) {
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $message = "Email already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("sss", $name, $email, $hashedPassword);

                    if ($stmt->execute()) {
                        $message = "Signup successful!";
                        $name = "";
                        $email = "";
                    } else {
                        $message = "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $message = "SQL prepare failed: " . $conn->error;
                }
            }

            $checkStmt->close();
        } else {
            $message = "Email check failed: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Food Hunter | Sign Up</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<header class="site-header">
  <div class="container header-row">
    <a class="logo-box" href="index.html">
      <img src="images/logo.png" alt="The Food Hunter logo" class="logo-img">
    </a>

    <nav class="nav-bar" aria-label="Primary navigation">
      <a class="nav-btn" href="index.html">Home</a>
      <a class="nav-btn" href="reviews.html">Reviews</a>
      <a class="nav-btn" href="homemade.html">Homemade</a>
      <a class="nav-btn" href="map.html">Map</a>
      <a class="nav-btn" href="about.html">About</a>
      <a class="nav-btn active" href="signup.php">Sign Up</a>
    </nav>
  </div>
</header>

<main class="site-main container">
  <section class="page-title">
    <h1>Sign Up</h1>
    <p>Create your Food Hunter account</p>
  </section>

  <form id="signupForm" method="POST" action="signup.php" class="signup-card">
    <input type="text" id="name" name="name" placeholder="Your Name"
      value="<?php echo htmlspecialchars($name); ?>" required>

    <input type="email" id="email" name="email" placeholder="Your Email"
      value="<?php echo htmlspecialchars($email); ?>" required>

    <input type="password" id="password" name="password" placeholder="Password" required>

    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>

    <button type="submit" class="submit-btn">Sign Up</button>

    <p id="signupError"><?php echo htmlspecialchars($message); ?></p>
  </form>
</main>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container footer-inner">
      <p>The Food Hunter</p>
      <small>&copy; 2026 The Food Hunter. All rights reserved.</small>
    </div>
  </footer>

<script src="signup-validation.js"></script>
</body>
</html>