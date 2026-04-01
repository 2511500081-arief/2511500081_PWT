<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data){
        if($password == $data['password']){
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Modern</title>
    <style>
        :root {
            --card: #ffffff;
            --text: #333;
        }

        body.dark {
            --card: #2c2c3e;
            --text: #ffffff;
        }

        body {
            margin: 0;
            font-family: Arial;
            overflow: hidden;
        }

        /* PARTICLES BACKGROUND */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #0f2027;
            z-index: -1;
        }

        .login-box {
            background: var(--card);
            padding: 30px;
            width: 320px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            text-align: center;
            animation: fadeIn 0.8s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translate(-50%, -40%);}
            to {opacity: 1; transform: translate(-50%, -50%);}
        }

        .logo {
            width: 250px;
            margin-bottom: 10px;
            animation: float 2s infinite ease-in-out;
        }

        @keyframes float {
            0% {transform: translateY(0);}
            50% {transform: translateY(-8px);}
            100% {transform: translateY(0);}
        }

        h2 {
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .password-box {
            position: relative;
        }

        .toggle-pass {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4facfe;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #00c6ff;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .toggle {
            margin-top: 15px;
            cursor: pointer;
            font-size: 14px;
            color: var(--text);
        }

        /* LOADING */
        .loading {
            display: none;
            margin-top: 10px;
        }

        .spinner {
            border: 4px solid #ccc;
            border-top: 4px solid #4facfe;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            animation: spin 1s linear infinite;
            margin: auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<!-- PARTICLES -->
<div id="particles-js"></div>

<div class="login-box">

    <!-- LOGO -->
    <img src="AR_designR.png" class="logo" alt="Logo">

    <h2>Login</h2>

    <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST" onsubmit="playSound(); showLoading();">
        
        <input type="text" name="username" placeholder="Username" required>

        <div class="password-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="toggle-pass" onclick="togglePassword()">👁️</span>
        </div>

        <button type="submit" name="login">Login</button>

        <!-- LOADING -->
        <div class="loading" id="loading">
            <div class="spinner"></div>
        </div>

    </form>

    <!-- DARK MODE -->
    <div class="toggle" onclick="toggleDarkMode()">
        🌙 Dark Mode
    </div>

</div>

<!-- SOUND -->
<script>
function playSound() {
    var sound = new Audio("click.mp3");
    sound.play();
}
</script>

<!-- PARTICLES JS -->
<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

<script>
// PARTICLES CONFIG
particlesJS("particles-js", {
  "particles": {
    "number": { "value": 80 },
    "size": { "value": 3 },
    "move": { "speed": 2 },
    "line_linked": { "enable": true },
    "color": { "value": "#00f2fe" }
  },
  "interactivity": {
    "events": {
      "onhover": { "enable": true, "mode": "repulse" }
    }
  }
});

// DARK MODE
function toggleDarkMode() {
    document.body.classList.toggle("dark");
}

// SHOW / HIDE PASSWORD
function togglePassword() {
    var pass = document.getElementById("password");
    pass.type = (pass.type === "password") ? "text" : "password";
}

// SOUND
function playSound() {
    document.getElementById("clickSound").play();
}

// LOADING
function showLoading() {
    document.getElementById("loading").style.display = "block";
}
</script>

</body>
</html>