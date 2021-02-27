<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TC Kimlik Sorgula</title>
  <link rel="stylesheet" href="assets/style.css">
  <link rel="shortcut icon" href="assets/fez.png" type="image/x-icon">
</head>

<body>
  <?php
    $tcNo = "";
    if (empty($_REQUEST['tcNo'])) {
      echo "";
    } else {
      $tcNo = $_REQUEST["tcNo"];
    }

    $tcArr = str_split($tcNo);
    $odd = $even = $sum = $tenDigit = $lastDigit = 0;
    foreach ($tcArr as $key => $value) {
      if ($key != 10 && ($key % 2 == 0)) {
        $odd += (int)$value;
      }
      else if ($key != 9 && $key != 10){
        $even += (int)$value;
      }
      if ($key != 10) {
        $lastDigit += (int)$value;
      }
    }

    $tenDigit = ($odd * 7) - $even;
    $tenDigit %= 10;
    $lastDigit %= 10;
  ?>
  <div class="container">
    <div class="check">
      <button class="refresh" onclick="redirect()" title="Yenile"></button>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="number" onKeyPress="if (this.value.length == 11) return false;" min="10000000000" name="tcNo" placeHolder="TC Kimlik Numarası">
        <button class="submit" type="submit">TC Kimlik Sorgula</button>
      </form>
      <div class="output">
        <?php
          if (empty($_REQUEST['tcNo'])) {
            echo 'TC Kimlik Numarası Giriniz';
          } else if (($tenDigit == $tcArr[9] && $lastDigit == $tcArr[10]) && $tcNo == '10000000146') {
            echo "<audio controls autoplay hidden><source src='assets/march.mp3' type='audio/mpeg'></audio>";
            echo "<span><span style='color: #EC384B;font-weight: 600;margin-right: 5px;'>TC NO:</span>".$tcNo."</span>";
            echo "<div class='success'>YAŞA MUSTAFA KEMAL PAŞA YAŞAAA</div>";
          } else if ($tenDigit == $tcArr[9] && $lastDigit == $tcArr[10]) {
            echo "<span><span style='color: #EC384B;font-weight: 600;margin-right: 5px;'>TC NO:</span>".$tcNo."</span>";
            echo "<div class='success'>TC Kimlik Numarası Doğrudur</div>";
          } else {
            echo "<span><span style='color: #EC384B;font-weight: 600;margin-right: 5px;'>TC NO:</span>".$tcNo."</span>";
            echo "<div class='error'>TC Kimlik Numarası Standart Dışıdır</div>";
          }
        ?>
      </div>
    </div>
  </div>

  <script>
    function redirect() {
      window.location.href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>";
    }
  </script>
</body>

</html>