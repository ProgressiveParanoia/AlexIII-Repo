<?php
  require_once "admin/config.php";

 $file_dir = "admin/uploads/delivery_menu/";
 $current_session_id = isset($_COOKIE["delivery_id"]) ? $_COOKIE["delivery_id"] : "";
 
 if($current_session_id == ""){
             echo "<script>
                   alert('Invalid session Id!');
                   //window.location.href = 'http://alexiiirestaurant.com/delivery.php';
                   window.location.href = 'http://localhost/AlexIII_Repo/web-alexIII/delivery.php';
               </script>"; 
 }
 
  $user_cart = array();
  $cart_size = 0;
  $res_id = "";
  $sql = "SELECT res_id,cart, res_name, res_tel,res_email, address FROM deliveries WHERE res_id=".$current_session_id;
    if($statement = mysqli_prepare($link, $sql))
      {
          if(mysqli_stmt_execute($statement))
          {
             # mysqli_stmt_store_result($statement);
             $result_set = ( mysqli_stmt_get_result($statement));
             $rows = mysqli_fetch_array($result_set);
             $json_string = $rows['cart'];
             $name = $rows['res_name'];
             $number = $rows['res_tel'];
             $email = $rows['res_email'];
             $address = $rows['address'];
             $res_id = $rows['res_id'];
          }
          $str = $json_string . "~" . $name . "~" . $number . "~".$email."~".$address."~".$res_id;
          mysqli_stmt_close($statement);
          echo $str;
        }
?>