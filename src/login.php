<?php
session_start();
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Connect to your MySQL Database (Change credentials if yours are different)
    include('db.php');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 2. Collect inputs from the form
    $login_input = trim($_POST['name']); 
    $password_input = $_POST['pwd'];

    // 3. Look for a match against EITHER 'id' OR 'name'
    $stmt = $conn->prepare("SELECT id, name, pwd FROM users WHERE id = ? OR name = ?");
    $stmt->bind_param("ss", $login_input, $login_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // 4. Verify password against the hashed database value
        if (password_verify($password_input, $row['pwd'])) {
            // Store details in session
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];

            // 5. Redirect successfully logged-in user to index.php
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Kata laluan salah!";
        }
    } else {
        $error_message = "Id Pengguna atau Nama tidak dijumpai!";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Centers the entire login box on the screen */
        body {
            background-color: rgb(234, 203, 255);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }

        /* The white card container holding the form */
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 320px;
        }

        /* Row wrapper: centers the input, keeps label on its left */
        .input-group {
            display: flex;
            justify-content: center; 
            align-items: center;     
            gap: 10px;               
            margin-bottom: 15px;     
        }

        /* Makes both labels the same width so inputs line up perfectly */
        label {
            width: 80px;
            text-align: right;
        }

        /* Basic input styling */
        input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        /* Styling for the error text banner */
        .error-banner {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Styles the login button to fill the width */
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
            font-weight: bold;
        }

        .link-container {
            text-align: center;
            margin-top: 15px;
        }

    </style>
</head>
<body>

    <div class="login-card">
        <h1 style="text-align:center; margin-top: 0;">Login</h1>

        <!-- Error feedback notification banner -->
        <?php if (!empty($error_message)): ?>
            <div class="error-banner"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <!-- Wrapped inside a proper POST form element pointing back to itself -->
        <form action="login.php" method="POST">
            <!-- Username / ID Row -->
            <div class="input-group">
                <label for="Name">Name/ID:</label>
                <input type="text" name="name" id="Name" placeholder="Nama atau ID" autocomplete="off" required>
            </div>
            
            <!-- Password Row -->
            <div class="input-group">
                <label for="pwd">Password:</label>
                <input type="password" name="pwd" id="pwd" placeholder="Kata Laluan" autocomplete="new-password" required>
            </div>

            <!-- Button Row -->
            <div class="btn-container">
                <button type="submit">Login</button>
            </div>
        </form>

        <div class="link-container">
            <a href="register.php" style="font-family:'Times New Roman'; color:blue; text-decoration: none;">Tiada akaun? Daftar sini</a>
        </div>
    </div>
    
</body>
</html>
