<?php 
    require_once "modules\database.php";

    $id = $_GET ['id'];

    $page_id = mysqli_query($mysqli, "SELECT `post_tags`.*, `db` .`id`, `name`, `author`, `type`, `categories`, `description` FROM `post_tags` INNER JOIN `db` ON `db`.`id` = `db`.`id` WHERE `db`.`id`='$id'");
    $page_id = mysqli_fetch_assoc($page_id);
    
    
  
   
?>

<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Материалы</title>
</head>
<body>
<div class="main-wrapper">
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="list-materials.php">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list-tag.php">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list-category.php">Категории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
        <input type="hidden" name="id" value="<?= $page_id['id']?>" >
            <h1 class="my-md-5 my-4"><?= $page_id['name']?></h1>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-8">
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                        <p class="col"><?= $page_id['author']?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                        <p class="col"><?= $page_id['type']?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                        <p class="col"><?= $page_id['categories']?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                        <p class="col"><?= $page_id['description']?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                        include "tags/tags_db.php";
                        $result = mysqli_query($mysqli, "SELECT * FROM `tags_test` ");
                        

                    ?>
                    <form action="mat_tags/post_mat_tag.php" method="post" >
                        <h3>Теги</h3>
                        
                        <div class="input-group mb-3">
                        <input type="hidden" name="id" value="<?= $page_id['id']?>" >

                            <select class="form-select" id="" aria-label="" name="id_tags" >
                            
                            <option selected ="true" disabled="disabled">Выбрать тег</option>
                            
                            <?php 
                            while ($tags = mysqli_fetch_assoc($result)){
                                
                        ?>      
                                <option name="name" value="<?= $tags['id_tags']?>"><?= $tags['name_tag']?></option>
                               
                                <?php 
                                
                            }
                            ?>
                            </select>
                            <button class="btn btn-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                    <?php
                        include "modules/database.php";
                        $res = mysqli_query($mysqli, "SELECT `post_tags`.*, `tags_test`.`name_tag` FROM `post_tags` INNER JOIN `tags_test` ON `tags_test`.`id_tags` = `post_tags`.`id_tags` WHERE `post_tags`.`id`='$id'")
                        ;                      
                    ?>
                    <ul class="list-group mb-4">
                    <?php 
                         
                            while ($ta = mysqli_fetch_assoc($res)){
                           

                        ?>
                        <li class="list-group-item list-group-item-action d-flex justify-content-between">
                       
                            <a href="list - search.php" class="me-3">
                            <?php echo $ta['name_tag']?>
                            
                            
                            </a>
                            <a href="mat_tags/delete_mat_tag.php?id=<?php echo $ta ['id_post']?>" onclick="return test();" class="text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd"
                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          
                                </svg>
                            </a>
                            <?php 
                            }
                            ?>
                        </li>  
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb-3">
                    <?php
                        include "tags/tags_db.php";
                        $resultat = mysqli_query($mysqli, "SELECT * FROM `links` WHERE `links`.`id`='$id'");
                        

                    ?>
                    
                    <input type="hidden" name="id" value="<?= $page_id['id']?>" >
                        <h3>Ссылки</h3>
                        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Добавить</a>
                        </form>
                    </div>
                        
                    <ul class="list-group mb-4">
                    <?php 
                         
                         while ($li = mysqli_fetch_assoc($resultat)){
                        

                     ?>
                    
                        <li class="list-group-item list-group-item-action d-flex justify-content-between">
                       
                      <a href="<?= $li['link']?>" class="me-3">
                                <?= $li['link_name']?>
                            </a>
                            <span class="text-nowrap">    
                            <a data-bs-toggle="modal" href="#exampleModalToggle2" class="text-decoration-none me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                            </a>
                        <a href="links/delete_link.php?id=<? echo $li ['id_link']?>"class="text-decoration-none" onclick="return test();">
                        <script>
                            function test(){
                                if(confirm("Удалить?")){
                                    return true;
                                }
                                else{
                                    return false;
                                }

                            }
                            </script>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                            
                        
                        </a>
                        </span>
                        
                         </li>
                         <?php 
                            }
                            ?>
                        </ul>
                   </div>
            </div>
        </div>
        
    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>

</div>
<form action="links/post_link.php" method="post" >
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Добавить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
            <input type="hidden" name="id" value="<?= $page_id['id']?>" >
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Добавьте подпись "
                           id="floatingModalSignature" name="link_name">
                    <label for="floatingModalSignature">Подпись</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>

                </div>
                <input type="hidden" name="id" value="<?= $page_id['id']?>" >
                <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Напишите авторов" name="link">
                    <label for="floatingModalLink">Ссылка</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>

        </div>
   
    </div>
</div>
</form>

<?php
 require 'links/tags_db.php';

    $id = $_GET ['id'];

    $update = mysqli_query($mysqli, "SELECT * FROM `links` WHERE `id_link` = '$id'");
   $update = mysqli_fetch_assoc($update);
    
?>         
<form action="links/update-link.php" method="post" >

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Изменить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
            <input type="hidden" name="id" value="<?= $update['id_link']?>" >
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Добавьте подпись "
                           id="floatingModalSignature" name="link_name" value="<?= $update['link_name']?>">
                    <label for="floatingModalSignature">Подпись</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>

                </div>
                <input type="hidden" name="id" value="<?= $page_id['id']?>" >
                <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Напишите авторов" name="link">
                    <label for="floatingModalLink">Ссылка</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>

        </div>
   
    </div>
</div>
</form>


<!-- Optional JavaScript; choose one of the two! -->
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>