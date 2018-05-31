<!DOCTYPE html>
<html lang="zxx">
    
<head>
    <?php $this->load->view('st_head'); ?>    
</head>
    <body>
   
        <?php echo $this->session->flashdata('success'); ?>
        <div class="animsition">

            <!--=============== Navbar and Search popup ===============-->
            <?php $this->load->view('navbar'); ?>
            <!--=============== / .Navbar and Search popup===============-->

            <!--=============== Hero Section ===============-->
            <section class="hero hero-page bg-gray has-pattern">
                <div class="container text-center">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumb d-flex justify-content-center">
                        <li class="breadcrumb-item"><a href="index-2.html" class="animsition-link">Home</a></li>
                        <li class="breadcrumb-item active">About US</li>
                    </ul>
                    <h1>About Us</h1>
                    <p class="hero-text col-lg-8 push-lg-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </section>
            <!--=============== /. Hero Section ===============-->


            <!--=============== Intro Section ===============-->
            <section class="intro">
                <div class="container text-center">
                    <p class="text-big col-md-10 push-md-1">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum</p>
                    <a class="bla-1 btn-template" href="https://www.youtube.com/watch?v=q16Bdzv6EWM">About our Service <i class="fa fa-play"></i></a>
                </div>
            </section>
            <!--=============== /. Intro Section ===============-->


            <!--=============== Vision Section ===============-->
            <section class="vision bg-gray">
                <div class="container text-center">
                    <header>
                        <h2 class="with-bg-text-gray" data-text="Vision">
                            <small class="text-primary">Our Vision</small>
                            Our Vision
                        </h2>
                    </header>
                    <!-- Blockquote -->
                    <blockquote class="blockquote col-md-10 push-md-1">
                        <p>Nenetur numquam a, nesciunt neque odit amet, qui quibusdam natus assumenda quas omnis, aspernatur quisquam nobis illum ea distinctio tempora quaerat. Aperiam cumque, eveniet similique praesentium, temporibus.</p>
                        <footer class="blockquote-footer d-flex align-items-start justify-content-center">
                            <div class="title">
                                <h3>Sundar Pichai</h3>
                                <span class="text-primary">CEO Google Inc.</span>
                            </div>
                        </footer>
                    </blockquote><!-- /. Blockquote -->
                </div>
            </section>
            <!--=============== /. Vision Section ===============-->


            <!--=============== Statistics Section ===============-->
            <section class="statistics statistics-about has-pattern padding-small">
                <div class="container text-center">

                    <div class="row">
                        <!-- Item -->
                        <div class="col-md-3 col-sm-6">
                            <div class="icon">
                                <img src="<?php echo base_url(); ?>img/group-default.svg" alt="..." class="img-fluid">
                            </div>
                            <h3 class="h2 text-primary"><strong class="counter">2000</strong></h3>
                            <p>Daily Visitors</p>
                        </div><!-- /. Item -->

                        <!-- Item -->
                        <div class="col-md-3 col-sm-6">
                            <div class="icon">
                                <img src="<?php echo base_url(); ?>img/planet-earth-default.svg" alt="..." class="img-fluid">
                            </div>
                            <h3 class="h2 text-primary"><strong class="counter">15</strong></h3>
                            <p>Worldwide Branches</p>
                        </div><!-- /. Item -->

                        <!-- Item -->
                        <div class="col-md-3 col-sm-6">
                            <div class="icon">
                                <img src="<?php echo base_url(); ?>img/cutlery-1-default.svg" alt="..." class="img-fluid">
                            </div>
                            <h3 class="h2 text-primary"><strong class="counter">230</strong></h3>
                            <p>Various Dishes</p>
                        </div><!-- /. Item -->

                        <!-- Item -->
                        <div class="col-md-3 col-sm-6">
                            <div class="icon">
                                <img src="<?php echo base_url(); ?>img/time-left-default.svg" alt="..." class="img-fluid">
                            </div>
                            <h3 class="h2 text-primary"><strong class="counter">100</strong>%</h3>
                            <p>Intime Delievery</p>
                        </div><!-- /. Item -->
                    </div>

                </div>
            </section>
            <!--=============== /. Statistics Section ===============-->


            <!--=============== Chefs Section ===============-->
            <section class="chefs bg-gray">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Chefs">
                            <small class="text-primary">Our masters of cooking</small>
                            Our Chefs
                        </h2>
                    </header>
                    <div class="owl-carousel owl-theme chefs-slider text-center">
                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="<?php echo base_url(); ?>img/chef-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Samuel Carrick</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="<?php echo base_url(); ?>img/chef-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Richard Nevoresky</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="<?php echo base_url(); ?>image d-flex align-items-end">
                                <img src="img/chef-3.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Emmanuella Wood</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="<?php echo base_url(); ?>img/chef-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Samuel Carrick</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="<?php echo base_url(); ?>img/chef-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Richard Nevoresky</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="<?php echo base_url(); ?>img/chef-3.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <div class="details has-pattern-on-hover">
                                <h3>Emmanuella Wood</h3>
                                <span>Senior Chief Supervisor</span>
                                <ul class="social-icons list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--=============== /. Chefs Section ===============-->


            <!--=============== Gallery Section ===============-->
            <section class="gallery">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Gallery">
                            <small class="text-primary">Our Gallery</small>
                            Our Gallery
                        </h2>
                    </header>
                </div>

                <div class="owl-carousel gallery-slider">
                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-1.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-1.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-2.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-2.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-3.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-3.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-4.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-4.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-5.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-5.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-6.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-6.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-1.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-1.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-2.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-2.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-3.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-3.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-4.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-4.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-5.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-5.jpg" alt="...">
                        </a>
                    </div>

                    <!-- item -->
                    <div class="item">
                        <a  href="<?php echo base_url(); ?>img/gallery-6.jpg" class="image" data-fancybox="gallery">
                            <img src="<?php echo base_url(); ?>img/gallery-6.jpg" alt="...">
                        </a>
                    </div>
                </div>
            </section>
            <!--=============== /. Gallery Section ===============-->

            <!--=============== footer ===============-->
            <?php $this->load->view('st_footer'); ?>
            <!--=============== /.footer ===============-->
        </div>

        <!--=============== Preloader ===============-->
        <div class="preloader">
            <div class="spinner">
                <div class="circle-big"></div>
                <div class="circle-small"></div>
                <img src="img/cutlery-default.svg" alt="...">
            </div>
        </div>
        <!--=============== /. Preloader ===============-->


        <!--==============Script ================================-->
            <?php $this->load->view('st_script')?>
        <!--======================================================-->

    </body>

</html>
