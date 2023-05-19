<?php
// set múi giờ mặc định là vn
date_default_timezone_set('Africa/Casablanca');

// date_time_sql là data lấy từ mysql, datetime lúc chèn vào mysql là múi giờ vn
$date_time_sql = '2022-11-06 10:00:00';

$currentDateTime = new DateTime();

$currentDateTime->format('Y-m-d H:i:s');

// code giờ mỹ
// $currentDateTime->setTimezone(new DateTimeZone("America/New_York"));
// echo $currentDateTime->format("Y-m-d H:i:s e") . "\n";
// 

calculatorDatetime($date_time_sql, $currentDateTime);

function calculatorDatetime($date_time_sql, $currentDateTime) {
	$date1 = strtotime($date_time_sql);
	$date2 = strtotime($currentDateTime->format('Y-m-d H:i:s'));


	$diff = abs($date1 - $date2);


	$years = floor($diff / (365*60*60*24));
 

	$months = floor(($diff - $years * 365*60*60*24)
                                 / (30*60*60*24));
 

	$days = floor(($diff - $years * 365*60*60*24 -
               $months*30*60*60*24)/ (60*60*24));
 

	$hours = floor(($diff - $years * 365*60*60*24
         - $months*30*60*60*24 - $days*60*60*24)
                                     / (60*60));
 

	$minutes = floor(($diff - $years * 365*60*60*24
           - $months*30*60*60*24 - $days*60*60*24
                            - $hours*60*60)/ 60);
 

	$seconds = floor(($diff - $years * 365*60*60*24
           - $months*30*60*60*24 - $days*60*60*24
                  - $hours*60*60 - $minutes*60));
 

	printf("%d years, %d months, %d days, %d hours, "
       . "%d minutes, %d seconds", $years, $months,
        $days, $hours, $minutes, $seconds);
}
?>