<?php
$OGtitle = isset($title) ? $title : 'Voyagers Beat | You Just pack your bags let us do the rest.';
$OGmetadesc = isset($meta_desc) ? $meta_desc : 'Voyagers beat is a travel agency which offers off beat destinations in Himachal Pradesh like kasol, Manali also like Rishikesh with river rafting & paragliding.';
$OGimage = isset($image) ? $image : 'https://voyagersbeat.com/assets/logo.png';
$robotState = (isset($noindex) && $noindex == 1) ? 1 : 0;
$OGurl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$OGdomain = "$_SERVER[HTTP_HOST]";
$OGtype = 'website';
$canonical = (isset($canonical)) ? $canonical : '';
?>
<!-------Meta Tags----------->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta name="view-transition" content="same-origin" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="Cache-Control" content="public" />

<meta name="p:domain_verify" content="4d8b4adf78ab58b1c006fbcc8a1c6e6e" />
<meta name="facebook-domain-verification" content="xmc5nhcysb61ozaj9kez66sv9cmgl4" />

<!-- HTML Meta Tags -->
<title><?= $OGtitle ?></title>
<meta name="description" content="<?= $OGmetadesc ?>">

<!-- Facebook Meta Tags (1173x759px, 298.3 KB) -->
<!-- Meta Tags Generated via OpenGraph Preview Extension -->
<meta property="og:url" content="<?= $OGurl ?>">
<meta property="og:type" content="<?= $OGtype ?>">
<meta property="og:title" content="<?= $OGtitle ?>">
<meta property="og:description" content="<?= $OGmetadesc ?>">
<meta property="og:image" content="<?= $OGimage ?>">
<meta property="og:logo" content="<?= $OGimage ?>" />

<!-- Twitter Meta Tags (1173x759px, 298.3 KB) -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="<?= $OGdomain ?>">
<meta property="twitter:url" content="<?= $OGurl ?>">
<meta name="twitter:title" content="<?= $OGtitle ?>">
<meta name="twitter:description" content="<?= $OGmetadesc ?>">
<meta name="twitter:image" content="<?= $OGimage ?>">

<link rel="canonical" href="<?= base_url() ?><?= $canonical ?>" />

<link rel="manifest" href="/manifest.json">
<link rel="apple-touch-icon" href="/icon-192x192.png">
<meta name="color-scheme" content="light">
<meta name="theme-color" content="#ffffff">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<?php if ($robotState): ?>
  <meta name="robots" content="noindex" />
<?php endif; ?>

<!-------Meta Tags----------->


<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Voyagers Beat",
    "url": "https://voyagersbeat.com/",
    "logo": "https://voyagersbeat.com/assets/logo-comp.png",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+91 8448591315",
      "contactType": "customer service",
      "areaServed": "IN",
      "availableLanguage": "en"
    },
    "sameAs": [
      "https://www.instagram.com/voyagersbeat/",
      "https://www.facebook.com/voyagersBeat/",
      "https://www.youtube.com/@voyagersbeat",
      "https://www.linkedin.com/company/voyagersbeat07"
    ]
  }
</script>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Voyagers Beat",
    "image": "https://voyagersbeat.com/assets/logo-comp.png",
    "@id": "",
    "url": "https://voyagersbeat.com/",
    "telephone": "+91 8448591315",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Aggarwal Plaza, B8 H7, Netaji Subhash Place, Pitampura, Delhi, 110034",
      "addressLocality": "Delhi",
      "postalCode": "110034",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 28.693587,
      "longitude": 77.1471682
    },
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
      ],
      "opens": "00:00",
      "closes": "23:59"
    },
    "sameAs": [
      "https://www.facebook.com/voyagersBeat/",
      "https://www.instagram.com/voyagersbeat/",
      "https://www.youtube.com/@voyagersbeat",
      "https://www.linkedin.com/company/voyagersbeat07",
      "https://voyagersbeat.com/"
    ]
  }
</script>