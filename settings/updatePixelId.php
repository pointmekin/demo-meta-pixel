<?php
  // takes user input then modify the pixel_id field of username.json file
  $user = json_decode(file_get_contents('../users/username.json'));
  $user->pixel_id = $_POST['pixel_id'];
  file_put_contents('../users/username.json', json_encode($user));
  header("Location: /settings");
  exit;
?>