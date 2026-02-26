<?php
// DATABASE CONNECTION
$conn = new mysqli("localhost", "root", "", "login_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple query (For demo purposes)
    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password' 
            AND is_active=1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "<span style='color:green;'>Login Successful!</span>";
    } else {
        $message = "<span style='color:red;'>Invalid Username or Password</span>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #4e73df, #1cc88a);
        }

        .container {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        .error {
            color: red;
            font-size: 13px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4e73df;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #2e59d9;
        }

        .message {
            text-align: center;
            margin-top: 10px;
        }
    </style>

    <script>
        function validateLogin() {
            let username = document.getElementById("username").value;
            let password = document.getElementById("password").value;
            let errorMsg = "";

            if (username.length < 3) {
                errorMsg = "Username must be at least 3 characters";
            } 
            else if (password.length < 3) {
                errorMsg = "Password must be at least 3 characters";
            }

            if (errorMsg !== "") {
                document.getElementById("error").innerText = errorMsg;
                return false;
            }

            document.getElementById("error").innerText = "";
            return true;
        }
    </script>

</head>
<body>

<div class="container">
    <h2>Login Page</h2>

    <form method="POST" onsubmit="return validateLogin()">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">

        <div id="error" class="error"></div>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="message">
        <?php echo $message; ?>
    </div>
</div>

</body>
</html>