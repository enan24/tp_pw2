<?php
  include_once "../controllers/product.php";
  header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="icon" href="../resources/img/favico.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nuevo Producto - <?php echo $parte ?></title>
    <?php
      include_once "../resources/templates/css.html";
      include_once "../resources/templates/javascript.html";
    ?>
    <link rel="stylesheet" href="../resources/css/newproduct.css">
  </head>
  <body>
    <?php
      include_once('../resources/templates/head.php');
    ?>
    <?php
      if ($categoryProduct === '') {
    ?>
      <div class="container inline-container">
        <div class="card car-card">
          <a href="new-product.php?category=1" class="card-text car">Vehículos</a>
        </div>
        <div class="card propiertes-card">
          <a href="new-product.php?category=2" class="card-text propiertes">Inmuebles</a>
        </div>
        <div class="card services-card">
          <a href="new-product.php?category=3" class="card-text services">Servicios</a>
        </div>
        <div class="card products-card">
          <a href="new-product.php?category=4" class="card-text products">Productos y otros</a>
        </div>
      </div>
      <?php
    } else {
    ?>
      <div class="container">
        <?php
          if ($message !== '') {
            echo "
              <div class='message-error'>
                <p>".$message."</p>
              </div>
              ";
          }
        ?>
        <form method="POST" action=<?php echo "new-product.php?category=".$categoryProduct; ?> enctype="multipart/form-data">
          <div class="container-group">
            <div class="form-group">
              <label for="productname">Nombre del Producto</label>
              <input type="text" class="form-control" id="productname" name="name" aria-describedby="emailHelp" placeholder="Nombre del Producto" required value=<?php echo "".$productData['title'].""; ?>>
            </div>
            <div class="form-group">
              <label for="price">Precio</label>
              <input type="text" class="form-control" id="price" name="price" placeholder="Ingrese el precio" value=<?php echo "".$productData['price'].""; ?>>
            </div>
          </div>
          <div class="container-group">
            <div class="form-group">
              <label for="description">Descripcion</label>
              <textarea class="form-control" id="description" rows="3" name="description"><?php echo "".$productData['description'].""; ?></textarea>
            </div>
            <div class="form-group">
              <label for="subdescription">Comentarios</label>
              <textarea class="form-control" id="subdescription" rows="3" name="subdescription"><?php echo "".$productData['subDescription'].""; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" style="background-color: skyblue;" id="image" name="image" required>
              <label class="custom-file-label" for="image" data-browse="Buscar">Imagen del producto</label>
            </div>
          </div>
          <div class="form-group subcategories">
              <?php
                // print_r($productData);
                foreach ($categories as $category) {
                  // $checked = '';
                  // if($category->id === $productData['idSubCategory']) {
                  //   $checked = checked;
                  // }
                  echo "<div class='custom-control custom-checkbox'>
                    <input type='checkbox' class='custom-control-input' id='".$category->id."' name='subcategory[".$category->id."]' value='".$category->id."'>
                    <label class='custom-control-label' for='".$category->id."'>".utf8_encode($category->name)."</label>
                  </div>";
                }

              ?>
          </div>
          <div style="text-align:right">
            <button type="submit" class="btn btn-primary" style="background-color: skyblue; border-color: skyblue; color: black;">Guardar</button>
          </div>
        </form>
      </div>
      <?php
        }
      ?>
      <script type="text/javascript">
        $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
      </script>
  </body>
</html>
