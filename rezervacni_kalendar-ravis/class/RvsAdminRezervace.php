<?php
class RvsAdminRezervace
{

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function presmerovaniNaStranku()
    {
        //header('Location: index.php?stranka='.$str.'');
        //header("Location: " . $_SERVER['REQUEST_URI']);
        //header("Refresh: 0; url=".$_SERVER['REQUEST_URI']);
        //exit;
        $cesta = $_SERVER['REQUEST_URI'];
        return "<a href=" . $cesta . "> PROVEĎ REFRESH </a> ";
    }


    public function pocetDnu($od, $do)
    {

        // Převede data na časové značky
        $cas_od_data = strtotime($od);
        $cas_do_data = strtotime($do);

        // Spočítá rozdíl v čase v sekundách
        $rozdil_v_sekundach = $cas_do_data - $cas_od_data;

        // Převede rozdíl na počet dnů
        $rozdil_v_dnech = floor($rozdil_v_sekundach / (60 * 60 * 24));

        return  $rozdil_v_dnech + 1;
    }


    public function filtrujTabulkuRezervace()
    {
        // formulář pro filtry
        global $wpdb;
        // Zde nastavte název tabulky ve vaší databázi
        $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_PRODUCT;
        //$rvs_rezervace_table = $wpdb->prefix . 'nazev_vase_tabulky'; // Nahraďte 'nazev_vase_tabulky' názvem vaší tabulky
        $query = "SELECT id, nazev, spz FROM $rvs_rezervace_table";
        $results = $wpdb->get_results($query, OBJECT);


        if ($results) {

            echo '<div class="box00" ><form method="POST" action="' . $_SERVER['REQUEST_URI'] . '">';
            echo '<input  type="hidden"  size="2" name="filtr" value="go" >';

            echo '<label for="checkbox"> vybrat dle názvu: </label>';
            echo '<select name="filtrCars" id="cars">';
            echo '<option value="">vše</option>';
            foreach ($results as $result) {
                echo '<option value="' . $result->spz . '">' . $result->nazev . '</option>';
            }
            echo '</select>';

            echo '<label for="checkbox"> seřaď sestupně od data: </label>';
            echo '<input type="checkbox" name="checkboxSestupne" id="checkboxSestupne">';
            echo '<br><button type="submit" class="btn btn-primary" >filtruj</button></form>';
        }
    }


    public function sqlDotazyTabRezervace($nazevTabulky)
    {
        //echo $nazevTabulky;
        if ((isset($_POST['filtr']))) {
            $filtr = htmlspecialchars(trim($_POST['filtr']));
            $filtrCars = htmlspecialchars(trim($_POST['filtrCars']));
            if ($filtr == 'go') {
                echo   $filtrCars;
                if (!empty($filtrCars)) {

                    if (isset($_POST['checkboxSestupne'])) {
                        // Checkbox byl zaškrtnut
                        //echo "Checkbox byl zaškrtnut.";
                        return "SELECT * FROM $nazevTabulky WHERE (statut = $this->statut AND rz = '$filtrCars') ORDER BY $nazevTabulky.
                        datum_od DESC";
                    } else {
                        // Checkbox nebyl zaškrtnut
                        //echo "Checkbox nebyl zaškrtnut.";
                        return "SELECT * FROM $nazevTabulky WHERE (statut = $this->statut AND rz = '$filtrCars')";
                    }
                } else {

                    if (isset($_POST['checkboxSestupne'])) {
                        return "SELECT * FROM $nazevTabulky WHERE statut = '{$this->statut}' ORDER BY $nazevTabulky.
                        datum_od DESC";
                    } else {
                        return "SELECT * FROM $nazevTabulky WHERE statut = '{$this->statut}'";
                    }
                }
            }
        }

        return "SELECT * FROM $nazevTabulky WHERE statut = '{$this->statut}'";
    }




    public function adminDeletRezervace()
    {

        if (isset($_POST['delkompl'])) {
            $id_uzivatele = $_POST['delkompl'];


            //echo "<br/>";
            $pocet = count($id_uzivatele);
            //echo $pocet;
            if ($pocet != 0) {
                // funkce while vypise prislusny pocet poli 
                $vypis = '<div class="box00"><strong>';
                $i = 0;
                while ($i < $pocet) {

                    global $wpdb;
                    // Název tabulky, ze které chcete vymazat záznam
                    $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_REZERVACE;
                    // ID záznamu, který chcete vymazat
                    // Vytvoření SQL dotazu pro výběr záznamu podle ID
                    $sql = $wpdb->prepare("SELECT * FROM $rvs_rezervace_table WHERE id = %d", $id_uzivatele[$i]);

                    // Získání záznamu
                    $exist = $wpdb->get_row($sql);

                    if ($exist) {

                        // Záznam s daným ID existuje
                        //echo "Záznam existuje.".$id_uzivatele[$i];

                        // Vytvoření SQL dotazu pro smazání záznamů
                        // %d značí zástupný symbol pro celá čísla (integers)
                        $query = $wpdb->prepare("DELETE FROM $rvs_rezervace_table WHERE id = %d", $id_uzivatele[$i]);

                        // Spuštění SQL dotazu pro smazání záznamů
                        $wpdb->query($query);

                        if ($query === false) {
                            // Nepodařilo se vymazat záznam
                            $vypis .= "Chyba při vymazání záznamu.";
                        } else {
                            // Záznam byl úspěšně vymazán
                            $vypis .= "Záznam s ID " . $id_uzivatele[$i] . " byl vymazán.";
                        }

                    } else {
                        // Záznam s daným ID neexistuje
                        $vypis .= "Záznam neexistuje.";
                    }

                 $i++;
                }
                $vypis .= '</strong></div>';
                return $vypis;
            }
        }
    }





