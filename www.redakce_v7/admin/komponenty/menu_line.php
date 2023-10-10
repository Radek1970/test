<div class="menu">
<?
//if(($_SESSION['funkce'] =="redaktor")or($_SESSION['funkce'] =="superredaktor"))
if(($_SESSION['ev_c'] == "200901") or ($_SESSION['ev_c'] == "200902") or ($_SESSION['ev_c'] == "200903"))
{
$menu ='<ul>
<li><a href="page.php">úvod</a></li>
<li><a href="page.php?akc=slogan">slogan</a></li>
<li><a href="page.php?akc=obsah_box_p">boèní panel</a></li>
<li><a href="page.php?akc=stranky">stránky</a></li>
<li><a href="page.php?akc=obr_vypis">foto</a></li>
<li><a href="page.php?akc=anketa">anketa</a></li>

</ul>';


echo $menu;
}


if(($_SESSION['funkce'] =="redaktor") and ($_SESSION['ev_c'] != "200901") and ($_SESSION['ev_c'] != "200902") and ($_SESSION['ev_c'] != "200903") )
//if(($_SESSION['ev_c'] == "200901") or ($_SESSION['ev_c'] == "200902") or ($_SESSION['ev_c'] == "200903"))
{
$menu ='<ul>
<li><a href="page.php">úvod</a></li>

<li><a href="page.php?akc=stranky">stránky</a></li>
<li><a href="page.php?akc=obr_vypis">foto</a></li>
</ul>';


echo $menu;
}


if(($_SESSION['funkce'] !="redaktor") and ($_SESSION['ev_c'] != "200901") and ($_SESSION['ev_c'] != "200902") and ($_SESSION['ev_c'] != "200903") ){
$menu ='<ul>
<li><a href="page.php">úvod</a></li>


<li><a href="page.php?akc=obr_vypis">foto</a></li>

</ul>';

echo $menu;
}
 ?>


</div>
