<?php
require_once '../controllers/update-product.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Actualizar producto</title>
    <?php
      include_once "../resources/templates/css.html";
      include_once "../resources/templates/javascript.html";
    ?>
    <link rel="stylesheet" href="../resources/css/newproduct.css">
  </head>
  <body>
    <?php
    include_once '../resources/templates/headProfile.php';
    ?>
    <div class="container">
      <?php
        if ($message !== '') {
          echo "
                <div class='message-error'>
                  <p>" . $message . "</p>
                </div>
                ";
        }
      ?>
      <form method="POST" action=<?php echo "update-product.php?id=" . $productData['id']; ?> id="newProductForm"
        enctype="multipart/form-data">
        <div class="container-group">
          <div class="form-group">
            <label for="productname">Nombre del Producto</label>
            <input type="text" class="form-control" id="productname" name="name" aria-describedby="emailHelp"
              placeholder="Nombre del Producto" required value=<?php echo "" . $productData['title'] . ""; ?>>
          </div>
          <div class="form-group">
            <label for="price">Precio</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Ingrese el precio"
              value=<?php echo "" . $productData['price'] . ""; ?>>
          </div>
        </div>
        <div class="container-group">
          <div class="form-group">
            <label for="description">Descripcion</label>
            <textarea class="form-control" id="description" rows="3"
              name="description"><?php echo "" . $productData['description'] . ""; ?></textarea>
          </div>
          <div class="form-group">
            <label for="subdescription">Comentarios</label>
            <textarea class="form-control" id="subdescription" rows="3"
              name="subdescription"><?php echo "" . $productData['subDescription'] . ""; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          Seleccione las imagenes a eliminar:
          <div class="container" id="images-product" style="display:flex;flex-wrap:wrap;margin:auto;">
            <?php
            foreach ($imagesProduct as $image) {
              echo "<div>";
              echo "<div class='custom-control custom-checkbox' style='text-align:center;height:120px;margin: 0.5rem auto'>
                <input type='checkbox' class='custom-control-input' id='".$image['id']."' name='images[".$image['id']."]' value='".$image['id']."'>
                <label class='custom-control-label' for='".$image['id']."' style='margin-left:30px'>
                  <img src='".$image['image']."' class='img-thumbnail' alt='' style='margin:auto; display:block;width:100px;height:100px'>
                </label>
              </div>";
              echo "</div>";
            }
            ?>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" style="background-color: skyblue;" id="image" name="image[]"
              multiple required>
            <label class="custom-file-label" for="image" id="label-image" data-browse="Buscar"></label>
          </div>
        </div>
        <div class="form-group subcategories">
          <?php
          foreach ($categories as $category) {
            echo "<div class='custom-control custom-checkbox'>
                        <input type='checkbox' class='custom-control-input' id='" . $category->id . "' name='subcategory[" . $category->id . "]' value='" . $category->id . "'
                        ";
            foreach ($productData['categories'] as $key => $catProduct) {
              if ($key == $category->id) {
                echo "checked";
              }
            }
            echo ">
                  <label class='custom-control-label' for='" . $category->id . "'>" . utf8_encode($category->name) . "</label>
                </div>";
          }
          ?>
        </div>
        <div style="text-align:right">
          <button type="submit" class="btn btn-primary"
            style="background-color: skyblue; border-color: skyblue; color: black;">Guardar</button>
        </div>
      </form>
    </div>

    <script type="text/javascript">
      let cantImages = 10;
      let images = [];
      let elements = document.getElementById('images-product').getElementsByClassName('custom-control-input').length;
      cantImages -= elements;
      document.getElementById('label-image').innerHTML = `Imagen del producto (máximo ${cantImages})`;
      $('#images-product').on('change', function () {
        let elements = document.getElementById('images-product').getElementsByClassName('custom-control-input');
        for(let element of elements) {
          if (element.checked && !images.includes(element.name)) {
            images.push(element.name);
            cantImages++;
          } else if (!element.checked && images.includes(element.name)) {
            var index = images.indexOf(element.name);
            if (index > -1) {
              images.splice(index, 1);
            }
            cantImages--;
          }
          document.getElementById('label-image').innerHTML = `Imagen del producto (máximo ${cantImages})`;
        }
      });
      $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
      });

      $('#newProductForm').submit(function (e) {
        if (parseInt($('#image').get(0).files.length) > cantImages) {
          e.preventDefault();
          alert(`Puede subir hasta un máximo de ${cantImages} fotos`);
        }
      });
    </script>
  </body>
</html>
