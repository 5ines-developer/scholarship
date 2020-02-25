<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/home/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/home/style.css">
    <style>
    .sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 111111;
}

    </style>
</head>

<body>
    <section class="top">
        <div class="container">
            <span class="grad-cap"><i class="fas fa-graduation-cap"></i></span><span class="top-title">
                SCHOLARSHIP</span>
              <a href="<?php echo base_url() ?>payment/" target="_blank" class="payment">
                <span class="grad-cap"><i class="fas fa-credit-card"></i></span><span class="top-title">
                    Make Payment</span>
              </a>  

        </div>
    </section>
    <section class="comp-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-9 col-sm-12 col-12">
                    <div class="logo">
                        <a href="">
                            <img src="<?php echo base_url() ?>assets/img/logo.png" alt="" class="logobrand">
                        </a>
                    </div>
                    <div class="comp">
                        <h5>Employer Fund Contribution  and  Student Scholarship Application System</h5>
                        <p>Karnataka Labour Welfare Board</p>
                        <p>Department Of Labour, Government of Karnataka</p>
                    </div>


                  
                </div>
                <!-- <div class="col-md-7 col-9">
                    
                </div> -->
                <div class="col-md-3">
                    <div class="comp-head">
                        <img src="<?php echo base_url() ?>assets/img/head1.jpg" alt="">
                        <img src="<?php echo base_url() ?>assets/img/head2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav class="navbar navbar-expand-lg custom-navbar " id="navbar">

        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  custom-nav">
                    <li class="nav-item active">
                        <a class="nav-link active" href="<?php echo base_url() ?>">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">about us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notification</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Student Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                         
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link login-link" href="<?php echo base_url() ?>govt/login" target="_blank"><i class="fas fa-home"></i>Official login</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <section class="content">
        <div class="banner-slider ">
            <div class="banner-image">
                <img src="<?php echo base_url() ?>assets/img/banner1.jpg" alt="" class="img-fluid">
            </div>
            <div class="banner-image">
                <img src="<?php echo base_url() ?>assets/img/banner2.jpg" alt="" class="img-fluid">
            </div>
        </div>
    </section>
    <section class="news-sec">
        <div class="container-fluid">
            <div class="news-box">
                <div class="row">
                    <div class="col-md-3 p0">
                        <div class="news-title">
                            <h4>Flash News</h4>
                        </div>
                    </div>
                    <div class="col-md-9 p0">
                        <div class="news">
                            <div class="news-slider">
                                <div>
                                    
                                        <div id="tx"></div>
                                        
                                </div>
                                <div class="playpouse">
                                    <button id="pause"><i class="fas fa-stop-circle ml-0" ></i> </button><button id="resume"><i class="fas fa-play"></i></button>
                                </div>
                               

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3  bg-grey left-pad">

                    <div class="row">
                        <div class="col-sm-4 col-md-12 col-lg-12">
                            <div class="card custom-card bg-grey">

                                <img src="<?php echo base_url() ?>assets/img/stu.png" alt="" style="width: 100%;">
        
                                <div class="box">
                                    <h6 class="text-center">STUDENT</h6>
                                    <a href="<?php echo base_url() ?>student/login" target="_blank" class="btn">Login</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12 col-lg-12">
                            <div class="card custom-card bg-grey">

                                <img src="<?php echo base_url() ?>assets/img/INDUST.png" alt="" style="width: 100%;">
                                <div class="box">
                                    <h6 class="text-center">INDUSTRY</h6>
                                    <a href="<?php echo base_url() ?>industry/login" target="_blank" class="btn">Login</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12 col-lg-12">
                            <div class="card custom-card bg-grey">

                                <img src="<?php echo base_url() ?>assets/img/insti.png" alt="" style="width: 100%;">
                                <div class="box">
                                    <h6 class="text-center">INSTITUTIONS</h6>
                                    <a href="<?php echo base_url() ?>institute/" target="_blank" class="btn">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                    
                  

                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mid-lay">
                                <div class="mid-lay-img">
                                    <i class="fas fa-university"></i>
                                </div>
                               <div class="about">
                                   <h4>About Us</h4>
                                   <p>
                                       The main agenda of this web application portal is for the students to claim the Education assistance online and the employer to contribute his company’s fund via online.
                                   </p>
                                   <p>
                                    Where student will register in the portal and submit the request for Education assistance. Post request submitted it will be sent to the next level of approvals. Likewise employer will register in the portal and will contribute his company’s fund via online and will receive an acknowledgement after the payment in return via online. </p>
                                <p>
                                    Each entity will have their own dashboard and use the same credentials through out there association with the Karnataka Labour Welfare Board. This web application software is developed using state of the art technology and is bundled with features.
                                    Few of them are Automatic Remainder Systems, SMS alerts, E-Mail Alerts, Custom Reports etc. </p>
                               </div>
                            </div>

                        </div>
                        <div class="col-md-4 pr-0">
                            <div class="alert-box">
                                <h4 class="alert-title">
                                    important alerts
                                </h4>
                                <div class="alert-message-box z-depth-2">
                                    <ul id="marquee-vertical" style="height:280px">
                                        <li>
                                            <div class="alert-message">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod error
                                                    veritatis deleniti, </p>
                                                <a href="">CLICK HERE</a>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                        <li>
                                            <div class="alert-message">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod error
                                                    veritatis deleniti, </p>
                                                <a href="">CLICK HERE</a>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                        <li>
                                            <div class="alert-message">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod error
                                                    veritatis deleniti, </p>
                                                <a href="">CLICK HERE</a>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                    </ul>

                                </div>

















                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 px-0">
                    <div class="help-box">
                        <h4 class="help-title">HelpDesk</h4>
                        <div class="help-message-box">
                            <p>Candidate can contact the Help Desk for resolution of the technical problems</p>
                            <div class="dotted-devider"></div>
                            <a href="" class="help-tel">0000-0000000</a>
                            <div class="dotted-devider"></div>
                            <a href="mailto:info@klwb-kar.com" class="help-mail">info@klwb-kar.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 pr-0">
                    <div class="e-box">
                        <h4 class="e-title">e-Initiatives</h4>
                        <div class="contents">
                            <div class="row" style="margin: 0;">
                                <div class="col-md-4">
                                    <p class="listname">Lorem ipsum dolor sit dolor sit </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor sit </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="listname">Lorem ipsum dolor sit dolor sit </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor sit </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="listname">Lorem ipsum dolor sit dolor sit </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor </p>
                                    <div class="list-devider"></div>
                                    <p class="listname">Lorem ipsum dolor sit orem ipsum dolor sit </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="footer-list">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="footer-title">Contact Us</h6>
                        <p>
                            <span style="margin-bottom: -10px;display: block;"> Karnataka Labour  Welfare Board</span><br>
                            No.48, 2nd Floor,<br>
                            Mathikere Main Road, Near RTO Office,<br>
                           Yeshwanthpur, Bangalore - 560022.<br>
                            Ph: <a href="tel:+08023570266">080 23570266</a>/ <a href="tel:+08023575130">23575130</a>       <br>
                            Fax: 080 23475188<br>
                            
                            Email ID: <a href="mailto:info@klwb-kar.com">info@klwb-kar.com</a>
                        </p>
                    </div>
                    <div class="col-md-4 ">
                        <h6 class="footer-title">Important Websites</h6>
                        <ul class="footer-menu">
                            <li><a class=" js-scroll-trigger" href="#">Karnataka State Welfare Board </a></li>
                            <li><a class=" js-scroll-trigger" href="#">Samudhaya Bhawan Online Booking
                                </a></li>
                            <li><a class=" js-scroll-trigger" href="#">Karnataka State Labour Institute
                                    </a></li>

                        </ul>
                    </div>
                    <div class="col-md-4 footer-contact">
                        <h6 class="footer-title">Portal Links</h6>
                        <ul class="footerlinks footer-menu">

                            <li><a href="#"> About Portal </a></li>
                            <li><a href="#"> Help </a></li>
                            <li><a href="#"> FAQs</a></li>
                            <li><a href="#"> Site Map</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footercompany">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    © Copyright <?php echo date('Y') ?>. All Rights Reserved.
                </div>



            </div>
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/telex.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/jquery.marquee.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/newsticker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/slick.min.js"></script>

    <script>
        $('#tx').telex({
            messages: [
                {
                    id: 'msg1',
                    content: '  <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a><span class="brd"></span> <span>Notification issued to Public for guidelines    to Apply Online</span> <a href="">CLICK HERE</a>  <h6>   <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a>  <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a></h6>'
                },
                {
                    id: 'msg2',
                    content: ' <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a><span class="brd"></span> <span>Notification issued to Public for guidelines    to Apply Online</span> <a href="">CLICK HERE</a>  <h6>   <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a>  <h6> <span>Guidelines to Apply Online</span> <a href="">CLICK HERE</a></h6>',
                    class: 'cls-second'
                }
                /* more messages... */
            ],
            delay: 0,
            timing:'cubic-bezier(0.1, -0.0, 0.9, 1)',


        });

        $("#pause").click(function () {
            $("#tx").telex("pause");
        });
        $("#resume").click(function () {
            $("#tx").telex("resume");
        });
    </script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script>
        $('.banner-slider').slick({
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            touchMove: true,
            prevArrow: '<span class="left"> <i class="fas fa-angle-left"></i> </span>',
            nextArrow: '<span class="right"> <i class="fas fa-angle-right"></i> </span>',
        });



    </script>
    <script>
        window.onload = function () {

            var options = {
                animationEnabled: true,
                title: {
                    text: "MIS Report"
                },
                axisY: {
                    title: "Growth Rate (in %)",
                    suffix: "%",
                    includeZero: false
                },
                axisX: {
                    title: "Data"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.0#" % "",
                    dataPoints: [
                        { label: "Applications", y: 10.09 },
                        { label: "Institutes", y: 9.40 },
                        { label: "Industries", y: 8.50 },
                        { label: "Students", y: 7.96 },
                        { label: "Male", y: 7.80 },
                        { label: "Female", y: 7.56 },
                        { label: "SC", y: 7.20 },
                        { label: "ST", y: 7.1 }

                    ]
                }]
            };
            $("#chartContainer").CanvasJSChart(options);

        }
    </script>
    <script type="text/javascript">

        $(function () {


            $('#marquee-vertical').marquee();



        });
    </script>


<script>
    window.onscroll = function() {myFunction()};
    
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    
    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }
    </script>




   
</body>

</html>