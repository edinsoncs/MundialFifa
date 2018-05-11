<?php


if(Session::exist('id')) {

    if(Settings::getPost()) {

        $file = Files::updateImg($_POST, $_FILES);
        if($file) {
            header('Location: index.php?action=panel');
            exit;
        }


        if(isset($_POST['figurita_photo'])) {

            $file = Files::newFigurita($_POST, $_FILES);
            if($file) {
              header('Location: index.php?action=panel');
            }
 
        }

        if(isset($_POST['close'])) {

            $close = Session::destroy();
            if($close) {
              header('Location: index.php');
              exit;
            }
 
        }
    } 


} 

else {
    header('Location: index.php');
    exit;
}


?>

<header class="header__Fifa pt-3 pb-3">
    <div class="container pl-0 d-flex pr-0 justify-content-between align-items-center">
        <h1 class="fifa__Name font-weight-light m-0">
            Fifa Album
        </h1>

    </div>
</header>

<main class="container pl-0 pr-0 d-flex justify-content-between align-items-start">
 <section class="mt-4 mb-4 col-lg-8 card pt-2">
    <header class="header__Sub pt-2 pb-2 pl-3 pr-3 text-center">
        <h2 class="font-weight-light text-white m-0">Mis figuritas</h2>
    </header>

    
    <div class="d-flex justify-content-between">
        <div class=" col-lg-12 pl-0 pr-0">
            <div class="d-flex justify-content-start football__Primary p-4 flex-wrap" id="js-append-list">

                <?php 
                    $list = Figurita::listAll();
                 ?>

                 <?php foreach ($list as $key): ?>
                    <article class="article__Random col-lg-3 mb-4">
                        <div class="card p-2">
                            <figure class="figure m-0">
                                <?php if($key['file']): ?>
                                  <img src="<?php Figurita::viewImg($key['file']); ?>" alt="" class="w-100 <?php echo $key['id'] ?>">
                                  <div class="add__Figure" onclick="createModal('<?php echo $key["id"] ?>'); return false;">
                                      <i class="fas fa-camera text-white"></i>
                                  </div>
                                <?php else: ?>
                                <img src="assets/img/avatar.png" alt="" class="w-100 <?php echo $key['id'] ?>">
                                <div class="add__Figure" onclick="createModal('<?php echo $key["id"] ?>'); return false;">
                                    <i class="fas fa-camera text-muted"></i>
                                </div>
                                <?php endif; ?>
                            </figure>
                            <header class="header text-center pt-2">
                                <h3 class="m-0 font-weight-light"><?php echo $key['name'] ?></h3>
                                <div class="flag text-center">
                                    <span class="text-muted small"><?php echo $key['citie'] ?></span>
                                </div>
                                <div class="detele-figurita" onclick="removeFiguritaPanel(this, <?php echo $key['id'] ?>);">
                                          <?php if($key['file']): ?>
                                             <i class="fas fa-trash text-white"></i>
                                          <?php else: ?>
                                             <i class="fas fa-trash text-muted"></i>
                                          <?php endif; ?>
                                       
                                    </form>
                                   
                                </div>
                            </header>
                        </div>
                    </article>

                <?php endforeach; ?>

            </div>
            <div class="football__Actions mt-4 pb-4">
                <ul class="ul m-0 p-0">

                    <li class="list d-block">
                        <a href="#" class="link bn btn-primary pt-2 pb-2 pl-5 pr-5 font-weight-bold btn-football-primary"  onclick="createModal(0); return false;">
                            <i class="fas fa-trophy"></i> Crear
                        </a>
                    </li>

                </li>

            </ul>
        </div>
    </div>



</div>
</section>

<aside class="mt-4 mb-4 col-lg-3 card pt-2">
    <header class="header__Sub pt-2 pb-2 pl-3 pr-3 text-center w-100">
        <h2 class="font-weight-light text-white m-0">Mis perfil</h2>
    </header>
    <?php $n = User::getAtavar(); ?>
    <figure class="figure__Sub w-100 mt-1" style='background: url("uploads/<?php echo $n->name;?>");background-size:cover; height:250px;'>
        <form action="index.php?action=panel" class="form__change__image text-center" method="post" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update" value="1">
            <input type="hidden" name="remove" value="<?php echo $n->id; ?>">
            <label for="image" class="js-label">Cambiar imagen</label>
            <input type="file" id="image" onchange="changePreview(this);" name="avatar" class="none">
            <input type="submit" class="js-send-image none" value="Actualizar ">
        </form>
    </figure>
    <ul class="ul__Sub">
        <li class="d-block text-center text-capitalize text-muted">
            <?php echo User::getUser()->name; ?>
        </li>
        <li class="d-block text-center">
          <form action="index.php?action=panel" method="post">
            <label for="close" class="btn btn-danger cursor mt-2">Salir</label>
            <input type="hidden" name="close" value="true">
            <input type="submit" class="none" id="close">
          </form>
        </li>
    </ul>

</aside>

</main>