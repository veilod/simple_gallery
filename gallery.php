<?php
if(empty($_FILES) === FALSE){

   $errors =[];
   $allowed_name = ['jpg', 'jpeg', 'png', 'gif', 'ico', 'tiff'];

//    echo '<pre>';
//    var_dump($_FILES);
//    echo '</pre>';
//    die;


   $file_name = $_FILES['image']['name'];
   $file_explpoaded = explode(".", $file_name);
   $file_ext = strtolower(end($file_explpoaded));
   $file_tmp = $_FILES['image']['tmp_name'];
   $file_size =$_FILES['image']['size'];

   if(!in_array($file_ext, $allowed_name)){
       $errors[] = " Файлы должны быть только изображением.";
   }

   if($file_size > 5 * 1024 * 1024 ){
       $errors[] = "Файл должен быть не более 5МБ";
   }

   if(empty($errors) === true){
       //закачка файла
       if(move_uploaded_file($file_tmp,  'uploads/' . $file_name)){
           echo"<div class='alert alert-success'>Файл закачен</div>";
       }
   }


}

?>

<?php
// папка загрузки
//$upload_dir = '/uploads';



//print_r($img);


function gallery($img){
    $img = scandir('uploads/');
    foreach ($img as $pic) {
        if ($pic != '.' and $pic != '..') {
            ?>
            <img src="uploads/<?php echo $pic ;?>">
            <?php
    }
}

}

function preview(){
    if (
}

?>



<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Document</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
   <?php
   if(empty($errors) === false){
       foreach($errors as $error){
           echo "<div class='alert alert-warning'> .$error </div>";
       }
   }
   ?>
   <h1>Форма отправки файла на сервер</h1>
   <form action="" method="post" enctype="multipart/form-data">
       <div class="form-group">
           <!-- <input type="hidden" name="MAX_FILE_SIZE" value="300000"> -->
       </div>
       <div class="form-group">
           <label for="file">Выбрать файл: </label>
           <input type="file" id="file" name="image">
       </div>
       <button type="submit" class="btn btn-primary">Закачать</button>
   </form>

    <hr>

    <div class="table-responsive">
        <div class="table table-striped"">
            <?php
            echo gallery($img);
            ?>
        </div>

    </div>
</div>



</body>
</html>