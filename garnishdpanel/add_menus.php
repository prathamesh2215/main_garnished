<?php
    include("include/routines.php");

    checkuser();

    $title           = "Add Menus";
    $path_parts      = pathinfo(__FILE__);
    $filename        = $path_parts['filename'].".php";
    $sql_feature     = "select * from tbl_admin_features where af_page_url = '".$filename."'";
    $result_feature  = mysqli_query($db_con,$sql_feature) or die(mysqli_error($db_con));
    $row_feature     = mysqli_fetch_row($result_feature);
    $feature_name    = 'Add Menus';
    $home_name       = "Home";
    $home_url        = "view_menus.php?";
    $utype           = $_SESSION['panel_user']['utype'];
    $tbl_users_owner = $_SESSION['panel_user']['tbl_users_owner'];
?>
<!doctype html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
        ?>
    </head>
    
    <body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
        <?php
        /*include Bootstrap model pop up for error display*/
        modelPopUp();
        /*include Bootstrap model pop up for error display*/
        /* this function used to add navigation menu to the page*/
        navigation_menu();
        /* this function used to add navigation menu to the page*/
        ?> <!-- Navigation Bar -->
       
        <!-- Page Content -->
        <section class="page-content">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered green">
                            <div class="box-title">
                                <h3><i class="icon-table"></i>Add Menus</h3>
                                <button id="reset" type="button" class="btn" onclick="window.history.back()" style="float: right;margin-right: 10px;">Back</button>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="add_menus" name="add_menus">
                                
                                <input type="hidden" id="hid_add_menus" name="hid_add_menus" value="1">
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Menu Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="menu_name" name="menu_name" class="input-xlarge v_name" data-rule-required="true" placeholder="Enter Menu Here">
                                    </div>
                                </div>  <!-- Menu Name -->
                                
                                <div class="control-group">
                                    <label for="radio" class="control-label">Status<span style="color:#F00;font-size:20px;">*</span></label>
                                    <div class="controls">
                                        <input type="radio" name="menu_status" value="1" class="css-radio" data-rule-required="true" checked>Active
                                        <input type="radio" name="menu_status" value="0" class="css-radio" data-rule-required="true" >Inactive
                                    </div>
                                </div>

                                <div class="form-actions" style="clear:both;">
                                    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Add Menus</button>
                                </div> <!-- Submit -->
                            
                            </form> 
                        </div>
                            
                       </div>
                   </div>
               </div>
            </div>      
        </section>
            <!-- Page Content / End -->
        <script type="text/javascript">

            var baseurll            = '<?php echo $BaseFolder; ?>';

            $('#add_menus').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#add_menus').valid())
                {
                    
                    $.ajax({
                        url: "load_menus.php?",
                        type: "POST",
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        async:true,                     
                            success: function(response) 
                            {   data = JSON.parse(response);
                                if(data.Success == "Success") 
                                {  
                                    location.href   = baseurll + "view_menus.php?";
                                } 
                                else 
                                {   
                                    alert(data.resp);
                                    location.href   = baseurll + "view_menus.php?";
                                }
                            },
                            error: function (request, status, error) 
                            {
                                $("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');                          
                                $('#error_model').modal('toggle');  
                                loading_hide();
                            },
                            complete: function()
                            {
                                //alert("complete");
                                loading_hide();
                            }
                        });
                }
            });
        </script>
    </body>
</html>

