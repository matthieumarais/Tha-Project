
</footer>
</body>

<?php if(isset($_GET['page']) && $_GET['page'] == "goodbye"){ ?>
    <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2378889059041421');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2378889059041421&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<?php } ?>

<script src="/assets/js/jquery-3.2.1.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/formValidator.min.js"></script>
<script src="/assets/js/lightgallery.min.js"></script>
<script src="/assets/js/lg-video.js"></script>
<script src="/assets/js/script.js"></script>
</html>