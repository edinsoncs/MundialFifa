<?php 

    if(Settings::getPost()) {

        /**
         * [$vl new of instance]
         * @var Validation
         */
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
                    User::created($_POST);
                    Session::set('create', 'Se registro el usuario correcto');
                    header("Location: index.php");
                    exit;
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
                <div class="main__Home--SubHeader text-center mb-4">
                    <h2 class="text-white m-0 font-weight-light">Crear cuenta</h2>
                </div>
                <div class="from-group">
                    

                     <?php if(Session::exist('_save_email')): ?>

                        <input type="text" class="form-control input-fifa-new" placeholder="Email" name="email" value="<?php echo Session::once('_save_email'); ?>" >

                     <?php else: ?>

                        <input type="text" class="form-control input-fifa-new" placeholder="Email" name="email"  >

                    <?php endif; ?>

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
                    
                    <?php if(Session::exist('__exist_email')): ?>
                        <span class="badge badge-danger w-100">
                            <?php echo Session::once('__exist_email'); ?>
                        </span>
                    <?php endif; ?>

                </div>
                <div class="from-group mt-2">
                    <input type="text" class="form-control input-fifa-new" placeholder="Nickname" name="username">
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
                    <input type="submit" value="Crear cuenta" class="btn input-fifa-btn1 input-fifa-height">
                </div>
                <div class="from-group text-center pt-2">
                    <span class="text-white small">Ya tienes una cuenta? <a href="<?php echo Url::home(); ?>" class="link">Ingresar</a></span>
                </div>
            </form>
        </section>

    </main>