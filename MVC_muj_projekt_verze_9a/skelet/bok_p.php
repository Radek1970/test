<?php

?>


<!-- Side widgets-->
<div class="col-lg-4">


    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">
            <?php
            $info = isset($_SESSION['uzivatel_jmeno']) ?  'Info panel | Odhlášení' : 'Přihlášení | registrace';
            echo $info;
            ?>
            

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 btn-group ">


                    <?php
                    //funkce nacitana ze slozky jadro soubor Fn 101; 
                    WidgetUzivatelPrihlasen();
                    ?>



                </div>
            </div>
        </div>
    </div>



    <!-- Side widget-->


    <?php
    //funkce nacitana ze slozky jadro soubor Fn 102; 
    WidgetUzivatelUcet();

    ?>










    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">info</div>
        <div class="card-body">Pro sjednání pojistky, je nutné se zaregistrovat. Poté je možné ve vašem účtu sjednávat pojištění.</div>
    </div>
</div>
</div>
</div>