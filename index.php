<?php
// read the pixel_id from the user's json file
$user = json_decode(file_get_contents('./users/username.json'));
$PIXEL_ID = $user->pixel_id;
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

  <?php for ($i = 0; $i < 10; $i++) : ?>
    <!-- Method 1: Bind pixel event by setting onclick to call fbq function direclty in PHP -->
    <!-- Directly setting the tracking function when renderring -->
    <button onclick="withTracking(
      <?= $tracking_enabled ?>,
      () => fbq('track', 'Purchase', { currency: 'USD', value: <?= $i * 10 ?> }))">Product <?= $i ?></button>
  <?php endfor; ?>

  <h3>Discount</h3>

  <!-- Method 2: Bind custom pixel events to onclick using PHP -->
  <!-- Directly setting the tracking function when renderring -->
  <button onclick="withTracking(
      <?= $tracking_enabled ?>,
      () => fbq('trackCustom', 'ShareDiscount', {promotion: 'share_discount_10%'}))">Get10% Discount</button>
  <?php ?>
</body>

<script>
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

  // Method 3: Bind pixel events to JS click events

  // Default event: Purchase
  // Clean example using function
  const purchase1 = () => {
    withTracking(isTrackingEnabled, () => {
      fbq('track', 'Purchase', {
        currency: 'USD',
        value: 10
      });
    })
  }

  // Default event: Contact
  // Using event listener
  const link1 = document.getElementById('link-1');
  link1.addEventListener("click", () => {
    withTracking(isTrackingEnabled, () => {
      fbq('track', 'Contact', {
        content_name: "Shopee"
      });
    })
  });
</script>

</html>