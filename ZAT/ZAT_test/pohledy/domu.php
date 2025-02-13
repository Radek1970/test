
<!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">Úvod</h1>
                            <!-- Post meta content-->
                            
                        </header>
                        <!-- Preview image figure-->
                        
                       <?php
                        $vypis = new Seznam();
                        //nacita v info panelu bok_p.php
                        //echo $vypis->citac();
                        ?>

                        <section class="mb-5">
                            <h2 class="fw-bolder mb-4 mt-5">stručný popis.</h2>
                            <p class="fs-5 mb-4">
                            Evidence umožňuje zobrazení  (zobrazení s nastaveným filtrem) všech položek dohromady i po jednotlivých skupinách ( knihy, jen CD a jen DVD). 
                            Dále pak jednotlivé skupiny třídit podle statutu 1 - položka je ve stavu, a podle statutu 2 - položka není ve stavu (je zapůjčená.)
                            Když je pole (stav) prázdné (statut je 1),když je v poli řetězec znaků např. (zapůjčení nebo vyplněním jména půjčujícího) - (statut je 2).</p>

                            <p class="fs-5 mb-4"> Program umožnuje upravovat jednotlivé položky seznamu, zakládat položky a mazat je. U každé položky bude možné evidovat základní informace o díle (např. název, autor, datum vydání, popis atd.) </p>

                            
                        </section>


                    </article>

                    <!-- Comments section-->
                    <section class="mb-5">
                       
                    </section>
                </div>