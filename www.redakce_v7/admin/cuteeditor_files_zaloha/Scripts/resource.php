<?php

//TODO:write the file with cache header. 
//TODO:case sensitive issue

$cd = dirname($_SERVER['SCRIPT_NAME'])."/resources";

$type=$_GET["type"];

if($type=="emptyhtml")
{
	header("Content-Type: text/html");
	echo("<html><head></head><body></body></html>");
	exit(200);
}
else if($type=="license")
{
	header("Content-Type: application/oct-stream"); 
	
	$scriptfile=@$_SERVER['SCRIPT_FILENAME'];
	if(!$scriptfile)$scriptfile=$_SERVER['ORIG_SCRIPT_FILENAME'];
		
	$licensefile=dirname(dirname($scriptfile))."/license/phphtmledit.lic";
	$size=filesize($licensefile);
	$handle=fopen($licensefile,"r");
	$data=fread($handle,$size);
	fclose($handle);
	echo(bin2hex($data));
}
else if($type=="serverip")
{
	$ip=@$_SERVER['SER'.'VER_AD'.'DR'];
    if($ip==null)$ip=@$_SERVER['LOC'.'AL_AD'.'DR'];
    header("Content-Type: text/plain"); 
    echo($ip);
}

exit(200);

?>