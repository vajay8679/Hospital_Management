<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title><?php echo getConfig('site_name'); ?> | <?php
            if (!empty($title) && isset($title)): echo ucwords($title);
            endif;
            ?></title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>backend_asset/admin/img/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>backend_asset/admin/img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">


        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/themes.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend_asset/admin/css/themes/fancy.css">
        <link href="<?php echo base_url(); ?>backend_asset/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/modernizr.min.js"></script>
        <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend_asset/admin/js/vendor/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
        <style>
            .btn-primary {
                /*                background-color: #b22b57;*/
                background: linear-gradient(to right, rgba(71,74,127,1) 0%,rgba(178,43,87,1) 100%);
                border-color: #E47EA0;
                color: #ffffff;
            }

            .btn-primary.btn-alt {
                background-color: #b22b57;
                color: #1bbae1;
            }

            .btn-primary:hover {
                background: linear-gradient(to right, rgba(71,74,127,1) 0%,rgba(178,43,87,1) 100%);
                border-color: #E47EA0;
                color: #ffffff;
            }
            .text-primary, .text-primary:hover, a, a:hover, a:focus, a.text-primary, a.text-primary:hover, a.text-primary:focus {
                color: 
                    #b22b57;
            }
        </style>
    </head>
    <body>
        <div id="page-wrapper">


            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations style-alt">


                <!-- Main Container -->
                <div id="main-container">

                    <!-- END Header -->
                    <!-- Page content -->
                    <div class="col-sm-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="<?php echo site_url('setting/add_days'); ?>" name="patientForm" method="post">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="text-left">Total Patient Days: </div>
                                        <input type="text" name="total_patient_days" class="form-control" value="<?php echo (getConfig('total_patient_days') <= 0) ? $patients_days->tatal_days : getConfig('total_patient_days'); ?>" disabled=""/>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="text-left">Total Days on Antibiotic: </div>
                                        <input type="text" name="total_patient_days1" class="form-control" value="<?php echo $total_antibiotic_days; ?>" disabled=""/>
                                    </div> 
                                    <div class="col-sm-6 col-lg-2">
                                        <div class="text-left">ABx Days Per 1000 Total Patient days:</div>
                                        <input type="text" name="total_patient_day2" class="form-control" value="<?php echo $toatl_patient_days_average; ?>" disabled=""/>
                                    </div>
                                    <br>
                                    <div class="col-sm-6 col-lg-2">
                             
                                        <a  class="btn btn-primary" href="<?php echo base_url().'/reportsSummary/app' ?>" value="<?php echo $toatl_patient_days_average; ?>">View Reports Summary <i class="fa fa-bar-chart"></i></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                    <div id="page-content">
                        <!--        <div id="msg"></div>-->
                        <!-- eShop Overview Block -->
                        <?php
                        $message = $this->session->flashdata('success');
                        if (!empty($message)):
                            ?><div class="alert alert-success">
                                <?php echo $message; ?></div><?php endif; ?>
                        <div class="block full">
                            <div class="row text-center">
                                <div class="col-sm-12 col-lg-12">   
  

                                    <div class="panel panel-default">
                                        <div class="panel-body">    

                                            <div class="col-sm-12 col-lg-3">

                                                <select id="careUnit" name="careUnit" class="form-control select-2" onchange="getAntibioticByCareUnit(this.value)">
                                                    <option value="">Select Care Unit</option>
                                                    <?php
                                                    if (isset($careUnit) && !empty($careUnit)) {
                                                        foreach ($careUnit as $row) {
                                                            $select = "";
                                                            if (isset($careUnitID)) {
                                                                if ($careUnitID == $row->id) {
                                                                    $select = "selected";
                                                                }
                                                            }
                                                            ?>
                                                            <option value="<?php echo $row->id; ?>" <?php echo $select; ?>><?php echo $row->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="col-sm-12 col-lg-3">
                                                <select id="provider_doctor" name="provider_doctor" class="form-control select-2" onchange="getAntibioticByCareUnitProviderId()">
                                                    <option value="">Select Provider MD</option>
                                                    <?php
                                                    if (isset($doctors) && !empty($doctors)) {
                                                        foreach ($doctors as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?></select></div>
                                            <div class="col-sm-12 col-lg-3">
                                                <select id="steward" name="steward" class="form-control select-2" onchange="getAntibioticByCareUnitStewardPrice()">
                                                    <option value="">Select MD Steward</option>
                                                    <?php
                                                    if (!empty($staward)) {
                                                        foreach ($staward as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->first_name . ' ' . $row->last_name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?></select></div> 
                                            <div class="col-sm-12 col-lg-3">
                                                <select id="RX" name="RX" class="form-control select-2" onchange="getAntibioticByCareUnit('', this.value);getAntibioticByCareUnitProviderId();">
                                                    <option value="">Select Antibiotic</option>
                                                    <?php
                                                    if (!empty($initial_rx)) {
                                                        foreach ($initial_rx as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?></select></div>
                                                                                           


                            <div class="col-sm-12 col-lg-3">
             
                                   <input type="text" class="form-control" name="fromdate" id="date1" placeholder="From Date" onchange="getReports()"/>

                            </div>
                              <div class="col-sm-12 col-lg-3">
             
                                   <input type="text" class="form-control" name="todate" id="date2" placeholder="To Date" onchange="getReports()" />
                
                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- eShop Overview Title -->
                            <div class="block-title">

                            </div>
                            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne">
                                Detailed Antibiotics by Provider MD 

                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="This section will represent the data of antibiotics days based on selected provider, once you select  any provider that provider will be compared with the average of rest providers."
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body" id='reportPage'>
                                <div class="col-lg-12 col-sm-12">
                                    <h5><strong>Antibiotics by Provider MD 
                               <!--          <button type="button" onclick="downloadPDF2('canvas21','Antibiotics by Provider MD')"> Export </button> -->
                                    </strong> </h5>
                                    <div id='Graph-chart21' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas21"></canvas>
                                    </div>
                                </div>
                                </br>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Antibiotics by Provider MD Comparison
                                      <!--   <button type="button" onclick="downloadPDF2('canvas22','Antibiotics by Provider MD Comparison')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart22' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas22"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>REST 
                                        <!-- <button type="button" onclick="downloadPDF2('canvas23','REST')"> Export </button> -->
                                    </strong>
                                    </h5>
                                    <div id='Graph-chart23' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas23"></canvas>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne1">
                                Detailed Antibiotics Price By Provider
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="This section will represent the cost of antibiotics pescribed based on selected Care Unit, Provider and MD Steward. "
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Antibiotics Price By Provider
                                   <!--      <button type="button" onclick="downloadPDF2('canvas24','Antibiotics Price By Provider')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart24' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas24"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Antibiotics Price By MD Steward
                                 <!--        <button type="button" onclick="downloadPDF2('canvas25','Antibiotics Price By MD Steward')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart25' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas25"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne2">
                                Detailed Antibiotics Percentage by Facility and MD Steward
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="This section will represent antibiotics percentage based on selected facility and steward"
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Antibiotics Percentage By Facility
                                    <!--     <button type="button" onclick="downloadPDF2('canvas','Antibiotics Percentage By Facility')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Antibiotics Percentage by MD Steward
                               <!--          <button type="button" onclick="downloadPDF2('canvas1','Antibiotics Percentage by MD Steward')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart1' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas1"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne3">
                                Detailed Days Saved by Facility 
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="This section represents percentage of days saved by facility and comparison of actual dot and Initial DOT."
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne3" class="panel-collapse collapse">

                            <div class="panel-body">
                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Days Saved by Facility in percentage
                                   <!--      <button type="button" onclick="downloadPDF2('canvas2','Days Saved by Facility in percentage')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart2'>
                                        <canvas id="canvas2"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong>Actual v/s Initial DOT by Facility (Actual Figures)
                                    <!--     <button type="button" onclick="downloadPDF2('canvas4','Actual vs Initial DOT by Facility')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart4'>
                                        <canvas id="canvas4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne4">
                                Detailed Actual v/s Initial DOT by MD Steward and Provider MD
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="
This section represents the comparison of initial DOT and Actual DOT based on MD Steward and Provider MD."
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne4" class="panel-collapse collapse">

                            <div class="panel-body">
                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong> Actual v/s Initial DOT by MD Steward
                                      <!--   <button type="button" onclick="downloadPDF2('canvas5','Actual vs Initial DOT by MD Steward')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart5' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas5"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong> Actual v/s Initial DOT by Provider MD
                                <!--         <button type="button" onclick="downloadPDF2('canvas6','Actual vs Initial DOT by Provider MD')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart6' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas6"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h4 class="panel-title"
                                data-toggle="collapse"
                                data-target="#collapseOne5">
                               Detailed Rx and Dx percentage by days
                                <a href="#" data-toggle="tooltip" data-placement="bottom"
                                   title="" data-original-title="This section represents the percentage of Rx and Dx by Days."
                                   class="red-tooltip"><i class="fa fa-info-circle"></i></a>
                            </h4>
                        </div>
                        <div id="collapseOne5" class="panel-collapse collapse">

                            <div class="panel-body">
                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong> Rx % by Days
                           <!--              <button type="button" onclick="downloadPDF2('canvas31','Rx percentage by Days')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart31' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas31"></canvas>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <h5><strong> Dx % by Days
                        <!--                 <button type="button" onclick="downloadPDF2('canvas32','Dx percentage by Days')"> Export </button> -->
                                    </strong></h5>
                                    <div id='Graph-chart32' style="min-width:250px; min-height: 320px;">
                                        <canvas id="canvas32"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Antibiotics by MD Steward</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id='Graph-chart1'>
                                        <canvas id="canvas1"></canvas>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Days Saved by Facility</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart2'>
                                        <canvas id="canvas2"></canvas>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Actual v/s Initial DOT by Facility</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart4'>
                                        <canvas id="canvas4"></canvas>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Actual v/s Initial DOT by MD Steward</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart5'>
                                        <canvas id="canvas5"></canvas>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Actual v/s Initial DOT by Provider Doctor</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart6'>
                                        <canvas id="canvas6"></canvas>
                                    </div>
                                </div>
                            </div> -->
                            <!-- remain -->

                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Dx % by Actual DOT</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart3'>
                                        <canvas id="canvas3"></canvas>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="block-title">
                                <h2><strong>Reports:</strong> Total agreement</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div style="width:50%;" id='Graph-chart7'>
                                        <canvas id="canvas7"></canvas>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- END Page Content -->
                    <script>
                        $('[data-toggle="tooltip"]').tooltip();
                    </script>
