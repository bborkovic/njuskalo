<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message() {
  global $session;
  $message_array = $session->message();
  
  if( !empty($message_array)){
    $message = $message_array[0];
    $message_type = $message_array[1];
    $message_types = array(
          'info'    => 'alert alert-info'
        , 'warning' => 'alert alert-warning'
        , 'danger'  => 'alert alert-danger'
        , 'error'   => 'alert alert-danger'
        , 'success' => 'alert alert-success'
    );
    
    if( isset($message_types[$message_type])) {
      $mess_class = $message_types[$message_type];
    } else {
      $mess_class = 'alert alert-info';
    }

    echo '<div class="' . $mess_class . '">';
    echo "<p>{$message}</p>";
    echo '</div>';
  }
}

function __autoload($class_name) {
  $class_name = strtolower($class_name);
  $path_name=LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path_name)) {
    require_once($path_name);
  } else {
    die("The file {$class_name}.php could not be found");
  }
}

function log_action($action, $message="") {
  $logfile=SITE_ROOT.DS."logs".DS."log.txt";
  $new = file_exists($logfile) ? false : true;
  if($handle=fopen($logfile,'a')) { //append
    $ts = strftime("%Y-%m-%d %H:%M:%S", time());
    $content = "{$ts} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) {
      echo "File is new, changing file perms to 755"; 
      chmod($logfile, 0755); 
    }
  } else {
    echo "Could not open log file for writing";
  }
}


// public function getTimeDifference($time) {
//     //Let's set the current time
//     $currentTime = date('Y-m-d H:i:s');
//     $toTime = strtotime($currentTime);

//     //And the time the notification was set
//     $fromTime = strtotime($time);

//     //Now calc the difference between the two
//     $timeDiff = floor(abs($toTime - $fromTime) / 60);

//     //Now we need find out whether or not the time difference needs to be in
//     //minutes, hours, or days
//     if ($timeDiff < 2) {
//         $timeDiff = "Just now";
//     } elseif ($timeDiff > 2 && $timeDiff < 60) {
//         $timeDiff = floor(abs($timeDiff)) . " minutes ago";
//     } elseif ($timeDiff > 60 && $timeDiff < 120) {
//         $timeDiff = floor(abs($timeDiff / 60)) . " hour ago";
//     } elseif ($timeDiff < 1440) {
//         $timeDiff = floor(abs($timeDiff / 60)) . " hours ago";
//     } elseif ($timeDiff > 1440 && $timeDiff < 2880) {
//         $timeDiff = floor(abs($timeDiff / 1440)) . " day ago";
//     } elseif ($timeDiff > 2880) {
//         $timeDiff = floor(abs($timeDiff / 1440)) . " days ago";
//     }

//     return $timeDiff;
// }

?>