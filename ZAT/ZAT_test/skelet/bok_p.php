<?php

?>


<!-- Side widgets-->
<div class="col-lg-4">


    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">
            Administrace
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 btn-group ">

                    <a class="btn btn-outline-primary" role="button" href="index.php?stranka=seznam">SEZNAM / EDITACE</a>
                    <a class="btn btn-outline-primary" role="button" href="index.php?stranka=seznamform">VLOŽIT NOVÝ ZÁZNAM</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Info</div>
        <div class="card-body">
            <h5>
                <?php
               // $vypis = new Seznam();
                echo $vypis->citac();
                ?></h5>
        </div>
    </div>
</div>
</div>
</div>