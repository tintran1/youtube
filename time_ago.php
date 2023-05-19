<?php

function timeAgo($time_ago)
{
    $cur_time     = time();
    $time_elapsed     = $time_ago - $cur_time;
    $seconds     = $time_elapsed;
    $minutes     = round($time_elapsed / 60);
    $hours         = round($time_elapsed / 3600);
    $days         = round($time_elapsed / -86400);
    $weeks         = round($time_elapsed / -604800);
    $months     = round($time_elapsed / -2600640);
    $years         = round($time_elapsed / -31207680);
    // Seconds
    if (0 < $seconds && $seconds <= 60) {
        echo "$seconds giây trước";
    }
    //Minutes
    else if (0 < $minutes && $minutes <= 60) {
        if ($minutes == 1) {
            echo "1 phút trước";
        } else {
            echo "$minutes phút trước";
        }
    }
    //Hours
    else if (0 < $hours && $hours <= 24) {
        if ($hours == 1) {
            echo "1 giờ trước";
        } else {
            echo "$hours giờ trước";
        }
    }
    //Days
    else if (0 < $days && $days <= 7) {
        if ($days == 1) {
            echo "1 ngày trước";
        } else {
            echo "$days ngày trước";
        }
    }
    //Weeks
    else if (0 < $weeks && $weeks <= 4.3) {
        if ($weeks == 1) {
            echo "1 tuần trước";
        } else {
            echo "$weeks tuần trước";
        }
    }
    //Months
    else if (0 < $months && $months <= 12) {
        if ($months == 1) {
            echo "1 tháng trước";
        } else {
            echo "$months tháng trước";
        }
    }
    //Years
    else {
        if (0 < $years && $years == 1) {
            echo "1 năm trước";
        } else {
            echo "$years năm trước";
        }
    }
}

?>