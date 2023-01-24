<!DOCTYPE html>
<html lang="en">

<head>
<?php echo $this->Html->charset();?>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <?= $this->Html->css([
        'vendor/aos/aos',
        'vendor/bootstrap/css/bootstrap.min',
        'vendor/bootstrap-icons/bootstrap-icons',
        'vendor/boxicons/css/boxicons.min',
        'vendor/glightbox/css/glightbox.min',
        'vendor/remixicon/remixicon',
        'vendor/swiper/swiper-bundle.min',
        // 'normalize.min',
        // 'milligram.min',
        // 'cake',
        'style'
          
        ]) ?>

</head>

<body>

<?php echo $this->element('header');?>

  <!-- ======= Hero Section ======= -->
  <?php echo $this->element('hero');?>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <?php echo $this->element('client');?>
    <!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <?php echo $this->element('about');?>

  <!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    <?php echo $this->element('skill');?>

    <!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <?php echo $this->element('service');?>

   <!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    <!-- ======= Portfolio Section ======= -->
    <?php echo $this->element('portfolio');?>

    <!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <?php echo $this->element('team');?>

    <!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->
    <?php echo $this->element('pricing');?>

    <!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->.
    <?php echo $this->element('frequently');?>

   <!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <?php echo $this->element('contact');?>

    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php echo $this->element('footor');?>



  <!-- Vendor JS Files -->




  <!-- Vendor JS Files -->
  <?= $this->Html->script([
        'vendor/aos/aos',
        'vendor/bootstrap/js/bootstrap.bundle.min',
        'vendor/glightbox/js/glightbox.min',
        'vendor/isotope-layout/isotope.pkgd.min',
        'vendor/swiper/swiper-bundle.min',
        'vendor/waypoints/noframework.waypoints',
        'vendor/php-email-form/validate',
        'main',


    ]);?>


  <!-- Template Main JS File -->
  <?php echo $this->Html->script('main.js')?>

</body>

</html>