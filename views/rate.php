<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Calificar usuario</title>
    <?php
require_once "../resources/utils.php";
include_once "../resources/templates/css.html";
include_once "../resources/templates/javascript.html";
?>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../resources/css/rate.css">
    <script src="../resources/js/rate.js"></script>
</head>

<body><br>
    <div class="container">
        <div class="row">
            <?php 
                $rates = getRate($_POST['rated_user_id']);
                $ratings = array();
                foreach ($rates as $key => $value) {
                    array_push($ratings, $value['rate']);
                }
                $avgRate = array_sum($ratings)/count($ratings);
            ?>
            <h2>Califica al usuario <?php echo $_POST['rated_user_email'] ?></h2>
        </div><br>
        <h4>Calificación actual</h4> <input id="input-2" name="input-2" class="rating rating-loading" data-min="0"
            data-max="5" data-step="0.1" value="<?php echo $avgRate ?>" readonly><br>
        <h4>Tu calificación</h4>
        <form action="../controllers/rate.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $_POST['product_id'] ?>">
            <input type="hidden" name="rated_user" value="<?php echo $_POST['rated_user_id'] ?>">
            <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1"
                value="0">
            <label for="comment">Deja tu comentario</label>
            <textarea class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea><br>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

</body>

</html>