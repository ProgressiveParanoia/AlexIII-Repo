<?php
  require_once "config.php";
  
  session_start();
  if(!isset($_SESSION['username']) && empty($_SESSION['username']) === true)
  {
    header("Location: login.php");
  }

  //accept/reject actions
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(array_key_exists("res_accept", $_POST))  
    {
      $accepted_entry = $_POST["res_accept"];
      $sql_accept = "UPDATE reservations SET verified = 1, changed_verification = 1 WHERE res_id = ?";
      if($statement = mysqli_prepare($link, $sql_accept))
      {
        mysqli_stmt_bind_param($statement, "s", $accepted_entry);

        if(mysqli_stmt_execute($statement)){
        }
      }
      mysqli_stmt_close($statement);
    }
    else
    if(array_key_exists("res_decline", $_POST))
    {
      $declined_entry = $_POST["res_decline"];
      $sql_decline = "UPDATE reservations SET verified = 0, changed_verification = 1 WHERE res_id = ?";
      if($statement = mysqli_prepare($link, $sql_decline))
      {
        mysqli_stmt_bind_param($statement, "s", $declined_entry);

        if(mysqli_stmt_execute($statement)){
        }
      }
      mysqli_stmt_close($statement);
    }
  }
//end accept/reject  

// SETUP PENDING RESERVATION TABLE
  $header_array = array("ID", "NAME", "EMAIL", "CONTACT NUMBER", "NOTES", "RESERVATION DATE", "TIME START", "TIME END", "BRANCH ADDRESS", "GUEST COUNT", "PARTY PACKAGE");
  $reservation_entries = null;
  
  $sql_pending = "SELECT res_id, res_name, res_email, res_tel, res_notes, res_date, res_start, res_end, branch_address, res_persons_count, res_package FROM reservations WHERE changed_verification = 0";

    if($statement = mysqli_prepare($link, $sql_pending))
    {
        if(mysqli_stmt_execute($statement))
        {
          $result_set = ( mysqli_stmt_get_result($statement));
          $rows = mysqli_fetch_all($result_set);
        }
    }
    //END PENDING
    //accepted
    $sql_accepted = "SELECT res_id, res_name, res_email, res_tel, res_notes, res_date, res_start, res_end, branch_address, res_persons_count, res_package FROM reservations WHERE changed_verification = 1 AND verified = 1";

    if($statement = mysqli_prepare($link, $sql_accepted))
    {
        if(mysqli_stmt_execute($statement))
        {
          $result_set = ( mysqli_stmt_get_result($statement));
          $rows_accepted = mysqli_fetch_all($result_set);
        }
    }
    //end accepted
    $sql_decline = "SELECT res_id, res_name, res_email, res_tel, res_notes, res_date, res_start, res_end, branch_address, res_persons_count, res_package FROM reservations WHERE changed_verification = 1 AND verified = 0";

    if($statement = mysqli_prepare($link, $sql_decline))
    {
        if(mysqli_stmt_execute($statement))
        {
          $result_set = ( mysqli_stmt_get_result($statement));
          $rows_decline = mysqli_fetch_all($result_set);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Alex III Content Management System</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
 
                <!--  notification end -->
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/profile.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Admin</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Reservation</span>
                      </a>
                      <a href="order_tracker.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Order Tracker</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-wrench"></i>
                          <span>Edit Page</span>	<!--Edit Website Stuff-->
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_home.php">Edit Home</a></li>        
                          <li><a  href="edit_gallery.php">Edit Gallery</a></li>
                          <li><a  href="edit_menu.php">Edit Menu</a></li>
                          <li><a  href="edit_delivery.php">Edit Delivery</a></li>   
                        <!--
                          <li><a  href="edit_home.php">Edit Home</a></li>			      
                          <li><a  href="edit_about.php">Edit About</a></li>		     
                          <li><a  href="edit_management.php">Edit Management</a></li>			      
                          <li><a  href="edit_how_to.php">Edit How to</a></li>		      
						  <li><a  href="edit_gallery.php">Edit Gallery</a></li>		      
						  <li><a  href="edit_contacts.php">Edit Contacts</a></li>		      
            -->
					  </ul>
                  </li>
                  <!--
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Manage Application</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="app_manager.html">AR App</a></li>	
                      </ul>
                  </li>
                -->
                  <li class="sub-menu">
                      <a href="login.php">
                          <i class="fa fa-power-off"></i>
                          <span>Logout</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <!--main content start-->
       <section id="main-content">
          <section class="wrapper">
            <div class="tab-pane" id="chartjs">
              <!--Pending -->
              <div class="row mt">
                <div class="col-lg-12">
                  <div class="content-panel">
                    <center><h1>Pending Reservations</h1>
                    <?php 
                      echo "<table>";
                        //headers
                        echo "<tr>";
                        for($i = 0; $i < count($header_array); $i++)
                        {
                          $current_header = $header_array[$i];
                          echo "<th>".$current_header."</th>";
                        }
                        echo "</tr>";
                        //entries
                        $row_size = count($rows);
                        for($x = 0; $x < $row_size; $x++)
                        {
                          echo "<tr>";
                          $reservation_entries = $rows[$x];
                          $res_size = count($reservation_entries); //divide by two since its associative array is being counted too.
                          for($i = 0; $i < $res_size; $i++)
                          {
                            $current_entry = $rows[$x][$i];//$reservation_entries[$i];
                            if($i == 6 || $i == 7)
                            {
                              echo "<td>".$current_entry.":00</td>";
                            }else{
                              echo "<td>".$current_entry."</td>";
                            }
                          }
                          echo "<form method='post'>";
                          echo "<td><button type='submit' class='btn btn-round btn-success' name='res_accept' value='".$rows[$x][0]."''>Accept</button>";
                          echo "<button type='submit' class='btn btn-round btn-failed' name='res_decline' value='".$rows[$x][0]."'>Cancel</button></td>";
                          echo "</tr>";
                          echo "</form>";
     
                        }
                      echo "</table>";
                    ?>
                    </center>
                </div>
            </div>
           </div>
           <!-- accepted -->
           <div class="row mt">
                <div class="col-lg-12">
                  <div class="content-panel">
                    <center><h1>Accepted Reservations</h1>
                    <?php 
                      echo "<table>";
                        //headers
                        echo "<tr>";
                        for($i = 0; $i < count($header_array); $i++)
                        {
                          $current_header = $header_array[$i];
                          echo "<th>".$current_header."</th>";
                        }
                        echo "</tr>";
                        //entries
                        $row_size = count($rows_accepted);
                        for($x = 0; $x < $row_size; $x++)
                        {
                          echo "<tr>";
                          $reservation_entries = $rows_accepted[$x];
                          $res_size = count($reservation_entries); //divide by two since its associative array is being counted too.
                          for($i = 0; $i < $res_size; $i++)
                          {
                            $current_entry = $rows_accepted[$x][$i];//$reservation_entries[$i];
                            if($i == 6 || $i == 7)
                            {
                              echo "<td>".$current_entry.":00</td>";
                            }else{
                              echo "<td>".$current_entry."</td>";
                            }
                          }
                          echo "<form method='post'>";
                          echo "<td><button type='submit' class='btn btn-round btn-success' name='res_accept' value='".$rows_accepted[$x][0]."''>Accept</button>";
                          echo "<button type='submit' class='btn btn-round btn-failed' name='res_decline' value='".$rows_accepted[$x][0]."'>Cancel</button></td>";
                          echo "</tr>";
                          echo "</form>";
     
                        }
                      echo "</table>";
                    ?>
                    </center>
                </div>
            </div>
           </div>
          <!-- decline -->
           <div class="row mt">
                <div class="col-lg-12">
                  <div class="content-panel">
                    <center><h1>Cancelled Reservations</h1>
                    <?php 
                      echo "<table>";
                        //headers
                        echo "<tr>";
                        for($i = 0; $i < count($header_array); $i++)
                        {
                          $current_header = $header_array[$i];
                          echo "<th>".$current_header."</th>";
                        }
                        echo "</tr>";
                        //entries
                        $row_size = count($rows_decline);
                        for($x = 0; $x < $row_size; $x++)
                        {
                          echo "<tr>";
                          $reservation_entries = $rows_decline[$x];
                          $res_size = count($reservation_entries); //divide by two since its associative array is being counted too.
                          for($i = 0; $i < $res_size; $i++)
                          {
                            $current_entry = $rows_decline[$x][$i];//$reservation_entries[$i];
                            if($i == 6 || $i == 7)
                            {
                              echo "<td>".$current_entry.":00</td>";
                            }else{
                              echo "<td>".$current_entry."</td>";
                            }
                          }
                          echo "<form method='post'>";
                          echo "<td><button type='submit' class='btn btn-round btn-success' name='res_accept' value='".$rows_decline[$x][0]."''>Accept</button>";
                          echo "<button type='submit' class='btn btn-round btn-failed' name='res_decline' value='".$rows_decline[$x][0]."'>Cancel</button></td>";
                          echo "</tr>";
                          echo "</form>";
     
                        }
                      echo "</table>";
                    ?>
                    </center>
                </div>
            </div>
           </div>
            <!--
          <h3><i class="fa fa-angle-right"></i> Graph</h3>
        -->
              <!-- page start-->
              <!--
              <div class="tab-pane" id="chartjs">
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Doughnut</h4>
                              <div class="panel-body text-center">
                                  <canvas id="doughnut" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Line</h4>
                              <div class="panel-body text-center">
                                  <canvas id="line" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Radar</h4>
                              <div class="panel-body text-center">
                                  <canvas id="radar" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Polar Area</h4>
                              <div class="panel-body text-center">
                                  <canvas id="polarArea" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Bar</h4>
                              <div class="panel-body text-center">
                                  <canvas id="bar" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Pie</h4>
                              <div class="panel-body text-center">
                                  <canvas id="pie" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            -->
              <!-- page end-->
          </section>          
      </section><!-- /MAIN CONTENT -->
      <!--main content end-->

  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/chartjs-conf.js"></script>
	
  <!--
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Presidential Car Museum',
            // (string | mandatory) the text inside the notification
            text: 'Official admin website for Presidential Car Museum',
            // (string | optional) the image to display on the left
            image: 'assets/img/paragon1.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '3',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	-->
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
	
  

  </body>
</html>
