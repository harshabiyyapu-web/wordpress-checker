<?php
/**
 * Template Name: St Augustine Custom Landing
 * Description: Self-contained custom WordPress page template for the St Augustine landing page.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php wp_title('|', true, 'right');
  bloginfo('name'); ?></title>
  <?php wp_head(); ?>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap");

    :root {
      --header-blue: #16598d;
      --hero-top: #3196df;
      --hero-mid: #2486cf;
      --hero-bottom: #39a2e5;
      --page-bg: #ececec;
      --copy-blue: #1f6fcd;
      --footer-copy: #707070;
      --white: #ffffff;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      min-width: 320px;
      background: var(--page-bg);
      font-family: "Open Sans", Arial, sans-serif;
      color: #111;
    }

    body {
      overflow-x: hidden;
    }

    a {
      color: inherit;
      text-decoration: none;
      cursor: default;
    }

    img {
      display: block;
      max-width: 100%;
    }

    .sa-page-template {
      width: 100%;
      background: var(--page-bg);
    }

    .sa-topbar {
      background: var(--header-blue);
      padding: 52px 24px 63px;
    }

    .sa-nav {
      width: min(100%, 1110px);
      margin: 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 18px 38px;
    }

    .sa-nav a {
      font-size: 22px;
      font-weight: 400;
      color: var(--white);
      line-height: 1.2;
      pointer-events: none;
      user-select: none;
    }

    .sa-notice {
      padding: 56px 0 42px;
    }

    .sa-welcome {
      margin: 0 0 18px;
      text-align: center;
      color: var(--copy-blue);
      font-size: 27px;
      font-weight: 700;
    }

    .sa-notice-copy {
      width: min(100%, 2048px);
      margin: 0 auto;
      color: var(--copy-blue);
      font-size: 21px;
      line-height: 1.9;
      font-weight: 700;
    }

    .sa-bless {
      width: min(100%, 2048px);
      margin: 48px auto 0;
      color: var(--copy-blue);
      font-size: 25px;
      font-weight: 700;
    }

    .sa-hero {
      background: linear-gradient(180deg, var(--hero-top) 0%, var(--hero-mid) 45%, var(--hero-bottom) 100%);
      padding: 63px 24px 98px;
      color: var(--white);
    }

    .sa-hero-image-frame {
      width: min(100%, 1616px);
      margin: 0 auto 28px;
      border: 3px solid rgba(255, 255, 255, 0.8);
    }

    .sa-hero-image-frame img {
      width: 100%;
      height: auto;
    }

    .sa-hero-title {
      margin: 0 0 45px;
      text-align: center;
      font-size: 74px;
      line-height: 1.08;
      font-weight: 300;
      letter-spacing: 5px;
    }

    .sa-churches {
      width: min(100%, 1650px);
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 40px;
    }

    .sa-church {
      text-align: center;
      padding: 0 10px;
    }

    .sa-church h2 {
      margin: 0 0 22px;
      font-size: 31px;
      line-height: 1.2;
      font-weight: 400;
    }

    .sa-church h3 {
      margin: 0 0 23px;
      font-size: 31px;
      line-height: 1.2;
      font-weight: 400;
    }

    .sa-church p {
      margin: 10px 0;
      font-size: 28px;
      line-height: 1.42;
      font-weight: 400;
    }

    .sa-strong {
      font-weight: 700;
    }

    .sa-intro {
      padding: 70px 24px 78px;
    }

    .sa-intro p {
      width: min(100%, 1590px);
      margin: 0 auto;
      text-align: center;
      color: #3a8fd6;
      font-family: Georgia, "Times New Roman", serif;
      font-size: 41px;
      line-height: 1.35;
      font-weight: 700;
    }

    .sa-contact-band {
      width: min(100%, 2048px);
      margin: 0 auto;
      padding: 0 3px;
      display: grid;
      grid-template-columns: 450px minmax(0, 1fr) 506px;
      align-items: stretch;
    }

    .sa-side-image img,
    .sa-contact-top img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .sa-contact-card {
      display: grid;
      grid-template-rows: 261px auto;
    }

    .sa-contact-content {
      background: var(--header-blue);
      color: var(--white);
      text-align: center;
      padding: 0 20px 12px;
    }

    .sa-contact-content h2 {
      margin: 0;
      padding-top: 4px;
      font-size: 35px;
      line-height: 1.15;
      font-weight: 400;
    }

    .sa-contact-content p {
      margin: 30px 0;
      font-size: 33px;
      line-height: 1.32;
      font-weight: 400;
    }

    .sa-footer {
      padding: 46px 24px 52px;
      text-align: center;
    }

    .sa-footer p {
      margin: 0;
      color: var(--footer-copy);
      font-size: 25px;
      line-height: 1.5;
      font-weight: 400;
    }

    .sa-footer .sa-nh {
      margin-top: 6px;
      font-size: 15px;
    }

    @media (max-width: 1600px) {
      .sa-hero-title {
        font-size: 62px;
      }

      .sa-church p {
        font-size: 24px;
      }

      .sa-intro p {
        font-size: 34px;
      }

      .sa-contact-band {
        grid-template-columns: 300px minmax(0, 1fr) 330px;
      }

      .sa-contact-card {
        grid-template-rows: 210px auto;
      }

      .sa-contact-content p {
        font-size: 28px;
      }
    }

    @media (max-width: 1100px) {
      .sa-topbar {
        padding: 28px 16px 32px;
      }

      .sa-nav {
        gap: 14px 20px;
      }

      .sa-nav a {
        font-size: 18px;
      }

      .sa-notice {
        padding: 32px 16px 28px;
      }

      .sa-notice-copy,
      .sa-bless {
        width: 100%;
      }

      .sa-hero {
        padding: 34px 16px 54px;
      }

      .sa-hero-title {
        font-size: 42px;
        letter-spacing: 2px;
      }

      .sa-churches {
        grid-template-columns: 1fr;
        gap: 34px;
      }

      .sa-church h2,
      .sa-church h3 {
        font-size: 28px;
      }

      .sa-church p {
        font-size: 22px;
      }

      .sa-intro {
        padding: 42px 16px 48px;
      }

      .sa-intro p {
        font-size: 24px;
      }

      .sa-contact-band {
        padding: 0;
        grid-template-columns: 1fr;
      }

      .sa-side-image {
        max-height: 420px;
      }

      .sa-contact-card {
        grid-template-rows: auto auto;
      }

      .sa-contact-content p,
      .sa-footer p {
        font-size: 22px;
      }
    }

    @media (max-width: 700px) {
      .sa-welcome {
        font-size: 24px;
      }

      .sa-notice-copy {
        font-size: 18px;
        line-height: 1.7;
      }

      .sa-bless {
        font-size: 22px;
      }

      .sa-hero-title {
        font-size: 28px;
      }

      .sa-church p {
        font-size: 20px;
      }

      .sa-intro p {
        font-size: 19px;
      }

      .sa-contact-content h2 {
        font-size: 28px;
      }

      .sa-contact-content p {
        font-size: 20px;
        margin: 20px 0;
      }

      .sa-footer p {
        font-size: 17px;
      }
    }
  </style>
</head>

<body <?php body_class('sa-body-template'); ?>>
  <?php wp_body_open(); ?>

  <div class="sa-page-template">
    <header class="sa-topbar">
      <nav class="sa-nav" aria-label="Main navigation">
        <a href="#">Home</a>
        <a href="#">About Us</a>
        <a href="#">Mass Times</a>
        <a href="#">Parish Life</a>
        <a href="#">Parish Calendar</a>
        <a href="#">Reflections</a>
        <a href="#">Gallery</a>
        <a href="#">Contact Us</a>
      </nav>
    </header>

    <section class="sa-notice">
      <p class="sa-welcome">Welcome back!</p>
      <p class="sa-notice-copy">
        St Augustine's Parish is delighted to be able to open our doors to the community again. We are now allowed to
        have up to 100 people in our churches, plus Ministers. New social distancing rules of 1 person per 2sq metres
        will apply. Seating at St Augustine's will be marked with pink tags at the required social distances on the
        pews, with chairs at the back to provide seats for a total of 100 people. Hand cleaning and registration will
        still be necessary. This may slow entry down a little so please come early.
      </p>
      <p class="sa-bless">God Bless</p>
    </section>

    <section class="sa-hero">
      <div class="sa-hero-image-frame">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/st-augustine/hero.jpg" alt="St Augustine's Catholic Parish" />
      </div>

      <h1 class="sa-hero-title">ST AUGUSTINE'S CATHOLIC PARISH</h1>

      <div class="sa-churches">
        <article class="sa-church">
          <h2>St Joseph's Church</h2>
          <h3>Boddington</h3>
          <p class="sa-strong">Every 1st and 3rd Sunday of the month, 8am Mass</p>
          <p>Children's Liturgy - 1st Sunday of the month</p>
        </article>

        <article class="sa-church">
          <h2>St Patrick's Church</h2>
          <h3>Dwellingup</h3>
          <p class="sa-strong">Vigil Mass: 3rd Saturday of the month 5pm</p>
        </article>

        <article class="sa-church">
          <h2>St Augustine's Church</h2>
          <h3>Pinjarra</h3>
          <p class="sa-strong">Sunday 10am Mass</p>
          <p>Wednesday 9.10am Rosary</p>
          <p>Wednesday 9.30am Mass</p>
          <p>Friday 9.30am Mass</p>
          <p>Children's Liturgy - Every Sunday of school term</p>
        </article>
      </div>
    </section>

    <section class="sa-intro">
      <p>
        Welcome to St Augustine's, a Catholic Parish around 100 kms south of Perth in Western Australia! We are three
        church communities, strong in our faith, who support each other through the Word, the Eucharist, and
        compassionate service. We minister to each other and the wider community, living in the present and looking to
        the future.
      </p>
    </section>

    <section class="sa-contact-band">
      <div class="sa-side-image">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/st-augustine/cross.jpg" alt="Church cross" />
      </div>

      <div class="sa-contact-card">
        <div class="sa-contact-top">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/st-augustine/interior.jpg" alt="Church interior" />
        </div>
        <div class="sa-contact-content">
          <h2>Contact Us</h2>
          <p>40 George St, Pinjarra WA 6208</p>
          <p>P.O Box 35, Pinjarra WA 6208</p>
          <p>staugpin@westnet.com.au</p>
          <p>(08) 9531 1227</p>
        </div>
      </div>

      <div class="sa-side-image">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/st-augustine/alter-service.jpg" alt="Altar servers" />
      </div>
    </section>

    <footer class="sa-footer">
      <p>Web page guidance - G.M. Raymond; Web content editor - C. Pettit Copyright 2017 St Augustine's Catholic Parish.
      </p>
      <p class="sa-nh">by NH Solutions</p>
    </footer>
  </div>

  <script>
    document.querySelectorAll("a, button").forEach(function (element) {
      element.addEventListener("click", function (event) {
        event.preventDefault();
        event.stopPropagation();
        return false;
      });
    });
  </script>

  <?php wp_footer(); ?>
</body>

</html>