<?php
 include('db.php');

$message = "";
$message_class = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Connect to your MySQL Database
   

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 2. Collect and clean inputs
    $username = trim($_POST['name']);
    $password = $_POST['pwd'];

    // 3. Check if the username is already taken
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE name = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $message = "Username is already taken!";
        $message_class = "error";
    } else {
        // 4. Generate the unpredictable Unique ID (e.g., usr_a4f2e9b1)
        $unique_id = "user_" . bin2hex(random_bytes(4));

        // 5. Securely hash the password (never store plain text!)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // 6. Insert the new user into the database
        $insert_stmt = $conn->prepare("INSERT INTO users (id, name, pwd) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("sss", $unique_id, $username, $hashed_password);

        if ($insert_stmt->execute()) {
            // Success! Show them their new unique ID
            $message = "Registration successful! Your Login ID is: <strong>" . $unique_id . "</strong>";
            $message_class = "success";
        } else {
            $message = "Something went wrong. Please try again.";
            $message_class = "error";
        }
        $insert_stmt->close();
    }
    $check_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        body {
            background-color: rgb(234, 203, 255);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }
        .register-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        .input-group {
            display: flex;
            justify-content: center; 
            align-items: center;     
            gap: 10px;               
            margin-bottom: 15px;     
        }
        label {
            width: 80px;
            text-align: right;
        }
        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 180px;
        }
        .msg {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
            padding: 8px;
            border-radius: 4px;
        }
        .error { color: #721c24; background: #f8d7da; border: 1px solid #f5c6cb; }
        .success { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; }
        
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 8px 20px;
             background: linear-gradient(magenta,indigo,purple);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: blue;
            font-family: 'Times New Roman';
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <h1 style="text-align:center; margin-top: 0;">Register</h1>
        
        <!-- Status Messages -->
        <?php if (!empty($message)): ?>
            <div class="msg <?php echo $message_class; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="input-group">
                <label for="Name">Name:</label>
                <input type="text" name="name" id="Name" placeholder="Choose Username" autocomplete="off" required>
            </div>
            
            <div class="input-group">
                <label for="pwd">Password:</label>
                <input type="password" name="pwd" id="pwd" placeholder="Choose Password" autocomplete="new-password" required>
            </div>

            <div class="btn-container">
                <button type="submit">Create Account</button>
            </div>
        </form>

        <a href="login.php" class="login-link">Already have an account? Login here</a>
    </div>
    
</body>
</html>
