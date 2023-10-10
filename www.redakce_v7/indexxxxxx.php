<?php
// pripojeni session..
 include_once('session/session.php');
?>

<?php
// pripojeni session..
 include_once('komponenty/sql.php');
?>

<?php
// pripojeni session..
 include_once('komponenty/funkce.php');
?>

<?php
			// pripojeni sekce formatovani..
 include_once('formatovani/formatovani.php');
?>

<?php
			// pripojeni sekce css..
 include_once('css/css.php');
?>
<body>
<div id="container">
<div id="topbar">
<div id="TopSection">
<h1 id="sitename"> <? slogan($slogan);	?></h1>

<div id="topbarnav"> <span class="topnavitems"><a href="admin/index.php">admin </a></span>



</div>



<div class="clear"></div>
<ul id="topmenu">
<li><a href="#"><? nadpis($nadpis,$side); ?></a></li>
</ul>
</div>
</div>

<div id="wrap">
<div id="headershort">

<h1 class="subheader"><? slogan_fy($slogan_fy); ?></h1>

</div>
<div id="contents">
<div id="left">
<?php 

obsah($obsah,$side);// hlavni obsah 

?>


<!-- <p class="postmetadata">No Comment | Add Comment | Category</p>  -->


</div>




<!-- PRAVA STRANA -->
<div id="sidebar">
  <h2>MENU</h2>
    	<ul id="categories">
        	<?php
	   // pripojeni sekce menu..
     menu($menu);
     ?>
        </ul>
   
  <?php include_once('obsah_right.php');// pripojeni levy panel.. ?>
       
</div>


<div class="clear"></div>

</div>
</div>

<div id="footer">
<div id="footercontent">
<div id="previews">

 
  <div class="item">
  </div>
<div class="clear"></div>
</div>
<div id="copyright">&copy; <? slogan($slogan);	?> | </div>
</div>

</div>
<!--
Credits  should not be removied
Designed by Roshan, www.ramblingsoul.com
-->
<div id="credit"><a title="Free Css Templates" href="http://www.ramblingsoul.com">CSS Template</a> by Rambling Soul | Valid <a href="http://validator.w3.org/check?uri=referer">XHTML 1.0</a> | <a href="http://validator.w3.org/check?uri=referer&quot;">CSS 2.0</a></div>
<!--Credits  should not be removied-->
</div>
</body>
</html>
