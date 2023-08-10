<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Captcha</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="../logo.jpg" />
</head>

<body>
  <?php
  require('isicaptcha.php');
  ?>
  <div class="container">
    <h3 style="text-align: center">Isi Captcha dengan Benar</h3>
    <form action="index.php" method="post">
      <table align="center">
        <td>Captcha</td>
        <td><img src="captcha.php" alt="gambar"></td>
        <tr>
          <td>Isikan Captcha</td>
          <td><input type="text" name="nilaiCaptcha" value="" /></td>
        </tr>
      </table>
      <p><?php echo $hasil; ?></p>
      <input type="submit" name="kirim" Value="Cek Captcha">
    </form>
  </div>
</body>

</html>