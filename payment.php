<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- TODO: Change routes to correct location when in production -->
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="publisher" content="James Hoover"/>
  <!-- LINK stylesheets -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/small-business.css" rel="stylesheet">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="/stylesheets/abc-reset.css">
  <link rel="stylesheet" type="text/css" href="/stylesheets/style.css">
  <link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <title>206Tutoring - Payment</title>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48216177-1', 'auto');
  ga('send', 'pageview');

  </script>
  <style>
    .donate-process,
    .donate-thanks,
    .donate-alert {
      font-size: 1.2em;
      -webkit-transition: all .3s ease-out;
      -moz-transition: all .3s ease-out;
      -o-transition: all .3s ease-out;
      transition: all .3s ease-out;
      visibility: hidden;
      opacity: 0;
      height: 0;
      display: block;
    }
    .donate-process.show,
    .donate-thanks.show,
    .donate-alert.show {
      opacity: 1;
      height: auto;
      visibility: visible;
      padding: 1em;
    }
    .donate-alert.show {
      background: #f6cfcf;
    }
    .donate-thanks.show {
      background: #39d1b4;
      color: #fff;
    }
  </style>

</head>
<!-- START BODY -->
<body>
  <!-- START HEADER -->
<header class="home-header">
  <div class="full-row gradient">
    <section class="top-nav row">
      <div>
        <a href="/home.php" class="nav-logo pull first">
          <img src="/assets/home_page/spaceneedlelogo.png" alt="SpaceNeedle" class="spaceneedle-logo">
        </a>
      </div>
      <div class="nav-badge nav-btn one-fifth push">
        <a href="/about.php#contact-form" class="btn-orange btn-contact">CONTACT US</a>
        <div class="phone-numb">
          <p>(206) 551-7843</p>
        </div>
      </div>
      <!-- START NAV -->
      <nav>
        <ul class="nav-link-list">
          <li><a href="/test_prep.php" class="nav-link">TEST & COLLEGE PREP</a></li>
          <li><a href="/tutoring.html" class="nav-link">TUTORING</a></li>
          <li><a href="/music.html" class="nav-link">MUSIC LESSONS</a></li>
          <li><a href="/about.php" class="nav-link">ABOUT</a></li>
          <li><a href="/payment.php" class="nav-link">PAYMENT</a></li>
        </ul>
        <section>
          <div class="pull">
            <a href="http://www.seattletimes.com/education-lab/guest-essay-how-many-good-high-schools-can-be-so-bad/" class="nav-link">
              <img src="/assets/home_page/seattletimes.png" alt="SeattleTimes" class="seattletimes-logo">
              <br>Guest essay: <br>How ‘good’ high schools can be so bad<br>
            </a>
          </div>
          <div class="push">
            <a href="https://www.thumbtack.com/wa/seattle/test-prep/tutoring-piano-lessons" class="nav-link">
              <img src="/assets/about/ThumbtackBadge.png" alt="Thumbtack" class="thumbtack-logo">
              <br>5 stars on Thumbtack — <br>Best of 2015<br>
            </a>
          </div>
        </section>
      </nav>
    </section>
    <div>
      <span>
        <main class="header-text row">
          <div>
            <h1>PAYMENT</h1>
          </div>
        </main>
      </span>
    </div>
  </div>
</header>

<body>
  <div class="col-md-3">
    <br>
  </div>
  <div class="col-md-6">

    <div id="main" role="main">

      <section class="payment-button">

        <span class="donate-alert" aria-expanded="false"></span>
        <span class="donate-process" aria-expanded="false">processing your donation...</span>
        <span class="donate-thanks" aria-expanded="false"></span>
          <br>
          <br>
          <h2><b>Pay for lessons in advance with our secure payment portal using <a href="https://stripe.com">Stripe</a>—convenient and secure.</b></h2>
          <br>
          <br>
        $ <input type="text" id="amt" value="">
        <button id="donateNow" type="submit">Pay</button>
      </section>

    </div>

  </div>
  <div class="col-md-3">
    <br>
  </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
