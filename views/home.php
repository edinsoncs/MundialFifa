<?php 

if(Settings::getPost())  {


    $vl = new Validation();

    $vl->email = function($value, $key, $self) {

        if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
        {
            return 'Escriba un email mas seguro!';

        }  else {
            Session::set('_save_email', $value);
        }
    };

    $vl->password = function($value, $key, $self)
    {
        if(strlen($value) < 8)
        {
            return 'Escriba una contraseña mas segura!';
        }
    };

    if($vl($_POST)) {
        if($vl->done()) {
            try {
               if(Auth::login($_POST['email'], $_POST['password'])) {

                 //Verify if avatar
                 $verify_avatar = User::verifyStatus();
                 if($verify_avatar) {

                    Session::set('_continue', false);
                    header('Location: index.php?action=panel');

                 } else {

                    Session::set('_continue', true);
                    header('Location: index.php?action=continueregister');

                 }

                 
                 exit;
               
               } else {
                 header('Location: index.php?status=erroraccount');
                 exit;
               }
            } catch (Exception $e) {
                    
            }

        } else {
            var_dump('errors');
        }

    }


}


 ?>



<main class="main__Home">

        <section class="main__Home--Section">
            <form action="" class="form col-lg-3 mt-5 pt-5" method="post">
                <div class="main__Home--Header text-center mb-4">
                    <img src="assets/img/logo.jpg" alt="" class="w-100">
                </div>
                <div class="from-group">
                    <input type="text" class="form-control input-fifa-new" placeholder="Email" name="email">
                    <?php 

                        if(Settings::getPost()): ?>

                            <?php if(!$vl($_POST)): ?>

                                <?php if (isset($vl->errors()['email'])): ?>

                                    <span class="badge badge-danger w-100">
                                        <?php echo $vl->errors()['email']; ?>
                                    </span>

                                <?php endif; ?>

                            <?php endif; ?>
        
                    <?php endif; ?>
                </div>
                <div class="from-group mt-2 mb-2">
                    <input type="password" class="form-control input-fifa-new" placeholder="Password" name="password">
                    <?php if(Settings::getPost()): ?>

                        <?php if(!$vl($_POST)): ?>

                            <?php if (isset($vl->errors()['password'])): ?>

                                <span class="badge badge-danger w-100">
                                    <?php echo $vl->errors()['password']; ?>
                                </span>

                            <?php endif; ?>

                        <?php endif; ?>
    
                    <?php endif; ?>
                </div>
                <div class="from-group text-center mt-4">
                    <input type="submit" value="Ingresar" class="btn input-fifa-btn1 input-fifa-height">
                </div>
                <div class="from-group text-center pt-2">
                    <span class="text-white small">Aun no tienes cuenta? 
                        <a href="<?php echo Url::home(); ?>?action=register" class="link" >Registrate</a></span>
                </div>
            </form>
        </section>

    </main>