<?php
    

    if(Session::exist('_continue')) {

        if(Settings::getPost()) {

            $file = Files::newImg($_POST, $_FILES);
            if($file) {
                header('Location: index.php?action=panel');
                exit;
            }
        } 


    } 

    else {
        header('Location: index.php');
        exit;
    }

    
    
 
 ?>


 <main class="main__Pre container">
     
    
    <section class="section__Pre col-lg-4 mt-5 pt-5">
        <header class="header__Pre text-center">
            <h2 class="text-white font-weight-light">Continuar registro</h2>
            <p class="text-white m-0 small pb-2">Para finalizar el registro subi una foto de tu perfil</p>
        </header>
        
        <form action="index.php?action=continueregister" method="post" enctype="multipart/form-data">
            <input type="hidden" name="complet" value="1">
            <div class="form-group">
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Continuar" class="btn input-fifa-new ">
            </div>
        </form>

    </section>

 </main>