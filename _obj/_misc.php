<?php
class misc {
	function connectarse()
	{
        /*
		$link = mysql_connect($GLOBALS['config']['db_host'],$GLOBALS['config']['db_user'],$GLOBALS['config']['db_pwd']) or die (mysql_error($link));
		mysql_select_db($GLOBALS['config']['db_database'],$link) or die (mysql_error($link));
		return $link;
        */

        // Create connection
        $link = new mysqli($GLOBALS['config']['db_host'], 
                            $GLOBALS['config']['db_user'], 
                            $GLOBALS['config']['db_pwd'], 
                            $GLOBALS['config']['db_database'] );

        $link->set_charset("utf8");
        
        // Check connection
        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }

        return $link;
	}
}
?>