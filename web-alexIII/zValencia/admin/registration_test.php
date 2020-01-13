<?php
	require_once "config.php";

	$username = "";
	$password = "";
	$confirm_password = "";

	$username_err = "";
	$password_err = "";
	$confirm_password_err = "";

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//user validation
		$input_user = trim($_POST["username"]);
		$input_password = trim($_POST["password"]);

		if(empty($input_user))
		{
			$username_err = "Please enter a username.";
		}else
		{
			$sql_command = "SELECT id FROM users WHERE username = ?";

			//start connection with database
			if($statement = mysqli_prepare($link, $sql_command))
			{
				mysqli_stmt_bind_param($statement, "s", $param_username);

				$param_username = $input_user;

				//Attempt to execute the prepared statement
				if(mysqli_stmt_execute($statement)){
					//cache result
					mysqli_stmt_store_result($statement);
					
					if(mysqli_stmt_num_rows($statement) == 1){
						$username_err = "User already taken!";
					}else{
						$username = $input_user;
					}
				}else{
					echo "Something went wrong! Please try again later.";
				}
			}

			// Close connection
			mysqli_stmt_close($statement);
		}

		//Validate password
		if(empty($input_password)){
			$password_err = "Please enter a password!";
		}else{
			$password = $input_password;
		}

		if(empty($username_err) && empty($password_err)) //new user is valid
		{
			$sql_command = "INSERT INTO users (username, password) VALUES (?, ?)";

			//get user info
			if($statement = mysqli_prepare($link, $sql_command)){
				mysqli_stmt_bind_param($statement, "ss",$param_username, $param_password);

				//set parameters
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT);

				//Attempt to connect to database
				if(mysqli_stmt_execute($statement)){
					header("location: login_test.php");
				}else{
					echo "Something went wrong!";
				}
			}
			mysqli_stmt_close($statement);
		}

		//close overall connection


		mysqli_close($link);
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
   <!--         <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

        -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login_test.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>