$(document).ready(function(){
  // scroll to top for processing
  function scrollTo() {
    var hash = '#main';
    var destination = $(hash).offset().top;
    stopAnimatedScroll();
    $('html, body').stop().animate({
      scrollTop: destination
    }, 400, function() { window.location.hash = hash; });
    return false;
  }
  function stopAnimatedScroll(){
    if ( $('*:animated').length > 0 ) {$('*:animated').stop();}
  }
  if(window.addEventListener) {
    document.addEventListener('DOMMouseScroll', stopAnimatedScroll, false);
  }
  document.onmousewheel = stopAnimatedScroll;

  // prevent decimal in donation input
  $('#amt').keypress(function(){
    preventDot(event)
  });

  function preventDot(event){
    var key = event.charCode ? event.charCode : event.keyCode;  
    if (key == 46){
      event.preventDefault();
      return false;
    }
  }

  function showProcessing() {
    scrollTo();
    $('.donate-process').addClass('show').attr('aria-expanded', 'true');
    $('.donate-thanks, .donate-alert').removeClass('show').attr('aria-expanded', 'false');
  }

  function hideProcessing() {
    $('.donate-process').removeClass('show').attr('aria-expanded', 'false');
  }

  // set up Stripe config, ajax post to charge
  var handler = StripeCheckout.configure({
    key: '<?php echo $stripe['publishable_key'] ?>',
    image: '/assets/home_page/spaceneedlelogo.jpg',
    closed: function(){document.getElementById('donateNow').removeAttribute('disabled');},
    token: function(token) {
      $.ajax({
        url: '/charge.php',
        type: 'POST',
        dataType: 'json',
        beforeSend: showProcessing,
        data: {
          stripeToken: token.id,
          stripeEmail: token.email,
          donationAmt: donationAmt
        },
        success: function(data) {
          hideProcessing();
          $('#amt').val('');
          if (data.error!='') {
            $('.donate-alert').addClass('show').text(data.error).attr('aria-expanded', 'true');
          } else {
            $('.donate-thanks').addClass('show').text(data.success).attr('aria-expanded', 'true');
          }
        },
        error: function(data) {
          $('.donate-alert').show().text(data).attr('aria-expanded', 'true');
        }
      });
    }
  });

  // donate now button, open Checkout
  $('#donateNow').click(function(e) {
    // strip non-numbers from amount and convert to cents
    donationAmt = document.getElementById('amt').value.replace(/\D/g,'') + '00';
    // make sure there is an amount
    if (donationAmt < 1) {
      $('#amt').val('').focus();
      e.preventDefault();
    } else {
      $('#donateNow').attr('disabled', 'disabled');
      // Open Checkout
      handler.open({
        name: '206 Tutoring',
        description: 'Payment',
        amount: donationAmt,
        billingAddress: true
      });
      e.preventDefault();
    }
  });

  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
  });
});
</script>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.slick-slider').slick({
          infinite: true,
          speed: 1000,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 7000,
          pauseOnHover: false
      });
    }); 
  </script> 
  <script type="text/javascript">
    $(function() {
      // Insert Responsive Sidebar Icon
      $('<div class="responsive-nav-icon" />').appendTo('.top-nav.row');
      $('<div class="responsive-nav-close" />').appendTo('nav');

      // Navigation Slide In
      $('.responsive-nav-icon').click(function() {
        $('nav').addClass('slide-in');
        $('html').css("overflow", "hidden");
        $('#overlay').show();
        return false;
      });

      // Navigation Slide Out
      $('#overlay, .responsive-nav-close').click(function() {
        $('nav').removeClass('slide-in');
        $('html').css("overflow", "auto");
        $('#overlay').hide();
        return false;
      });
    });
  </script>
</body><!-- END BODY -->
