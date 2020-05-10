<?php
    include 'cron_job.php';
    require_once '../config.php';
    class ClearOrder extends CronJob{
        
        //$devliery_data = 
        public function fetchData(){
            $sql = "SELECT * FROM deliveries";
            if($statement_get = mysqli_prepare($link, $sql))
            {
              if(mysqli_stmt_execute($statement_get))
              {
                $result_set = mysqli_stmt_get_result($statement_get);
                $delivery_data = mysqli_fetch_all($result_set);
                print_r($delivery_data);
              }
            }
        }

        public function run(){
            
        }

    }
?>