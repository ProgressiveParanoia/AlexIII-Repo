<?php
    
    $verified = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['g-recaptcha-response']) == false){
            $verified = true;
        }
        print_r($_POST);
    }
?>
<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="6LfRY-EUAAAAAFP3Eowrv1NXKVJGCM5dVS-n1XcW"></div>
      <br/>
      <?php
        echo "<input type='submit' value='Submit'>";
      ?>
    </form>
  </body>
</html>
