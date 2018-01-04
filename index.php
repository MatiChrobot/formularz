<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>
<head>
<meta name="handheldFriendly" content="true" />
<meta name="MobileOptimized" content="240">
<meta name="viewport" content="width=device-width; initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Formularz</title>
<style>
.blad {color: #FF0000;}
</style>
</head>
<body>  

<?php
$imieErr = $nazwiskoErr = $wiekErr = $emailErr = "";
$imie = $nazwisko  = $wiek = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["imie"])) {
    $imieErr = "Imię jest wymagane";
  } else {
    $imie = test_input($_POST["imie"]);
  }
  
  if (empty($_POST["nazwisko"])) {
    $nazwiskoErr = "Nazwisko jest wymagane";
  } else {
    $nazwisko = test_input($_POST["nazwisko"]);
  }

  if (empty($_POST["wiek"])) {
    $wiekErr = "Wiek jest wymagane";
  } else {
    $wiek = test_input($_POST["wiek"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "E-mail jest wymagane";
  }else{
    $email = test_input($_POST["email"]);
  }
}

//https://www.techfry.com/php-tutorial/validate-form-data-with-php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  
$formularz='Imię: '.$imie.' Nazwisko: '.$nazwisko.' Wiek: '.$wiek.' Email: '.$email;


@$plik=fopen('formularz.txt','w');

fwrite($plik,$formularz);
flock($plik, LOCK_UN);
fclose($plik);

?>

<h2>Formularz</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Imię: <input type="text" name="imie">
  <span class="blad">* <?php echo $imieErr;?></span>
  <br><br>
  Nazwisko: <input type="text" name="nazwisko">
  <span class="blad">* <?php echo $nazwiskoErr;?></span>
  <br><br>
  Województwo: 
  <?php
  $plik1 = "wojewodztwo.txt";
  $woj = file($plik1, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $select = count($woj);
  echo '<select name="file[]">';
  for($i=0; $i<$select; $i++) {
	  echo '<option value="'. urlencode($woj[$i]).'">'.$woj[$i].'</option>';
	  }
	  echo '</select>';
	  ?>
  <?php
    echo ''
/*
  <form action="wojewodztwo.php" method="post">
  <select name="wojewodztwo">
  <option value=""></option>
  <option value=""></option>
  <option value=""></option>
  <option value=""></option>
  </select>*/
  ?> 
  <br><br>
  Wiek: <input type="number" name="wiek">
  <span class="blad">*<?php echo $wiekErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="blad">* <?php echo $emailErr;?></span>
  <br><br>
  <input type="submit" name="podaj" value="Podaj">  
  <br><br>
  <p><span class="blad">* pole obowiązkowe</span></p>
</form>

</body>
</html>