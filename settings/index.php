<?php
$user = json_decode(file_get_contents('../users/username.json'));
$PIXEL_ID = $user->pixel_id;
?>

<div>
  <span><a href="/">Home</a></span>
  &nbsp;
  <span><a href="/settings">Settings</a></span>
</div>

<form action="./settings/updatePixelId.php" method="POST">
  <label for="pixel_id">Pixel ID</label>
  <input id="pixel_id" name="pixel_id" type="text" value="<?= $PIXEL_ID ?>" />
  <button type="submit">Save</button>
</form>