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
  
   	
  </head>
  <body>
  <div id="container">
 
  
  
  
  
  <div id="zahlavi">
  <div id="slogan">
  <h1><? slogan_fy($slogan_fy); ?></h1>
	<div id="slogan_text">
  <? slogan($slogan);	?>
  DEMO VERZE
  </div>
  </div>
  </div>
  
  <div id="banner">
  <div id="banner_text_l">
  <div id="banner_text_l_slogan"> 
  <? //slogan($slogan);	?>
  </div>
  </div>
  <div id="banner_text_p">
  <div id="banner_text_p_slogan"> 
  <? //slogan($slogan);	?>
  </div>
  </div>
  </div>
 
  <div id="nazev_str"><h1><? nadpis($nadpis,$side); ?></h1></div>
  
  
  <div id="obsah">
  <div id="obsah_hlavni">
  <?php obsah($obsah,$side);// hlavni obsah ?>
  </div>
  <div id="obsah_bok">
  
  
  <!-- obsah box -->
  <div class="nadpis_box"><h3>MENU</h3></div>
  <div class="obsah_box">
  
  <!-- menu box -->
  <div class="arrowlistmenu">
  <ul>   
  <?php menu($menu);// pripojeni sekce menu. ?>
  </ul>
  </div> 
  <!-- konec menu box -->
  


  
  
  
  
  
  
  
  
  
  
  </div>
	<div class="obsah_box_pata"></div>
  <!-- obsah box konec -->
  
  
   
  <?php anketa($hlas,$id,$dotaz,$spojeni,$kontrola); ?>
  
  
  
  
  
  
  <br/>
  <?php include_once('obsah_right.php');// pripojeni levy panel.. ?>
   

  </div>
  <div id="obsah_end"></div>
  </div>
  
  
  <div id="pata"></div>
  </div>
  </body>
</html>
