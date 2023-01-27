<section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Better Solutions For Your Business</h1>
          <h2>We are team of talented designers making websites with Bootstrap</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            
            <?php
            $session = $this->request->getSession();
            if ($session->read('name') != NULL) {?>
                <a href="/users/logout" class="scrollto btn-get-started ">Logout</a><?php
            } else{?>
              <a href="/users/add" class="btn-get-started scrollto">Registration </a>
              <a href="/users/login" class="scrollto btn-get-started"></i><span>Login Your Account</span></a><?php
            }

            ?>
          
          </div>

        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <?php echo $this->Html->image("hero-img.png")?>

        </div>
      </div>
    </div>

  </section>
  