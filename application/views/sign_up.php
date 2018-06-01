<!DOCTYPE html>
<html lang="zxx">
    
<head>
    <!-- CSS Files -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="<?php echo base_url(); ?>assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />
    <?php $this->load->view('st_head'); ?>    
    <link href="<?php echo base_url(); ?>assets/css/themify-icons.css" rel="stylesheet">

    <style type="text/css">
        .progress-bar {
            float: left;
            width: 0%;
            height: 100%;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
            text-align: center;
            background-color: #337ab7;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
            -webkit-transition: width .6s ease;
            -o-transition: width .6s ease;
            transition: width .6s ease;
        }

        wizard-card .icon-circle {
            font-size: 20px;
            border: 3px solid #F3F2EE;
            border-top-color: rgb(243, 242, 238);
            border-right-color: rgb(243, 242, 238);
            border-bottom-color: rgb(243, 242, 238);
            border-left-color: rgb(243, 242, 238);
            text-align: center;
            border-radius: 50%;
            color: rgba(0, 0, 0, 0.2);
            font-weight: 600;
            width: 70px;
            height: 70px;
            background-color: #FFFFFF;
            margin: 0 auto;
            position: relative;
            top: -2px;
        }

        .form-control{
                /*border-radius: 50px;*/
                padding: 0 30px;
                height: 60px;
                line-height: 60px;
                border: 1px solid #777;
                border-top-color: rgb(119, 119, 119);
                border-right-color: rgb(119, 119, 119);
                border-bottom-color: rgb(119, 119, 119);
                border-left-color: rgb(119, 119, 119);
                color: #333;
                background: none;
                font-family: "Poppins", sans-serf;
                font-weight: 300;
                width: 100%;
        }

        select.form-control:not([size]):not([multiple]) {
            height: 60px;
        }

        .companypad{
            padding:25px 0px 30px;
        }

        .companyworkaddress{
             padding:10px;
             font-size: 12px;
             text-align: center;
        }

        .companyworkaddress a {
            color:#ff9a28;
        }
        .padding-top-25
        {
            padding-top: 25px;
        }

        .frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
       

        li span{
            margin-top:50px;
        }

        #suggesstion-box-main,#suggesstion-box-main-2{

            max-height: 150px;
            overflow: auto;
            border: 1px solid aliceblue;
        }

        #suggesstion-box,#suggesstion-box-2
        {
            list-style: none;
        }

        #suggesstion-box li,#suggesstion-box-2 li
        {
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
            height: 59;
            width: 200px;
            border: 1px solid #66615b;
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
            <section class="hero hero-page bg-gray has-pattern">
                <!--      Wizard container        -->
                <div class="container">
                    <div class="wizard-container">

                        <div class="card wizard-card" data-color="orange" id="wizardProfile">
                            <form action="" method="">
                        <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->

                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                         <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="" style="width: 25%;"></div>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="#company" data-toggle="tab">
                                                <div class="icon-circle">
                                                    &nbsp;
                                                    <!-- <i class="ti-user"></i> -->
                                                </div>
                                                <span>Select Company</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#account" data-toggle="tab">
                                                <div class="icon-circle">
                                                    &nbsp;
                                                    <!-- <i class="ti-settings"></i> -->
                                                </div>
                                                <span>Create Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#phone-number" data-toggle="tab">
                                                <div class="icon-circle">
                                                    &nbsp;
                                                    <!-- <i class="ti-map"></i> -->
                                                </div>
                                                 <span>Phone Number</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#payment" data-toggle="tab">
                                                <div class="icon-circle">
                                                    &nbsp;
                                                    <!-- <i class="ti-map"></i> -->
                                                </div>
                                                <span>Add Payment</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="company">
                                        <div class="row" id="search-by-address">
                                            
                                            <div align="center" class="col-sm-12 companypad">
                                            <h2>Where do you work?</h2>
                                            <h5 style="font-weight: normal"> We use your company's address to locate the best place to deliver your meal.</h5>
                                            </div>

                                            <div class="col-sm-8 offset-sm-2">
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
                                                <div id="suggesstion-box-main">
                                                    <ul id="suggesstion-box"></ul>
                                                </div>
                                                <div  class="companyworkaddress">Don't know your company's address? <a href="javascript:void(0)" id="btn-srch-comp" > Search by company name</a></div>
                                                
                                            </div>
                                        </div>

                                        <div class="row" id="search-by-company" style="display: none">
                                            
                                            <div align="center" class="col-sm-12 companypad">
                                            <h2>Find Your Company</h2>
                                            <h5 style="font-weight: normal">Tell us the name of your company to get started.</h5>
                                            </div>

                                            <div class="col-sm-8 offset-sm-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        <select class="form-control" id="city_id_2">
                                                            <?php
                                                            foreach($cities as $city):
                                                                echo '<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
                                                            endforeach;
                                                            ?>
                                                        </select>
                                                      </div>
                                                      <input id="comp_name" onkeyup="getCompany(this.value,'work')" name="work_address" type="text" style="height: 60px;" class="form-control" placeholder="Enter Address of the building you work in">
                                                    </div>
                                                    <div id="suggesstion-box-main-2">
                                                        <ul id="suggesstion-box-2"></ul>
                                                    </div>
                                                    
                                                    <div  class="companyworkaddress"><a href="javascript:void(0)" id="btn-srch-addr">Go Back</a></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="add-company" style="display: none">
                                            <div align="center" class="col-sm-12 companypad">
                                                <h2>Register your company</h2>
                                            </div>

                                            <div class="col-sm-8 offset-sm-2">
                                                <div class="form-group">
                                                    <div>
                                                        <label>Comany Name</label>
                                                        <input name="comp_name_txt" type="text" class="form-control" placeholder="Enter your full name">
                                                    </div>

                                                    <div class="padding-top-25">
                                                        <label>Employee Range (Employees who work in your office)</label>
                                                        <select name="job_title" class="form-control" style="width: 100%;">
                                                            <option>10-25</option>
                                                            <option value="I am the office manager">25-50</option>
                                                            <option value="I am not the office manager">> 50 </option>
                                                        </select>
                                                    </div>

                                                    <div class="padding-top-25">
                                                        <label>Company Address</label>
                                                        <input name="comp_address" type="password" class="form-control" placeholder="Enter your password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="account">
                                        <div class="row">
                                            <div align="center" class="col-sm-12 companypad">
                                                <h2>Create Your Account</h2>
                                            </div>

                                            <div class="col-sm-8 offset-sm-2">
                                                <div class="form-group">
                                                    <div>
                                                        <label>Name</label>
                                                        <input name="fullname" type="text" class="form-control" placeholder="Enter your full name">
                                                    </div>

                                                    <div class="padding-top-25">
                                                        <label>Email</label>
                                                        <input name="email" type="email" class="form-control" placeholder="Enter your email">
                                                    </div>

                                                    <div class="padding-top-25">
                                                        <label>Password</label>
                                                        <input name="password" type="password" class="form-control" placeholder="Enter your password">
                                                    </div>

                                                    <div class="padding-top-25">
                                                        <label>Job Title</label>
                                                        <select name="job_title" class="form-control" style="width: 100%;">
                                                            <option>Select job title</option>
                                                            <option value="I am the office manager">I am the office manager</option>
                                                            <option value="I am not the office manager">I am not the office manager</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="phone-number">
                                        <div class="row">
                                            <div align="center" class="col-sm-12 companypad">
                                                <h2>Add Mobile Number</h2>
                                            </div>
                                            <div class="col-sm-8 offset-sm-2">
                                                <div class="form-group">
                                                    <div>
                                                        <label>Mobile Number</label>
                                                        <input name="mobile_number" type="text" class="form-control numsonly" placeholder="Enter your mobile number" minlength="10" maxlength="10">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="payment">
                                        <h5 class="info-text"> What are you doing? (checkboxes) </h5>
                                        <div class="row">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-warning btn-wd' name='next' value='Next' />
                                        <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd' name='finish' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- wizard container -->
                </div>
            </section>
            <!--=============== /. Hero Section ===============-->


            


            


          <!--=============== footer ===============-->
            <?php $this->load->view('st_footer'); ?>
            <!--=============== /.footer ===============-->
        </div>
        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    
                </div>
            </div><!-- end row -->
        </div> <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
            </div>
        </div>
    </div>
    <div id="results"></div>
    </body>
    
   

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

    <!--  Plugin for the Wizard -->
    <script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
    <script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
    <!-- Easy Scroll -->
    <script src="<?php echo base_url(); ?>assets/js/easyscroll.min.js"></script>
    <!-- Animsition JS -->
    <script src="<?php echo base_url(); ?>assets/js/animsition.js">
    </script><script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.min.js"></script>
    <!-- jQuery Counter Up -->
   
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

    <!-- Autosuggestion places Js -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRmGd2_gbD_oFrN8CFO3e-ONavXVt4a58&libraries=places"
    async defer></script>
    
    <script>
      // This example retrieves autocomplete predictions programmatically from the
      // autocomplete service, and displays them as an HTML list.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
                        $('#suggesstion-box').html('');
                        $('#suggesstion-box-main').show();
                        $('#suggesstion-box').show();
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

    function getCompany(search_key)
    {
        if(search_key=="")
        {

            $('#suggesstion-box-2').html('');
            $('#suggesstion-box-main-2').hide('');
            return false;
        }

        var city_id = $('#city_id').val();
        $.ajax({
            url: "<?php echo base_url() ?>home/getCompany",
            type: "POST",
            data :{'city_id':city_id,'search_key':search_key},
            contentType: "application/x-www-form-urlencoded",                     
            success: function(response) 
            {
                 resp = JSON.parse(response);
                 if(resp.length != 0)
                 {
                    $('#suggesstion-box-2').html('');
                    $('#suggesstion-box-main-2').show();
                    $('#suggesstion-box-2').show();
                    $.each( resp, function(key,value) {
                      html = '<li onclick="setCompValue(\''+value['comp_name']+'\')">'+value['comp_name']+'</li>';
                      $('#suggesstion-box-2').append(html);
                     });
                 }else
                 {
                    $('#suggesstion-box-2').html('');
                     html = '<li onclick="addCompany()">No record found! add new company</li>';
                    $('#suggesstion-box-2').append(html);
                     // $('#suggesstion-box-main-2').hide();
                 }
            },
            error: function (request, status, error) 
            {},
            complete: function()
            {}
        });
    }

    $('#suggesstion-box-main').hide();
    $('#suggesstion-box-main-2').hide();
    $('#suggesstion-box').show();
    $(document).ready(function(){

        $("#btn-srch-addr").click(function(){
            $('#search-by-company').hide();
            $('#search-by-address').fadeIn('slow');
        });

        $("#btn-srch-comp").click(function(){
            $('#search-by-address').hide();
            $('#search-by-company').fadeIn('slow');
        });
    });

    </script>

    <script>
    $(document).ready(function(){
        $("#work_address").keyup(function(){
            // $("#suggesstion-box").html('test');
        });
    });

    function selectCountry(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
    }

    function setValue(val)
    {
        console.log(val);
        $('#work_address').val(val);
        $('#suggesstion-box-main').hide();
    }

    $(document).on("click", function (e) {
        
        $('#suggesstion-box').hide();
    });

    function setCompValue(val)
    {
        console.log(val);
        $('#comp_name').val(val);
        $('#suggesstion-box-main-2').hide();
    }

    function addCompany()
    {
        $('#search-by-company').hide();
        $('#add-company').show();
        $('#suggesstion-box-main-2').hide();
    }

    </script>
</html>
