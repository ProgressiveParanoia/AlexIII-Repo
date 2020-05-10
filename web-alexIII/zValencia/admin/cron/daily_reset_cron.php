<?php
    $daily_crons = array(new ClearOrder());

   foreach($daily_crons as $cron)
   {
       $cron->fetchData();
   }
?>