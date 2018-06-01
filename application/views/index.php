<!DOCTYPE html>
<html lang="zxx">
<head>
        <?php $this->load->view('st_head'); ?>
    <style type="text/css">
        #suggesstion-box-main{

            max-height: 150px;
            overflow: auto;
            border: 1px solid aliceblue;
        }

        #suggesstion-box
        {
            list-style: none;
        }

        #suggesstion-box li
        {
            float: left;
            margin-left: -15px;
        }

        select {
  /* for Firefox */
  -moz-appearance: none;
  /* for Chrome */
  -webkit-appearance: none;
}

/* For IE10 */
select::-ms-expand {
  display: none;
}

select.form-control:not([size]):not([multiple]) {
    height: 60px;
    width: 200px;
    /*border-radius: 15px;*/
}
    </style>
    </head>
    <body>


        <div class="animsition">

            <!--=============== Navbar and Search popup ===============-->
            <?php $this->load->view('navbar'); ?>
            <!--=============== / .Navbar and Search popup===============-->

            <!--=============== Hero Section ===============-->
            <section class="hero hero-home has-pattern has-background-text-gray" data-text="Spicy Restaurant">
                <div class="container d-flex align-items-center">
                    <div class="row d-flex align-items-center">

                        <!-- text column -->
                        <div class="text col-lg-6">
                            <strong class="text-primary text-uppercase">Food Services</strong>
                            <h1>Welcome to your spicy restaurant</h1>
                            <span class="text-muted text-transform address">32 Radwan El-Tayeb, Giza Governorate, Egypt</span>
                            <p class="hero-text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>

                            <div class="CTAs d-flex flex-wrap">
                                <a href="about-us.html" class="btn btn-template animsition-link">Discover More</a>
                                <a href="reservation.html" class="btn btn-template-outlined animsition-link">Make Reservation</a>
                            </div>
                        </div>

                        <!-- image column -->
                        <div class="image col-lg-6">
                            <img src="img/dish.png" alt="dish" class="img-fluid hidden-lg-down">
                        </div>
                    </div>
                </div>
            </section>
            <!--=============== /. Hero Section ===============-->


            <!--=============== Divider Section ===============-->
            <section class="divider padding-small has-pattern bg-primary" style="margin-top:-75px;padding: 7px 0 !important">
                <div class="container text-center" >

                   <div id="suggesstion-box-main" style="z-index: -1">
                        <ul id="suggesstion-box"></ul>
                    </div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <select class="form-control" id="city_id">
                            <?php
                            foreach($cities as $city):
                                echo '<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
                            endforeach;
                            ?>
                        </select>
                      </div>
                      <input id="work_address" onkeyup="initService(this.value,'work')" name="work_address" type="text" style="height: 60px;" class="form-control" placeholder="Enter Address of the building you work in">
                    </div>
                </div>
            </section>
            <!--=============== /. Divider Section ===============-->

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
            <!--=============== About Section ===============-->
            <section class="about">
                <div class="container text-center">
                    <h2 class="with-bg-text" data-text="About Us">
                        <small class="text-primary">Our Story</small>
                        About Spicy Restaurant
                    </h2>

                    <p class="lead col-lg-10 push-lg-1">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                    <a href="about-us.html" class="btn-template animsition-link">Discover More</a>
                </div>
            </section>
            <!--=============== /. About Section ===============-->


            <!--=============== Features Section ===============-->
            <section class="features no-padding-top">
                <div class="container">
                    <div class="row text-center">

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/coffee-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Awesome Drinks</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/table-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Clean Environment</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/invoice-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Wide Dishes Menu</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/no-smoking-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Fresh Atmosphere</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/wallet-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Reasonably Priced</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                        <!-- feature -->
                        <div class="col-lg-4 col-md-6">
                            <div class="item has-pattern-on-hover has-shadow-on-hover rounded">
                                <div class="icon">
                                    <img src="img/cutlery-default.svg" alt="...">
                                </div>
                                <h3 class="heading-light">Classy Service</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--=============== /. Features Section ===============-->


            <!--=============== Dishes Section ===============-->
            <section class="dishes no-padding-top">
                <div class="container">

                    <header class="text-center">
                        <h2 class="with-bg-text" data-text="Features">
                            <small class="text-primary">Hot this month</small>
                            Our Featured Dishes
                        </h2>
                    </header>

                    <!-- dishes slider -->
                    <div class="owl-carousel owl-theme dishes-slider">

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded sale">
                            <div class="ribbon">Sale</div>
                            <div class="image">
                                <img src="img/dish-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$18.00</li>
                                <li class="list-inline-item original">$35.99</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-3.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded sale">
                            <div class="ribbon">Sale</div>
                            <div class="image">
                                <img src="img/dish-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$18.00</li>
                                <li class="list-inline-item original">$35.99</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-3.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded sale">
                            <div class="ribbon">Sale</div>
                            <div class="image">
                                <img src="img/dish-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$18.00</li>
                                <li class="list-inline-item original">$35.99</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-3.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded sale">
                            <div class="ribbon">Sale</div>
                            <div class="image">
                                <img src="img/dish-1.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$18.00</li>
                                <li class="list-inline-item original">$35.99</li>
                            </ul>
                        </div>

                        <!-- item -->
                        <div class="item text-center has-shadow rounded">
                            <div class="image">
                                <img src="img/dish-2.png" alt="..." class="img-fluid d-block mx-auto">
                            </div>
                            <h3 class="heading-light">Awesome Dish Name</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <ul class="price list-inline">
                                <li class="list-inline-item current">$24.00</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
            <!--=============== /. Dishes Section ===============-->


            <!--=============== /. Menu Section ===============-->
            <section class="menu bg-gray">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Menu">
                            <small class="text-primary">Full dishes list</small>
                            Our Food Menu
                        </h2>
                    </header>

                    <!-- tabs navigation -->
                    <ul class="nav nav-tabs has-pattern d-flex justify-content-center flex-lg-no-wrap flex-wrap" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#breakfast" role="tab">Breakfast</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#lunch" role="tab">Lunch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#dinner" role="tab">Dinner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#party" role="tab">Party</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#drinks" role="tab">Drinks</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Breakfast -->
                        <div class="tab-pane active" id="breakfast" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">LambBeef Kofka Skewers with Tzatziki</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Lemon and Garlic Green Beans</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lunch -->
                        <div class="tab-pane" id="lunch" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">LambBeef Kofka Skewers with Tzatziki</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Lemon and Garlic Green Beans</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dinner -->
                        <div class="tab-pane" id="dinner" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">LambBeef Kofka Skewers with Tzatziki</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Lemon and Garlic Green Beans</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Party -->
                        <div class="tab-pane" id="party" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">LambBeef Kofka Skewers with Tzatziki</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Lemon and Garlic Green Beans</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Drinks -->
                        <div class="tab-pane" id="drinks" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">LambBeef Kofka Skewers with Tzatziki</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Lemon and Garlic Green Beans</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Wild Mushroom Bucatini with Kale</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Meatloaf with Black Pepper-Honey BBQ</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                    <div class="dish has-pattern-on-hover has-shadow-small-on-hover d-flex align-items-center justify-content-between">
                                        <div class="name">Imported Oysters Grill (5 Pieces)</div>
                                        <div class="price">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!--=============== Menu Section ===============-->


            <!--=============== Divider Section ===============-->
            <section class="divider has-pattern bg-primary padding-small">
                <div class="container text-center">
                    <p>Our App is available, download it now</p>
                    <div class="CTAs d-flex flex-wrap justify-content-center">
                        <a href="#" class="google-play">Google Play</a>
                        <a href="#" class="appstore">App Store</a>
                    </div>
                </div>
            </section>
            <!--=============== /. Divider Section ===============-->


            <!--=============== /. Events Section ===============-->
            <section class="events">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Events">
                            <small class="text-primary">Don't miss it</small>
                            Upcoming Events
                        </h2>
                    </header>

                    <!-- events slider -->
                    <div class="owl-carousel owl-theme events-slider">

                        <!-- item -->
                        <div class="item">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-lg-5">
                                    <div class="image has-shadow rounded" style="background: url(img/event-bg.png);"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="details has-shadow rounded d-flex align-items-center has-pattern">
                                        <div class="content">
                                            <h3 class="heading-light">Italian Food Master Class </h3>
                                            <small class="date text-uppercase text-primary">15 DECEMBER 2017 | 20:00</small>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            <a href="#" class="btn btn-sm btn-template view-details">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-lg-5">
                                    <div class="image has-shadow rounded" style="background: url(img/event-bg.png);"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="details has-shadow rounded d-flex align-items-center has-pattern">
                                        <div class="content">
                                            <h3 class="heading-light">Italian Food Master Class </h3>
                                            <small class="date text-uppercase text-primary">15 DECEMBER 2017 | 20:00</small>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            <a href="#" class="btn btn-sm btn-template view-details">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-lg-5">
                                    <div class="image has-shadow rounded" style="background: url(img/event-bg.png);"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="details has-shadow rounded d-flex align-items-center has-pattern">
                                        <div class="content">
                                            <h3 class="heading-light">Italian Food Master Class </h3>
                                            <small class="date text-uppercase text-primary">15 DECEMBER 2017 | 20:00</small>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            <a href="#" class="btn btn-sm btn-template view-details">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- item -->
                        <div class="item">
                            <div class="row d-flex align-items-stretch">
                                <div class="col-lg-5">
                                    <div class="image has-shadow rounded" style="background: url(img/event-bg.png);"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="details has-shadow rounded d-flex align-items-center has-pattern">
                                        <div class="content">
                                            <h3 class="heading-light">Italian Food Master Class </h3>
                                            <small class="date text-uppercase text-primary">15 DECEMBER 2017 | 20:00</small>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            <a href="#" class="btn btn-sm btn-template view-details">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--=============== Events Section ===============-->


            <!--=============== Chefs Section ===============-->
            <section class="chefs bg-gray">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Chefs">
                            <small class="text-primary">Our masters of cooking</small>
                            Our Chefs
                        </h2>
                    </header>

                    <!-- chefs slider -->
                    <div class="owl-carousel owl-theme chefs-slider text-center">
                        <!-- item -->
                        <div class="item rounded has-pattern-on-hover has-shadow-on-hover">
                            <div class="image d-flex align-items-end">
                                <img src="img/chef-1.png" alt="..." class="img-fluid d-block mx-auto">
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
                                <img src="img/chef-2.png" alt="..." class="img-fluid d-block mx-auto">
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
                                <img src="img/chef-1.png" alt="..." class="img-fluid d-block mx-auto">
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
                                <img src="img/chef-2.png" alt="..." class="img-fluid d-block mx-auto">
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
                    </div>
                </div>
            </section>
            <!--=============== /. Chefs Section ===============-->


            <!--=============== Reservation Section ===============-->
            <section class="reservation">
                <div class="container">
                    <header class="text-center">
                        <h2 class="with-bg-text" data-text="Reservation">
                            <small class="text-primary">Reserve a seat</small>
                            Order Your Table
                        </h2>
                    </header>

                    <div class="form-holder row">
                        <form action='#' id='reservation-form' class='col-lg-10 push-lg-1 rounded has-shadow has-pattern' method='post'><input type='hidden' name='form-name' value='reservation-form' />
                            <div class="star"><i class="fa fa-star"></i></div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="input-material" id="name">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="input-material" id="email">
                                    <label for="email">Email Address</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" name="phone" class="input-material" id="phone">
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="people-number" class="input-material" id="people-number">
                                    <label for="people-number">How Many People</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="input-material timepicker" id="time-alt" required>
                                    <label for="time-alt">Desired Time</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="input-material datepicker-here" id="date" name="date" data-language='en' required>
                                    <label for="date">Desired Date</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="input-material" id="special-request" name="special-request"></textarea>
                                    <label for="special-request">Special Request</label>
                                </div>
                                <div class="form-group col-md-12 text-center no-margin">
                                    <button type="submit" class="btn-template btn-sm">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!--=============== /. Reservation Section ===============-->


            <!--=============== Testimonials Section ===============-->
            <section class="testimonials bg-gray">
                <div class="container text-center">
                    <header class="text-center">
                        <h2 class="with-bg-text-gray" data-text="Testimonials">
                            <small class="text-primary">Our Clients' Feedbacks</small>
                            What Our Clients Say
                        </h2>
                    </header>

                    <!-- Testimonials Slider -->
                    <div class="owl-carousel owl-theme testimonials-slider text-center">
                        <!-- item -->
                        <div class="item col-lg-10 push-lg-1 rounded has-pattern has-shadow">
                            <div class="quote"><img src="img/quote-default.svg" alt="..."></div>
                            <div class="user">
                                <div class="profile">
                                    <img class="rounded-circle" src="img/avatar-1.png" alt="...">
                                </div>
                                <ul class="rate list-inline">
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>James Turner</h4>
                            </div>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <!-- item -->
                        <div class="item col-lg-10 push-lg-1 rounded has-pattern has-shadow">
                            <div class="quote"><img src="img/quote-default.svg" alt="..."></div>
                            <div class="user">
                                <div class="profile">
                                    <img class="rounded-circle" src="img/avatar-2.jpg" alt="...">
                                </div>
                                <ul class="rate list-inline">
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Hector Nacho</h4>
                            </div>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <!-- item -->
                        <div class="item col-lg-10 push-lg-1 rounded has-pattern has-shadow">
                            <div class="quote"><img src="img/quote-default.svg" alt="..."></div>
                            <div class="user">
                                <div class="profile">
                                    <img class="rounded-circle" src="img/avatar-3.jpg" alt="...">
                                </div>
                                <ul class="rate list-inline">
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Ashley Williams</h4>
                            </div>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <!-- item -->
                        <div class="item col-lg-10 push-lg-1 rounded has-pattern has-shadow">
                            <div class="quote"><img src="img/quote-default.svg" alt="..."></div>
                            <div class="user">
                                <div class="profile">
                                    <img class="rounded-circle" src="img/avatar-4.jpg" alt="...">
                                </div>
                                <ul class="rate list-inline">
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Frank Wood</h4>
                            </div>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>

                        <!-- item -->
                        <div class="item col-lg-10 push-lg-1 rounded has-pattern has-shadow">
                            <div class="quote"><img src="img/quote-default.svg" alt="..."></div>
                            <div class="user">
                                <div class="profile">
                                    <img class="rounded-circle" src="img/avatar-5.jpg" alt="...">
                                </div>
                                <ul class="rate list-inline">
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                    <li class="list-inline-item active"><i class="fa fa-star"></i></li>
                                </ul>
                                <h4>Nadia Stark</h4>
                            </div>
                            <p class="lead">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!--=============== /. Testimonials Section ===============-->


            <!--=============== Newsletter Section ===============-->
            <section class="newsletter">
                <div class="container">
                    <header class="text-center">
                        <h2>Newsletter</h2>
                        <p class="lead col-lg-10 push-lg-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    </header>

                    <div class="form-holder row">
                        <form action='#' id='newsletter-form' class='col-lg-10 push-lg-1' method='post'><input type='hidden' name='form-name' value='newsletter-form' />
                            <div class="form-group no-margin">
                                <input type="email" class="form-control" placeholder="Enter your email address">
                                <button type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!--=============== /. Newsletter Section ===============-->


            <!--=============== Footer ===============-->
                <?php $this->load->view('st_footer'); ?>
            <!--=============== /. Footer ===============-->


            <!--=============== Scroll to Top Button ===============-->
            <div id="scrollTop">
                <i class="fa fa-long-arrow-up"></i> To Top
            </div>
            <!--=============== /. Scroll to Top Button ===============-->
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

        <!--=============== Footer ===============-->
            <?php $this->load->view('st_script'); ?>
        <!--=============== /. Footer ===============-->

        <script type="text/javascript">

            function initService(search_key) {

                if(search_key=="")
                {

                    $('#suggesstion-box').html('');
                    $('#suggesstion-box-main').hide('');
                    return false;
                }

                var city_id = $('#city_id').val();
                $.ajax({
                    url: "<?php echo base_url() ?>home/getAddress",
                    type: "POST",
                    data :{'city_id':city_id,'search_key':search_key},
                    contentType: "application/x-www-form-urlencoded",                     
                    success: function(response) 
                    {
                         resp = JSON.parse(response);
                         if(resp.length != 0)
                         {
                            $('#suggesstion-box-main').show();
                            $.each( resp, function(key,value) {
                              html = '<li onclick="setValue(\''+value['add_details']+'\')">'+value['add_details']+'</li>';
                              $('#suggesstion-box').append(html);
                             });
                         }else
                         {
                             $('#suggesstion-box-main').hide();
                         }
                    },
                    error: function (request, status, error) 
                    {},
                    complete: function()
                    {}
                });
            }

            $('#suggesstion-box-main').hide();
            $(document).on("click", function (e) {
        
                $('#suggesstion-box-main').hide();
            });

             function setValue(val)
            {
                console.log(val);
                $('#work_address').val(val);
                $('#suggesstion-box').hide();
            }

        </script>


    </body>


</html>
