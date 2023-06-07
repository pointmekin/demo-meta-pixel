<?php

$PIXEL_ID = '6477425325652713';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meta Pixel Events Demo</title>
  <!-- Facebook Pixel Code -->
  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?= $PIXEL_ID ?>');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1"
    src="https://www.facebook.com/tr?id=<?= $PIXEL_ID ?>&ev=PageView&noscript=1" />
  </noscript>
  <!-- End Facebook Pixel Code -->

</head>

<body>
  <button id="button-1" onclick="purchase1()">Button 1</button>
  <a href="#" id="link-1">Contact 1</a>
  <h3>Purchase</h3>
  <?php for ($i = 0; $i < 10; $i++) : ?>
    <!-- Method 1: Bind pixel event by setting onclick to call fbq function direclty in PHP -->
    <button onclick="fbq('track', 'Purchase', { currency: 'USD', value: <?= $i * 10 ?> })">Product <?= $i ?></button>
  <?php endfor; ?>
</body>

<script>
  // Method 2: Bind pixel events to JS click events

  // Purchase event
  const purchase1 = () => {
    fbq('track', 'Purchase', { currency: "USD", value: 30.00 });

  }
  // Contact event
  const link1 = document.getElementById('link-1');
  link1.addEventListener('click', () => {
    fbq('track', 'Contact', { content_name: "Shopee" });
  });
</script>

</html>