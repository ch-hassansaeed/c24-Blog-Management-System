<?php
/*-------------------------------------------------------------------------------------*/

//MYSQL QUERIES


/*-------------------------------------------------------------------------------------*/
//FUNCTION FOR INSER AND UPDATE

$loginuserID = $_SESSION['ADMIN_ID'];
//Userpermissions & access start
$SubscriberUserpermissions = array(
    "dashboard.php",
    "users.php?view=edit&users_id=$loginuserID",
    "users.php?view=process_actions"
);
$SubscriberUserpermissionsLeftMenuIDs = array(
    "dashboard",
    "userprofile"
);
//Userpermissions & access end
function mysqlQuery($data, $table_name, array $table_id, $query_type)
{
    global $db;
    if (strtolower($query_type) == 'insert')
    {

        $query = "INSERT INTO " . $table_name . " " . $data;

        /*
        echo $query;
        exit();
        //*/

        if (mysqli_query($db, $query))
        {

            return mysqli_insert_id($db);

        }
        else
        {

            return false;

        }

    }
    elseif (strtolower($query_type) == 'update')
    {

        $query = "UPDATE " . $table_name . " " . $data . " WHERE " . $table_id['id_name'] . " = '" . $table_id['id'] . "'";

        /*echo $query;
         exit();*/
        if (mysqli_query($db, $query))
        {

            return true;

        }
        else
        {

            return false;
        }

    }

}

//FUNCTION FOR DELETE ROW


function mysqlDeleteQuery($table_name, array $table_id)
{
    global $db;
    $query = "DELETE FROM " . $table_name . " WHERE " . $table_id['id_name'] . " = '" . $table_id['id'] . "'";

    /*
    echo $query;
    exit();
    */

    if (mysqli_query($db, $query))
    {
        return true;

    }
    else
    {

        return false;
    }

}

//FUNCTION FOR SELECT ALL
function mysqlSelectQuery($queryString, $page = '-1', $records = NULL, $sorting = NULL)
{
    global $db;
    if ($page == - 1 || $records == NULL)
    {

        $limit = '';
    }
    else
    {

        $start = $page * $records;
        $limit = " LIMIT " . $start . ", " . $records;
    }

    $query = $queryString . " " . $sorting . " " . $limit;
    /*echo $query;*/

    $resultSet = mysqli_query($db, $query);
    return $resultSet;

}
function mysqlSelectQueryFetchArrayAssoc($queryString, $keyCol)
{
    global $db;

    $query = $queryString;
    //echo $query;
    $columnArr = array();

    $resultSet = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    {
        $columnArr[] = $row[$keyCol];
        //Edited - added semicolon at the End of line.1st and 4th(prev) line
        
    }

    return $columnArr;

}
/*-------------------------------------------------------------------------------------*/

//END MYSQL QUERIES
/*-------------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------*/

////////////////////////////////////////////////////////////////////////////////////


/*---------------------------------------------------------------------------------*/

function formatDate($mydate, $type)
{

    switch ($type)
    {

        case '1';

        return date("M d, Y", strtotime($mydate));

    break;

}

}

function get_start_end_time($start_date, $duration)
{

    $date = explode(" ", $start_date); //or equivalent
    

    //$date = date("Y-m-d");//or equivalent
    

    $dateParts = explode("-", $date[0]);

    $time = $date[1]; //date("H:i:s");//or equivalent
    

    $timeParts = explode(":", $time);

    //$duration = 480;//min
    

    return date("Y-m-d H:i:s", mktime($timeParts[0], $timeParts[1], $timeParts[2], $dateParts[1], $dateParts[2], $dateParts[0]) + ($duration * 60));

}

function get_date_difference($start_date, $end_date)
{

    $dateDiff = abs(strtotime($end_date) - strtotime($start_date));

    $fullDays = floor($dateDiff / (60 * 60 * 24));

    $fullHours = floor(($dateDiff - ($fullDays * 60 * 60 * 24)) / (60 * 60));

    $fullMinutes = floor(($dateDiff - ($fullDays * 60 * 60 * 24) - ($fullHours * 60 * 60)) / 60);

    $total_hours = $fullDays * 24;

    $total_hours = $total_hours + $fullHours;

    return $total_hours;

}

function get_time_difference($start, $end)
{

    $uts['start'] = strtotime($start);

    $uts['end'] = strtotime($end);

    if ($uts['start'] !== - 1 && $uts['end'] !== - 1)
    {

        if ($uts['end'] >= $uts['start'])
        {

            $diff = $uts['end'] - $uts['start'];

            if ($days = intval((floor($diff / 86400))))

            $diff = $diff % 86400;

            if ($hours = intval((floor($diff / 3600))))

            $diff = $diff % 3600;

            if ($minutes = intval((floor($diff / 60))))

            $diff = $diff % 60;

            $diff = intval($diff);

            return (array(
                'days' => $days,
                'hours' => $hours,
                'minutes' => $minutes,
                'seconds' => $diff
            ));

        }
        else
        {

            //trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
            

            return (array(
                'error' => 'Ending date/time is earlier than the start date/time.'
            ));

        }

    }
    else
    {

        //trigger_error( "Invalid date/time data detected", E_USER_WARNING );
        

        return (array(
            'error' => 'Invalid date/time data detected.'
        ));

    }

    return (false);

}

function minutes2hours($mins)
{

    if ($mins < 0)
    {

        $min = Abs($mins);

    }
    else
    {

        $min = $mins;

    }

    $H = Floor($min / 60);

    $M = ($min - ($H * 60)) / 100;

    $hours = $H + $M;

    if ($mins < 0)
    {

        $hours = $hours * (-1);

    }

    $expl = explode(".", $hours);

    $H = $expl[0];

    if (empty($expl[1]))
    {

        $expl[1] = 00;

    }

    $M = $expl[1];

    if (strlen($M) < 2)
    {

        $M = $M . 0;

    }

    $hours = $H . "." . $M;

    return $hours;

}

