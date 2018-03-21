<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <meta name=description content="Github Cards">
  <title>Github Cards</title>

  <!-- Theme color -->
  <meta name="theme-color" content="#1E88E5">

  <!-- For iOS -->
  <meta name="application-name" content="Github Cards">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Github Cards">

  <!-- Windows -->
  <meta name="msapplication-TileColor" content="#1E88E5">
  <meta name="msapplication-TileImage" content="./images/touch/mstile-150x150.png">

  <!-- iOS touch icons -->
  <link rel="apple-touch-icon" href="./images/touch/apple-touch-icon.png">

  <!-- Android icon -->
  <link rel=icon sizes="192x192" href="./images/touch/android-chrome-192x192.png">

  <!-- Favicons -->
  <link rel="icon" type="image/png" href="./images/touch/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="./images/icons/favicon-16x16.png" sizes="16x16">
  <link rel="shortcut icon" href="./favicon.ico">

  <!-- Manifest for add to homescreen, splash screen etc, -->
  <link rel="manifest" href="./manifest.json">

  <link href="./css/styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>
<body>

  <!-- Header  -->
  <header class="header">
    <div class="header__container">
      <div class="header__icon">
        <svg width="24px" height="24px" viewBox="0 0 48 48" fill="#fff">
          <path d="M6 36h36v-4H6v4zm0-10h36v-4H6v4zm0-14v4h36v-4H6z"></path>
        </svg>
      </div>
      <span aria-hidden="true">Github Cards</span>
    </div>
  </header>

  <!-- Menu  -->
  <div class="menu">
    <div class="menu__header"></div>
    <ul class="menu__list">
      <li><a href="/">Home</a></li>
      <li><a href="https://github.com/AnujDuggal88/pwa-codelabs/">Source</a></li>
    <ul>
  </div>

  <!-- Menu Overlay  -->
  <div class="menu__overlay"></div>

  <!-- Main Content -->
  <div class="main">

    <img class="main__loader hide" src="./images/loading.gif" alt="loading..." />

    <!-- Github Card Template -->
    <div class="github__card hide">
      <div class="github__header">
        <img class="github__avatar" src="" alt="avatar" />
        <a class="github__link" href="#" target="_blank">
          <div class="link icon"></div>
        </a>
      </div>

      <div class="github__body">
        <div class="github__body-content hide">
          <div class="name">
          <span></span>
          </div>
          <div class="location">
            <span></span>
          </div>
          <div class="bio">
            <span class="github__title">Bio:</span>
            <span class="text"></span>
          </div>
        </div>
      </div>

      <div class="github__footer">
        <div class="github__footer-content hide">
          <div class="repos">
            <span class="text"></span>
            <span class="github__title"> Repos</span>
          </div>

          <div class="followers">
            <span class="text"></span>
            <span class="github__title"> Followers</span>
          </div>

          <div class="following">
            <span class="text"></span>
            <span class="github__title"> Following</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Card -->
  <div class="main__fab">
    <img src="./images/fab_add.svg" alt="Add card" />
  </div>

  <!-- Add Card Dialog -->
  <div class="dialog dialog--hide">
    <div class="dialog__content">
      <div class="dialog__close">
        <svg class="" viewBox="0 0 24 24">
          <path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z">
          </path>
          <path d="M0 0h24v24h-24z" fill="none"></path>
        </svg>
      </div>
      <input type="text" class="dialog__input" placeholder="Enter github username">
      <button class="dialog__add">Add</button>
    </div>
    <div class="dialog__overlay"></div>
  </div>

  <!-- Snackbar notification  -->
  <div class="snackbar">
    <p class="snackbar__msg no--select"></p>
  </div>

  <!-- JS Files -->
  <script type="text/javascript">
    // If service worker is supported, then register it.
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('./service-worker.js', { scope: './' }) //To set service worker scope
        .then(function (register) {
          if (register.installing) {
            console.info('[REGISTER] Service worker is installing');
          }
          else if (register.waiting) {
            console.info('[REGISTER] Service worker is waiting');
          }
          else if (register.active) {
            console.info('[REGISTER] Service worker is active');
          }
        })
        .catch(function (error) {
          console.warn('[REGISTER] Service worker registration failed ', error);
        });
    }
    else {
      console.warn('[REGISTER] Service worker is not supported');
    }
  </script>

  <script src="./js/fetch-polyfill.js" type="text/javascript"></script>
  <script src="./js/menu.js" type="text/javascript"></script>
  <script src="./js/snackbar.js" type="text/javascript"></script>
  <script src="./js/app.js" type="text/javascript"></script>
</body>
</html>
