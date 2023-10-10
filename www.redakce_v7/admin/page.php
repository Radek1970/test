<?php
    			// pripojeni sekce session..
 include_once('session/session_vstup.php');
?>

<?php
    			// pripojeni sekce session..
 include_once('sql/sql.php');
?>

<?php
    			// pripojeni sekce session..
 include_once('funkce/funkce.php');
?>


<?php
			// pripojeni sekce formatovani..
 include_once('komponenty/formatovani.php');
?>

<?php
			// pripojeni sekce start body..
 include_once('komponenty/start_body.php');
?>
	
	
	
<?php
			// pripojeni sekce start body..
 include_once('komponenty/hlava.php');
?>
	   
    
  <div id="main_content"> 
       





<?


 if(($_SESSION['funkce'] =="redaktor")or($_SESSION['funkce'] =="superredaktor")){ 
switch ($akc):

  case "obsah_editace":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_form_edit.php");
  break;
  
  case "obsah_detail":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_detail.php");
  break;
  
  case "obsah_vlozit":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_vypis.php");
  break;

  case "obsah_form":
  $nadpis_stranky = "vkl�d�n� obsahu do str�nky ";
   require("stranky/str_obsah_form.php");
  break;
  
  case "obsah_vypis":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_vypis.php");
  break;








   case "obsah_vypis_galerie":
  $nadpis_stranky = "foto galerie ze str�nky";
   require("stranky/str_obsah_vypis_galerie.php");
  break;
  
   case "obr_vyber_do_galerie":
  $nadpis_stranky = "v�b�r fotek do galerie";
   require("stranky/str_obsah_vyber_fotky_galerie.php");
  break;
  
  case "obr_vloz_do_galerie":
  $nadpis_stranky = "v�b�r fotek do galerie";
   require("stranky/str_obsah_vypis_galerie.php");
  break;
  
  
  
  
  case "obsah_box_p":
   $nadpis_stranky = "spr�va obsahu v bo�n�m panelu ";
   require("stranky/str_obsah_box_p.php");
  break;
  
  
  
  
  

  case "stranky":
   $nadpis_stranky = "spr�va str�nek";
   require("stranky/str_stranky.php");
  break;
  
  case "nova_stranka":
   $nadpis_stranky = "vytvo�en� nov� str�nky";
   require("stranky/str_stranky_nova.php");
  break;
  
   case "nova_stranka_gal":
   $nadpis_stranky = "vytvo�en� nov� str�nky s fotogaleri�&nbsp;<img src=\"css/images/camera.png\" /> ";
   require("stranky/str_stranky_nova_galer.php");
  break;
  
  case "edit_stranka":
   $nadpis_stranky = "editace str�nky";
   require("stranky/str_stranky_edit.php");
  break;
  
  
  
  
  
  
  
  
   case "edit_hesla":
   $nadpis_stranky = "editace p�ihla�ovac�ch �daj�";
   require("stranky/str_editace_hesla_form.php");
  break;
  
  case "edit_hesla_go":
   $nadpis_stranky = "editace p�ihla�ovac�ch �daj�";
   require("stranky/str_editace_hesla_go.php");
  break;
  
  
  
  
  
  
  case "obr_detail":
   $nadpis_stranky = "detail obr�zku";
   require("stranky/str_obr_detail.php");
  break;
  
  case "obr_vypis":
   $nadpis_stranky = "v�pis obr�zk�";
   require("stranky/str_obr_vypis.php");
  break;
  
  case "obr_upload":
   $nadpis_stranky = "vlo�en� obr�zku";
   require("stranky/str_obr_upload.php");
  break;
  
  case "obr_delete":
   $nadpis_stranky = "maz�ni obr�zku";
   require("stranky/str_obr_delete.php");
  break;
  
  
  
  
  
  
  
  case "slogan":
   $nadpis_stranky = "vlo�en� sloganu";
   require("stranky/str_slogan.php");
  break;
  
  
  
  case "anketa":
   $nadpis_stranky = "v�pis anket";
   require("anketa/anketa.php");
  break;
  
  case "nova_anketa":
   $nadpis_stranky = "vlo�it anketa";
   require("anketa/nova_anketa.php");
  break;
  
  
  
  
  
  
  
  
  case "ucty":
   $nadpis_stranky = "v�pis ��t�";
   require("ucty/str_ucty_vypis.php");
  break;
  
  case "ucet_detail":
   $nadpis_stranky = "detail ��t�";
   require("ucty/str_ucty_detail.php");
  break;
  
  case "ucet_nov":
   $nadpis_stranky = "nov� ��et";
   require("ucty/str_ucty_new.php");
  break;
  
  case "ucet_edit":
   $nadpis_stranky = "editace ��tu";
   require("ucty/str_ucty_edit.php");
  break;
  
  
  
  default:
    $nadpis_stranky = "�vodn� str�nka";
    require("stranky/str_uvod.php");
    
endswitch; 
}


else{

switch ($akc):
 
  case "obsah_editace":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_form_edit.php");
  break;
  
  case "obsah_detail":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_detail.php");
  break;
  
  case "obsah_vlozit":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_vypis.php");
  break;

  case "obsah_form":
  $nadpis_stranky = "vkl�d�n� obsahu do str�nky ";
   require("stranky/str_obsah_form.php");
  break;
  
  case "obsah_vypis":
  $nadpis_stranky = "editace obsahu ze str�nky";
   require("stranky/str_obsah_vypis.php");
  break;
  
  
  




  
   case "obsah_vypis_galerie":
  $nadpis_stranky = "foto galerie ze str�nky";
   require("stranky/str_obsah_vypis_galerie.php");
  break;
  
   case "obr_vyber_do_galerie":
  $nadpis_stranky = "v�b�r fotek do galerie";
   require("stranky/str_obsah_vyber_fotky_galerie.php");
  break;
  
  case "obr_vloz_do_galerie":
  $nadpis_stranky = "v�b�r fotek do galerie";
   require("stranky/str_obsah_vypis_galerie.php");
  break;














   
   case "edit_hesla":
   $nadpis_stranky = "editace p�ihla�ovac�ch �daj�";
   require("stranky/str_editace_hesla_form.php");
  break;
  
  case "edit_hesla_go":
   $nadpis_stranky = "editace p�ihla�ovac�ch �daj�";
   require("stranky/str_editace_hesla_go.php");
  break;




   case "obr_detail":
   $nadpis_stranky = "detail obr�zku";
   require("stranky/str_obr_detail.php");
  break;
  
  case "obr_vypis":
   $nadpis_stranky = "v�pis obr�zk�";
   require("stranky/str_obr_vypis.php");
  break;
  
  case "obr_upload":
   $nadpis_stranky = "vlo�en� obr�zku";
   require("stranky/str_obr_upload.php");
  break;
  
  case "obr_delete":
   $nadpis_stranky = "maz�ni obr�zku";
   require("stranky/str_obr_delete.php");
  break;







 default:
    $nadpis_stranky = "�vodn� str�nka";
    require("stranky/str_uvod.php");
    
endswitch;


}

















           
?>











     
        
	</div>
    <!-- end of main_content -->
   
   
   
   
   
   
    
<!-- end page -->
<?php
			// pripojeni sekce konec body..
 include_once('komponenty/pata.php');
?>
<p 


<?php
			// pripojeni sekce konec body..
 include_once('komponenty/end_body.php');
?>
