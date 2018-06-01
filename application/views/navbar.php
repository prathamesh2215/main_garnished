            <!--=============== Navbar ===============-->
            <nav class="navbar fixed-top navbar-toggleable-md">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Navbar Brand -->
                        <a href="<?php echo base_url(); ?>" class="navbar-brand">
                            <img src="<?php echo base_url(); ?>img/logo-main-default.png" alt="spicy" class="img-fluid">
                        </a>

                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarcollapse">
                        <!-- Navbar Menu -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>" class="nav-link animsition-link <?php if($page=='home') echo 'active'; ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('about'); ?>" class="nav-link animsition-link <?php if($page=='about') echo 'active'; ?>">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="dishes.html" class="nav-link animsition-link">Dishes</a>
                            </li>
                            <!-- mega menu -->
                            <!-- <li class="nav-item dropdown menu-large">
                                <a href="#" data-toggle="dropdown" class="nav-link">Pages <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu megamenu">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-6"><strong class="text-uppercase">Main Pages</strong>
                                                    <ul class="list-unstyled">
                                                        <li><a href="index-2.html" class="animsition-link">Home</a></li>
                                                        <li><a href="about-us.html" class="animsition-link">About Us</a></li>
                                                        <li><a href="dishes.html" class="animsition-link">Dishes</a></li>
                                                        <li><a href="contact.html" class="animsition-link">Contact Us</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6"><strong class="text-uppercase">Second Pages</strong>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6"><strong class="text-uppercase">Third Pages</strong>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6"><strong class="text-uppercase">Fourth Pages</strong>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                        <li><a href="#" class="animsition-link">Sample Page</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="dish col-lg-6">
                                                    <strong class="text-uppercase">New Dishes</strong>
                                                    <div class="image">
                                                        <img src="img/dish-1.png" alt="..." class="img-fluid">
                                                    </div>
                                                    <h5>Awosome dish name</h5>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    <a href="reservation.html" class="btn-template btn-sm has-shadow animsition-link">Make a reservation</a>
                                                </div>
                                                <div class="dish col-lg-6">
                                                    <strong class="text-uppercase">Featured Dishes</strong>
                                                    <div class="image">
                                                        <img src="img/dish-2.png" alt="..." class="img-fluid">
                                                    </div>
                                                    <h5>Awosome dish name</h5>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                                                    <a href="reservation.html" class="btn-template btn-sm has-shadow animsition-link">Make a reservation</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            <li class="nav-item">
                                <a href="<?php echo site_url('sign-up'); ?>" class="nav-link animsition-link <?php if($page=='sign-up') echo 'active'; ?>">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a href="contact.html" class="nav-link animsition-link <?php if($page=='sign-in') echo 'active'; ?>">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="search-btn nav-link">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--=============== /. Navbar ===============-->

            <!--===============  Search popup ===============-->
            <div class="search-popup has-pattern">
                <div class="search-popup-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn"> CLOSE
                        <i class="fa fa-close"></i>
                    </div>
                    <form action='#' id='search-form' method='post'><input type='hidden' name='form-name' value='search-form' />
                        <h2 class="text-center">Search Our Website</h2>
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="What are you searching for...">
                            <button type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--=============== /. Search popup ===============-->