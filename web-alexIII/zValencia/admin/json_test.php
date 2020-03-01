<?php
  require_once "config.php";
  
  $menu_data = null;
  $item_id = 0; 
  $item_price = 0;

  $item_title = "";
  $item_description = "";

    $sql = "SELECT * FROM delivery_menu";

    if($statement_get = mysqli_prepare($link, $sql))
    {
      if(mysqli_stmt_execute($statement_get))
      {
        $result_set = mysqli_stmt_get_result($statement_get);
        $menu_data = mysqli_fetch_all($result_set);
      }
    }

    $json = json_encode($menu_data);
    echo "Json:". print_r($json);

    $sql = "INSERT INTO `test_json` (`json`) VALUES (?)";

    if($statement_get = mysqli_prepare($link, $sql))
    {
      mysqli_stmt_bind_param($statement_get, "s", $p1);

      $p1 = $json;
      if(mysqli_stmt_execute($statement_get))
      {
 
      }
    }

    $decoded = json_decode($json);
    echo "Decoded: ".print_r($decoded);
?>