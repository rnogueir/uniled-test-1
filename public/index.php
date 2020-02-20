<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

?>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UniLED Technical Test 1</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

  <div class='main'>

    <h1>Send to a friend</h1>

    <p class='call-to-action'>Share this great deal with friends!</p>


<?php
  session_start();
  if($_SESSION['error_msg'] != null)
  {
?>
    <p class='alert'>You must give a valid e-mail address!</p>
<?php
  }
  unset($_SESSION['error_msg']);
?>


    <form id='form' method='post' action='post.php'>
      <table id='form-table' width='600' align='center'>
        <tr>
          <td class='label-cell'><label for='referrer_name'><b> Your name *</b></label></td>
          <td class='input-cell'><input name='referrer_name' type="text"></td>
        </tr>
        <tr>
          <td class='label-cell'><label for='friend_name'><b> Friend's name *</b></label></td>
          <td class='input-cell'><input name='friend_name' type="text"></td>
        </tr>
        <tr>
          <td class='label-cell'><label for='friend_email'><b> Friend's e-mail *</b></label></td>
          <td class='input-cell'><input name='friend_email' type="text"></td>
        </tr>
        <tr>
          <td class='label-cell'>&nbsp;</td>
          <td class='input-cell'><input value='Submit' type="submit"></td>
        </tr>
      </table>
    </form>

  </div>

</body>

</html>
