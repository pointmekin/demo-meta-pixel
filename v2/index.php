<?php
// read the pixel_id from the user's json file
$user = json_decode(file_get_contents('../users/username.json'));
$PIXEL_ID = $user->pixel_id;
// $PIXEL_ID = "";
$tracking_enabled = !empty($PIXEL_ID) ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meta Pixel Events Demo</title>
  <!-- Facebook Pixel Code -->
  <!-- Only execute this script if pixel ID exists -->
  <?php if ($tracking_enabled) : ?>
    <script>
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?= $PIXEL_ID ?>');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" src="https://www.facebook.com/tr?id=<?= $PIXEL_ID ?>&ev=PageView&noscript=1" />
    </noscript>
  <?php endif; ?>
  <!-- End Facebook Pixel Code -->

</head>

<body>
  <div>
    <span><a href="/">Home</a></span>
    &nbsp;
    <span><a href="/settings">Settings</a></span>
  </div>
  <h1 id="meta-pixel-enabled" style="display: none;">Meta Pixel Enabled</h1>
  <button id="button-1" onclick="purchase1()">Button 1</button>
  <a href="#" id="link-1">Contact 1</a>
  <h3>Purchase</h3>

  <a href="#" id="628f11f443391-628f11f443397">
      Link 1
  </a>
  <a href="#" id="628f11f443391-628f11f443398">
      Link 2
  </a>
  <a href="#" id="628f11f443391-628f11f443399">
      Link 3
  </a>
  <a href="#" id="628f11f443391-628f11f443400">
      Link 4
  </a>
  <a href="#" id="628f11f443391-628f11f443401">
      Link 5
  </a>

  <button onclick="sendConversionEvent()">Send via Conversions API</button>

</body>

<script>
  let regex = /^[a-zA-Z0-9]{1,}-[a-zA-Z0-9]{1,}$/;
  const META_PIXEL_BUTTON = document.getElementById('meta-pixel-enabled');
  const isTrackingEnabled = Boolean("<?= $tracking_enabled ?>");
  if (isTrackingEnabled) {
    META_PIXEL_BUTTON.style.display = "block";
  }

  // create a function that takes a condition and callback
  // if the condition passes, call the callback
  const withTracking = (trackingEnabled, callback) => {
    if (trackingEnabled) callback();
  }

  const allLinks = document.getElementsByTagName('a');
  // filter only allLinks that has id matching regex
  const filteredLinks = Array.from(allLinks).filter(link => regex.test(link.id));
  // add event listener to all filteredLinks
  filteredLinks.forEach(link => {
    link.addEventListener("click", () => {
      withTracking(isTrackingEnabled, () => {
        fbq('trackCustom', 'ClickID', { id: link.id })
      })
    });
  });

  const sendConversionEvent = async () => {
    fetch('http://localhost:3000/v2/conversions.php')
  }
</script>

</html>


