<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <h1 class="fw-bolder mb-1">Formulář</h1><br>
            <article>



                <?php

                $vypis = new Seznam();
                //nacita v info panelu bok_p.php
                //echo $vypis->citac();

                // funkce na ochranu proti spamu
                $html = '';
                $vypis = new TabAdmin();
                $html .= $vypis->tabSeznamZpracuj();
                $html .= $vypis->tabSeznamFormular();
                echo $html;


                ?>


            </article>

        </div>