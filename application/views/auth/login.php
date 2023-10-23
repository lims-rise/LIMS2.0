<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LIMS Application</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" 
                href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
                <!-- href="<?php //echo base_url() ?>assets/adminlte/dist/css/googleapis.css/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
        <style>
        #myVideo {
                position: fixed;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
                }
                .container {
                position: relative;
                }
            .card{
                background-color: #ffffff52 !important;
            }
            .h1{
                color: black !important;
            }

            .form-group label {
                font-size: 14px;
                color: #000000 !important;
                margin-bottom: 4px;
            }

            @keyframes glowing {
                0% { color: red; text-shadow: 0 0 10px red; }
                50% { color: orange; text-shadow: 0 0 20px orange; }
                100% { color: red; text-shadow: 0 0 10px red; }
            }

            .blinking {
                animation: blinking 2s infinite, glowing 2s infinite;
            }
            
    </style>
    </head>

    <!-- <img src="../img/black.jpg" class="user-image" alt="User Image"> -->
    
    <video autoplay muted loop id="myVideo">
        <source src="../img/dna.mp4" type="video/mp4">
    </video>

    <body class="hold-transition login-page">

        <style>h1{
            color:white;
            font-size:55px;
            }
        </style>
        <!-- <div class="login-box"> -->
        <!-- </div> -->
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body" style="text-align: center;">
            <h1><div id="time"></div></h1>
            <div class="login-logo">
                <!-- <a href="<?php echo base_url(); ?>"> -->
                <!-- <b><mark>LIMS</mark>2.0</b>|LOGIN -->
                <b><span style="background-color: #FFFFFF; color: #000000">LIMS</span>2.0</b>|LOGIN
            <!-- </a> -->
            </div>
                <?php
                $status_login = $this->session->userdata('status_login');
                if (empty($status_login)) {
                    $message = "Laboratory Information Management System v.2.0";
                } else {
                    $message = $status_login;
                    $messageClass = 'blinking';
                }
                ?>
                <p class="login-box-msg <?php echo isset($messageClass) ? $messageClass : ''; ?>" style="font-size: 16px;"><?php echo $message; ?></p>

                <?php echo form_open('auth/cheklogin'); ?>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <!-- <div class="col-sm-4"> -->
                        <!-- <input type="password" class="form-control" name="password" placeholder="Password"> -->
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-eye-close bt1" style="cursor:pointer"></span>
                        <!-- </div> -->
                          <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
                        <!-- <div class="col-xs-2">
                            <button type="submit" class="btn btn-danger btn-block btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                        </div> -->
                    </div>
                    <!-- <button type="submit" class="btn btn-danger btn-block btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button> -->
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                    </div>
                    <!-- <div class="col-xs-4"> -->
                        <!-- For RISE only -->
                        <!-- <button type="submit" class="btn btn-warning btn-block btn-flat"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button> -->
                    <!-- </div> -->
                    <div class="col-xs-8">
                        <p class="login-box-msg" style="text-align: right;">
                        <!-- Only for  -->
                        <a href="https://rise-program.org/" target="_blank">
                            <!-- RISE Program -->
                            <span><img src="../assets/img/Project4.png" height='25px'  /></span>
                        </a></p>
                        <?php //echo anchor('#', '<i class="fa fa-eye-slash" aria-hidden="true"></i> Forget Password?', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
                    </div>
                </div>
                <!-- /.col -->


                <!-- /.col -->
                <!-- <div class="row" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        <div class="callout callout-info">
                            <h4>Level Super Admin</h4>

                            <p><b>Email</b> : nuris.akbar@gmail.com</p>
                            <p><b>Password</b> : password</p>
                            <hr>
                            <h4>Level Admin</h4>

                            <p><b>Email</b> : hafid@gmail.com</p>
                            <p><b>Password</b> : password</p>
                        </div>
                    </div>

                </div> -->
                </form>




            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>/assets/adminlte/plugins/iCheck/icheck.min.js"></script>
        <!-- <script src="<?php //echo base_url(); ?>assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php //echo base_url(); ?>assets/js/templatemo-script.js"></script> -->
        <script>
            $(document).ready(function() {

                var myVideo = document.getElementById("myVideo");
                if (myVideo.addEventListener) {
                    myVideo.addEventListener('contextmenu', function(e) {
                        e.preventDefault();
                    }, false);
                } else {
                    myVideo.attachEvent('oncontextmenu', function() {
                        window.event.returnValue = false;
                    });
                }

                            
            $(".bt1").bind("click", function() {
                if ($('#password').attr('type') =='password'){
                    $('#password').attr('type','text');
                    $('.bt1').removeClass('glyphicon-eye-close');
                    $('.bt1').addClass('glyphicon-eye-open');
                }else if($('#password').attr('type') =='text'){
                    $('#password').attr('type','password');
                    $('.bt1').removeClass('glyphicon-eye-open');
                    $('.bt1').addClass('glyphicon-eye-close');
                }
                });    
            });            

            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });


            $(function() {
                startTime();
                // $(".center").center();
                // $(window).resize(function() {
                //     $(".center").center();
                // });
            });

            /*  */
            function startTime()
            {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();

                // add a zero in front of numbers<10
                h = checkTime(h);
                m = checkTime(m);
                s = checkTime(s);

                //Check for PM and AM
                // var day_or_night = (h > 11) ? "PM" : "AM";

                //Convert to 12 hours system
                // if (h > 12)
                //     h -= 12;

                //Add time to the headline and update every 500 milliseconds
                // $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
                $('#time').html(h + ":" + m + ":" + s);
                setTimeout(function() {
                    startTime()
                }, 500);
            }

            function checkTime(i)
            {
                if (i < 10)
                {
                    i = "0" + i;
                }
                return i;
            }                        
        </script>
    </body>
</html>