function createThumbs($pathToImages, $pathToThumbs, $thumbWidth, $thumbHeight, $file_name, $ispercentage = false)

{

    $file_type = file_content_type($file_name);

    /*--------------------------------------------------------------------------*/

    if ($ispercentage)
    {

        $mysock = getimagesize($pathToImages . $file_name);

        $width = $mysock[0];

        $height = $mysock[1];

        $target = 253;

        if ($width > $height)
        {

            $percentage = ($target / $width);

        }
        else
        {

            $percentage = ($target / $height);

        }

        //gets the new value and applies the percentage, then rounds the value
        

        $new_width = round($width * $percentage);

        $new_height = round($height * $percentage);

    }
    else
    {

        $new_width = $thumbWidth;

        $new_height = $thumbHeight;

    }

    /*--------------------------------------------------------------------------*/

    // open the directory
    

    // $dir = opendir( $pathToImages );
    

    // loop through it, looking for any/all JPG files:
    

    //  while (false !== ($fname = readdir( $dir ))) {
    

    // parse path for the extension
    

    $fname = $file_name;

    $info = pathinfo($pathToImages . $fname);

    // continue only if this is a JPEG image
    

    // if ( strtolower($info['extension']) == 'jpg' )
    

    //  {
    

    //echo "Creating thumbnail for {$fname} <br />";
    

    // load image and get image size
    

    header('Content-type: ' . $file_type);

    $type = explode('/', $file_type);

    if ($type[1] == 'png')
    {

        $img = imagecreatefrompng("{$pathToImages}{$fname}");

    }
    elseif ($type[1] == 'gif')
    {

        $img = imagecreatefromgif("{$pathToImages}{$fname}");

    }
    else
    {

        $img = imagecreatefromjpeg("{$pathToImages}{$fname}");

    }

    $width = imagesx($img);

    $height = imagesy($img);

    // calculate thumbnail size
    

    /*	$new_width = $thumbWidth;
    
    
    $new_height = $thumbHeight;*/

    //$new_height = floor( $height * ( $thumbWidth / $width ) );
    

    // create a new tempopary image
    

    $tmp_img = imagecreatetruecolor($new_width, $new_height);

    // copy and resize old image into new image
    

    //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
    

    imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // save thumbnail into a file
    

    $type = explode('/', $file_type);

    if ($type[1] == 'png')
    {

        imagepng($tmp_img, "{$pathToThumbs}{$fname}");

    }
    elseif ($type[1] == 'gif')
    {

        imagegif($tmp_img, "{$pathToThumbs}{$fname}");

    }
    else
    {

        imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");

    }

    //  }
    

    // }
    

    // close the directory
    

    // closedir( $dir );
    

    
}

function mask_cc($cc, $mask_char = 'X')
{

    $cc = preg_replace('([^0-9])', '', $cc);

    $last = substr($cc, -4);

    return str_pad($last, strlen($cc) , $mask_char, STR_PAD_LEFT);

}

function output_file($type, $file, $filename)
{

    header("Content-type: " . mime_content_type($filename));

    header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
    

    header('Pragma: public');

    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    

    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

    header("Content-Disposition: attachment;filename=$filename");

    readfile($file);

}

function file_content_type($filename)
{

    $mime_types = array(

        'txt' => 'text/plain',

        'htm' => 'text/html',

        'html' => 'text/html',

        'php' => 'text/html',

        'css' => 'text/css',

        'js' => 'application/javascript',

        'json' => 'application/json',

        'xml' => 'application/xml',

        'swf' => 'application/x-shockwave-flash',

        'flv' => 'video/x-flv',

        // images
        

        'png' => 'image/png',

        'jpe' => 'image/jpeg',

        'jpeg' => 'image/jpeg',

        'jpg' => 'image/jpeg',

        'gif' => 'image/gif',

        'bmp' => 'image/bmp',

        'ico' => 'image/vnd.microsoft.icon',

        'tiff' => 'image/tiff',

        'tif' => 'image/tiff',

        'svg' => 'image/svg+xml',

        'svgz' => 'image/svg+xml',

        // archives
        

        'zip' => 'application/zip',

        'rar' => 'application/x-rar-compressed',

        'exe' => 'application/x-msdownload',

        'msi' => 'application/x-msdownload',

        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        

        'mp3' => 'audio/mpeg',

        'qt' => 'video/quicktime',

        'mov' => 'video/quicktime',

        // adobe
        

        'pdf' => 'application/pdf',

        'psd' => 'image/vnd.adobe.photoshop',

        'ai' => 'application/postscript',

        'eps' => 'application/postscript',

        'ps' => 'application/postscript',

        // ms office
        

        'doc' => 'application/msword',

        'rtf' => 'application/rtf',

        'xls' => 'application/vnd.ms-excel',

        'ppt' => 'application/vnd.ms-powerpoint',

        // open office
        

        'odt' => 'application/vnd.oasis.opendocument.text',

        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',

    );

    $ext = strtolower(array_pop(explode('.', $filename)));

    if (array_key_exists($ext, $mime_types))
    {

        return $mime_types[$ext];

    }

    elseif (function_exists('finfo_open'))
    {

        $finfo = finfo_open(FILEINFO_MIME);

        $mimetype = finfo_file($finfo, $filename);

        finfo_close($finfo);

        return $mimetype;

    }

    else
    {

        return 'application/octet-stream';

    }

}

?>