    public function adminTabulkaRezervace($cisloStatutu)
    {



        $this->statut = $cisloStatutu;

        global $wpdb;
        // Zde nastavte název tabulky ve vaší databázi
        $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_REZERVACE;
        //$rvs_rezervace_table = $wpdb->prefix . 'nazev_vase_tabulky'; // Nahraďte 'nazev_vase_tabulky' názvem vaší tabulky
        // vypisuje sql dotazy pro zadanu tabulku
        $query = $this->sqlDotazyTabRezervace($rvs_rezervace_table);


        //$query = "SELECT * FROM $rvs_rezervace_table WHERE statut = $this->statut  ";

        $results = $wpdb->get_results($query, OBJECT);


        if ($results) {
            echo '<form method="POST">';
            $table = "<table class='box0' >";
            $table .= "<tr><th>delete</th><th>ID</th><th>Spz</th><th>Název</th><th>Od data</th><th>Do data</th><th>dny</th><th>Datum zápisu</th><th>Jméno</th><th>Přijmení</th><th>Email</th><th>Telefon</th><th>Statut</th><th>Nový statut</th></tr>";
            foreach ($results as $result) {
                $table .= "<tr>";

                $table .= '<td><input type="checkbox"  name="delkompl[]" value="' . $result->id . '"></td>'; #
                $table .= "<td>" . $result->id .    "</td>";
                $table .= "<td>" . $result->rz .    "</td>";
                $table .= "<td>" . $result->nazev . "</td>";
                $table .= "<td><b>" . $result->datum_od . "</b></td>";
                $table .= "<td><b>" . $result->datum_do . "</b></td>";

                $table .= "<td><b>" .  $this->pocetDnu($result->datum_od, $result->datum_do) . "</b></td>";
                $table .= "<td><small>" . $result->datum_zapisu . "</small></td>";
                $table .= "<td>" . $result->jmeno . "</td>";
                $table .= "<td>" . $result->prijmeni . "</td>";
                $table .= "<td>" . $result->email . "</td>";
                $table .= "<td>" . $result->telefon . "</td>";
                $table .= "<td>" . $result->statut . "</td>";


                // uprav statut
                $table .= '<td><form method="POST" action="' . $_SERVER['REQUEST_URI'] . '">';
                $table .= '<input  type="hidden"  name="active" value="go" >';
                $table .= '<input  type="text"  size="2" name="statut" value=" " > ';
                $table .= '<input  type="hidden"  name="id" value="' . $result->id . '" >';
                $table .= '<button class="btn btn-info" type="submit"  >změnit staut</button></form></td>';

                // uprav statut


                $table .= "</tr>";
            }
            echo $table;

            echo "</table>";
            echo '<table class="box00"><tr><td><input class="btn btn-info" type="submit" value="odstranit vybrané" onclick="return dotazPredOdeslanim(this);"></form><br><br><br></td></tr></table> ';
        } else {
            echo "Žádná data nebyla nalezena.";
        }
    }


    public function vypisStatut($cisloStatutu)
    {
        $cisloStatutu = $cisloStatutu;
        $this->adminDeletRezervace();
        $this->upravStatut();  
        $this->filtrujTabulkuRezervace();
        $this->adminTabulkaRezervace($cisloStatutu);

    }




    public function upravStatut()
    {
        if ((isset($_POST['active']))) {


            $active = htmlspecialchars(trim($_POST['active']));
            $statut = htmlspecialchars(trim($_POST['statut']));
            $id = htmlspecialchars(trim($_POST['id']));

            if ($active == 'go') {

                //echo  $statut;

                // převedeme řetězec na čslo
                if ($statut == 0) {
                    //echo "ok";
                    $retezec = "0";
                    $statut = $retezec + 0;
                }

                if (isset($_POST['delkompl'])) {
                } else {
                    if (!is_numeric($statut)) {
                        echo '<span  class="warningRVS">Záznam není validní. Hodnota nesmí obsahovat písmena nebo být prázdná </span> ';
                        return;
                    }

                    if ($statut >= 3) {
                        echo '<span  class="warningRVS">Záznam není validní. Hodnota nesmí být větší než 2 </span>';
                        return;
                    }

                    if ($statut <= -1) {
                        echo '<span  class="warningRVS">Záznam není validní. Hodnota nesmí být menší než 0 </span>';
                        return;
                    }
                }





                global $wpdb;
                // Zde nastavte název tabulky ve vaší databázi
                $rvs_rezervace_table  = $wpdb->prefix . SQL_TABULKA_REZERVACE;

                //$record_id = 1; // Nahraďte za konkrétní ID

                // Nastavte novou hodnotu sloupce, který chcete aktualizovat
                $new_value = $statut;

                // Nastavte název sloupce, který chcete aktualizovat
                $column_name = 'statut';


                //$wpdb->query("UPDATE $rvs_anketa_dotaz_table_nazev SET OTAZKA = '$UPDATE_OTAZKA' WHERE ID = '$ID_ANKETY' " );

                // Použití prepare pro bezpečné zpracování dotazu



                $query = $wpdb->prepare(
                    "UPDATE $rvs_rezervace_table SET $column_name = %s WHERE id = %d",
                    $new_value,
                    $id
                );

                $result = $wpdb->query($query);

                if (false === $result) {
                    echo 'Chyba při aktualizaci záznamu: ' . $wpdb->last_error;
                } else {
                    if (!isset($_POST['delkompl'])) {

                        echo '<span  class="infoRVS">Záznam byl úspěšně aktualizován na statut - ' .  $new_value . '</span>  ';
                        //echo $this->presmerovaniNaStranku();
                    }
                }
            }
        }
    }
}
