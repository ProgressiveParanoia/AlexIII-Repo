﻿<?php
    session_start();
	session_destroy();
    $_SESSION = [];

	require_once "config.php";

	$username = $password = "";
	$username_err = $password_err = "";

		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$input_user = trim($_POST["username"]);
			$input_pass = trim($_POST["password"]);

			if(empty($input_user))
			{
				$username_err = "Please enter a username";
			}
			else
			{
				$username = $input_user;
			}

			//Check if password is empty

			if(empty($input_pass))
			{
				$password_err = "Please enter your password.";
			}else{
				$password = $input_pass;
			}

			//Validate credentials

			if(empty($username_err) && empty($password_err))
			{
				$sql = "SELECT id, username, password FROM user WHERE username = ?";
				if($statement = mysqli_prepare($link, $sql))
				{
					mysqli_stmt_bind_param($statement, "s", $param_username);

					$param_username = $username;

					//Attempt to execute user statement
					if(mysqli_stmt_execute($statement))
					{
						mysqli_stmt_store_result($statement);

						//Check if usuer exists
						if(mysqli_stmt_num_rows($statement) == 1)
						{
							//if user exists, start password verification
							mysqli_stmt_bind_result($statement, $id, $username, $hashed_password);

							if(mysqli_stmt_fetch($statement))
							{
								if(password_verify($password, $hashed_password))
								{
									//if password is correct, create a session
									session_start();

									$_SESSION['loggedin'] = true;
									$_SESSION['id'] = $id;
									$_SESSION['username'] = $username;
                                   //echo "<script>location = 'http://presidentialcarmuseum.000webhostapp.com/admin///dashgum/assets/index.php'</script>";
									header("Location: index.php");
								}else
								{
		                            // Display an error message if password is not valid
		                            $password_err = "The password you entered was not valid.";
                        		}
							}
						}else
						{
							$username_err = "No account found with that username.";
						}
					}else{
						echo "Oops something went wrong! Try again!";
					}
							//close the SQSL statement
				mysqli_stmt_close($statement);
				}
			}
		}
		//close access to db
		mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" name="username" class="form-control" placeholder="User ID" autofocus>
		            <span class="help-block"><?php echo $username_err; ?></span>
		            <br>
		            <input type="password" name="password" class="form-control" placeholder="Password">
		            <span class="help-block"><?php echo $password_err; ?></span>
		            <!--<label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>-->
		            <button class="btn btn-theme btn-block" value="Login" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		           <!--
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="#">
		                    Create an account
		                </a>
		            </div>
		-->
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="button">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>