

<?php 

require 'simple_html_dom.php';
require 'db.php';
 ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
   
<form action="" method="post">

<div class="containter">
	<div class="row">
		<div class="col-md-12 mt-5">
		<input type="" name="url" placeholder="Url gir "  class="form-control">

		<button type="submit" class="btn btn-primary mt-3 form-control">Veri Getir</button>
	</div>
	</div>
</div>
	

</form>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>












<?php 
if(@$_POST['url'])
{


$url = $_POST['url'];

$html = file_get_html($url);


$title=$html->find('div[class=pr-in-cn] span',0)->plaintext;

$fiyat=$html->find('span[class=prc-dsc]',0)->plaintext;


foreach ($html->find('div[class=info-wrapper] ul') as $key ) {
	$aciklama = $key->plaintext;

}

foreach($html->find('a[class=product-detail-breadcrumb-item] span') as $key)
{
	$kategori=$key->innertext;
}


$resim = $html->find('meta[property=og:image]',0)->getAttribute("content");




echo '<form action="" method="post">';

echo '<input class="form-control" name="title" value="'.$title.'"></input>';
echo "<br>";
echo '<input class="form-control" name="fiyat" value="'.$fiyat.'"></input>';
echo "<br>";
 
 echo '<textarea name="aciklama" class="form-control" id="exampleFormControlTextarea1" rows="3">'.$aciklama.'</textarea>';

echo "<br>";
echo '<select class="form-control" name="kategori" >
<option value="'.$kategori.'">'.$kategori.'</option>
</select>';
echo "<br>";
echo  '<input class="form-control" name="resim" value="'.$resim.'"></input>';
echo "<br>";
echo  '<button class="btn btn-success form-control" type="submit" name="kaydet" value="Kaydet">Kaydet</button>';
echo "</form>";


}

if(@$_POST['kaydet'])
{



$sql = "INSERT INTO urunler (baslik,aciklama,fiyat,resim,kategori)
VALUES ('$_POST[title]','$_POST[aciklama]','$_POST[fiyat]','$_POST[resim]','$_POST[kategori]')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else
{
	echo "Url kısmını boş bırakmayın";
}

 ?>
