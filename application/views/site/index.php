<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/home/bootstrap.css">
    <!-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/home/slick.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/home/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet">
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
            <div class="banner-image">
                <img src="<?php echo base_url() ?>assets/img/banner3.jpg" alt="" class="img-fluid">
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
                                   <p> The Karnataka Labour Welfare Fund is constituted for financing and conducting activities to promote welfare of contributing employees covered under the KLW Act, 1965. The employees working in various industries, their dependents and children are eligible for the following welfare schemes. </p>
                                   <p><b> Note: </b> Every year before 15th of January the employees’, employers’ contribute in the ratio of 20 : 40   i.e. Rs. 60 /- for each employee is to be remitted by the employer to the Welfare Fund.</p>
                                
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
                                                <p><b>Education assistance to children of the workers:</b> High School (8th  Std. to 10th ) Rs.3,000/- PUC /ITI/Dip./TCH  Rs. 4,000/- Degree Courses Rs. 5,000/- Post Graduation Courses.  Rs. 6,000/- &   Engineering/ Medical . Rs. 10,000/-(Eligibility for applying 50% marks for general merit and 45%  for SC/ST. </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                        <li>
                                            <div class="alert-message">
                                                <p><b>Medical Assistance:</b> to workers in the age group 18-60 yrs, though covered under ESI  scheme  from minimum of Rs. 1,000/- to maximum of Rs. 10,000/- for treatment of major ailments viz., Heart operation, Kidney transplantation, Cancer treatment, Angioplasty, Eye, Orthopaedic, Uterus operations, Gal bladder problems, Kidney stone removal, Brain haemorrhage, and for medical check-up each case Rs. 500/- to Rs. 1000/-    </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                        <li>
                                            <div class="alert-message">
                                                <p><b>Accident Benefit :</b> of Rs. 1,000/- to Rs. 3,000/- to workers in the age group 18-60  yrs,  application   to   be sent  within three months of accident with medical records though covered under ESI Act,   1948.  </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>

                                        <li>
                                            <div class="alert-message">
                                                <p>Funeral Expenses of Rs. 5,000/- for death of the beneficiary payable to the deceased’s dependents, to  be  applied in the prescribed  format within six months.  </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>

                                        <li>
                                            <div class="alert-message">
                                                <p>Medical Check-up Camps: Rs. 30,000/- Financial Assistance for annual medical check-up camps sponsored by Trade Union/Associations for workers contributing to the Welfare  Fund once in year. </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>

                                        <li>
                                            <div class="alert-message">
                                                <p>Annual Sports activity: Rs. 50,000/- Financial Assistance for annual Sports activity at district-level by registered Trade Unions one time in a year. </p>
                                            </div>
                                            <div class="devider"></div>
                                        </li>
                                    </ul>

                                </div>

















                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>

                            <!-- <canvas id="myChart" width="400" height="100"></canvas> -->
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
                            <a href="tel:08023570266" class="help-tel" >080 2357 0266</a>
                            <div class="dotted-devider"></div>
                            <a href="mailto:welfarecommissioner123@gmail.com" class="help-mail">welfarecommissioner123@gmail.com</a>
                        </div>
                    </div>
                </div>
               <!--  <div class="col-md-9 pr-0">
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
                </div> -->
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
                            
                            Email ID: <a href="mailto:welfarecommissioner123@gmail.com">welfarecommissioner123@gmail.com</a>
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
    <script src="<?php echo base_url() ?>assets/css/home/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/css/home/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/css/home/bootstrap.min.js"></script>
    <script src="//canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="<?php echo base_url() ?>assets/css/home/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/telex.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/jquery.marquee.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/newsticker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/home/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    

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


 <!--    <script>

        $(document).ready(function() {

            var lab = [];
            var con = [];
            var canCon = [];

            $.ajax({
                url: '<?php echo base_url("home/getordergraph") ?>',
                method: 'GET',
                async: true,
                dataType: 'json',
                success: function(dat) {

var ctx = document.getElementById('myChart').getContext('2d');
Chart.platform.disableCSSInjection = true;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Applications', 'Institutes', 'Industries', 'Students', 'Male', 'Female', 'SC' ,'ST'],
        datasets: [{
            label: 'MIS Report',
            data: [dat.application,dat.institute,dat.industry, dat.student, dat.male,dat.female,dat.sc, dat.st],
            backgroundColor: [
                '#4f81bc',
                '#c0504e',
                '#9bbb58',
                '#23bfaa)',
                '#8064a1',
                '#4aacc5',
                '#f79647',
                '#7f6084',
            ],
            borderColor: [
                '#4f81bc',
                '#c0504e',
                '#9bbb58',
                '#23bfaa)',
                '#8064a1',
                '#4aacc5',
                '#f79647',
                '#7f6084',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        animation: {
            duration: 0 // general animation time
        },
        hover: {
            animationDuration: 0 // duration of animations when hovering an item
        },
        legend: {
            display: false
        },
    }
});

}

});
});
</script> -->

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