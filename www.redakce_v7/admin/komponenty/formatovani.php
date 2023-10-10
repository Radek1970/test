<? //echo "<?xml version=\"1.0\" encoding=\"windows-1250\"?" . ">" ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">




<head> 
<title>administrace</title> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" /> 
<meta http-equiv="Content-Style-Type" content="text/css"/> 
<meta http-equiv="Content-Script-Type" content="text/javascript"/> 
<meta http-equiv="Content-Language" content="cs"/>
<meta name="robots" content="all,follow" /> 
<meta name='description' content='' />

<meta name='keywords' content='' lang='cs' />


<meta name='robots' content='all,follow' /> 
<meta name="author" content="R.Svoboda-www.tvorbawebstranek.com"/> 

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<link rel="stylesheet" type="text/css" href="css/tabulky.css" />







  <!-- skript pro editor -->
  <?
  /*
  
  <!-- skript pro editor tinyeditor -->
  <link rel="stylesheet" href="tinyeditor/style.css" />
  <script type="text/javascript" src="tinyeditor/tinyeditor.js"></script>
  
  <!-- skript pro editor widgEditor -->
	<style type="text/css" media="all">
	@import "editor/css/widgEditor.css";
  </style> 

  <script type="text/javascript" src="editor/scripts/widgEditor.js"></script>
  
 
 
  <script language="JavaScript" type="text/javascript" src="editor5/wysiwyg.js"></script>
  */
  ?>
  
  <script language="JavaScript" type="text/javascript" src="wyzz04/wyzz_uprava.js"></script>
  
  
  <!-- skript pro hromadné zaškrtnutí checkboxu --> 
  <script type="text/javascript" language="javascript">
  function zaskrtnoutVse() {
  var b = document.getElementsByTagName("input");
  for (var j = 0; j < b.length; j++) {
  if (b[j].type == "checkbox") {
  b[j].setAttribute("checked", "checked");
  }
   }

  return true;
  }
  </script> 

</head>
