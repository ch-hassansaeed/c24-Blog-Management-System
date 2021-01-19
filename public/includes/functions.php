<?php
//require_once("includes/configure.php");
require_once("includes/common.php");
/* LOGOUT */



function logoutConnect(){

			$_SESSION=array();
			unset($_SESSION);
			session_destroy();

}

/* END LOGOUT */
function getAllUsersCount()
{
		 $queryString = sprintf("SELECT count(*) as TotalUsers from users u left join user_types ut on u.UserTypeId=ut.user_types_id");
	 $resultSet = mysqlSelectQuery($queryString);
	//return $resultSet;
	$rowcount= $resultSet->fetch_object()->TotalUsers;
	return $rowcount;
}


function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
} 
?>