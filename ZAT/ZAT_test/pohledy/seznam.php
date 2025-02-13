<!-- Page content-->
<div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <h1 class="fw-bolder mb-1"> Přehled seznamu / Eitace</h1><br>
                    <article>
        
        
                    
                                    <?php  
                                    

                                   

                                     $html = '';
                                     $vypis = new Databaze();
                                     $html .= $vypis->pozdravDB();

                                     $html .= '<br>';
                                     $vypis = new seznam();
                                     $html .= $vypis->pozdrav();
                                     $html .= '<br>';
                                     $html .= $vypis->seznamKrokuj();
                                     
                                     echo $html;
                                     ?>
                    
                    
                    </article>
                    
                </div>