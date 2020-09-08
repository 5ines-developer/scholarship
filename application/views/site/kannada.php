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

            <a href="<?php echo base_url() ?>" target="_blank"><span class="grad-cap white-text">ENGLISH</span></a>

            <a href="<?php echo base_url() ?>student" target="_blank"><span class="grad-cap"><i class="fas fa-graduation-cap"></i></span><span class="top-title">

                ವಿದ್ಯಾರ್ಥಿವೇತನ</span></a>

              <a href="<?php echo base_url() ?>payment/" target="_blank" class="payment">

                <span class="grad-cap"><i class="fas fa-credit-card"></i></span><span class="top-title">

                    
ಹಣ ಪಾವತಿ ಮಾಡಿ</span>

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

                        <h5>ಉದ್ಯೋಗದಾತ ನಿಧಿ ಕೊಡುಗೆ ಮತ್ತು ವಿದ್ಯಾರ್ಥಿ ವಿದ್ಯಾರ್ಥಿವೇತನ ಅರ್ಜಿ ವ್ಯವಸ್ಥೆ</h5>

                        <p>ಕರ್ನಾಟಕ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ಮಂಡಳಿ</p>

                        <p>ಕಾರ್ಮಿಕ ಇಲಾಖೆ, ಕರ್ನಾಟಕ ಸರ್ಕಾರ</p>

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

                        <a class="nav-link active" href="<?php echo base_url() ?>">ಮುಖಪುಟ</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#about">ನಮ್ಮ ಬಗ್ಗೆ</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#report">ವರದಿಗಳು</a>

                    </li>

                  <!--   <li class="nav-item">

                        <a class="nav-link" href="#">ಅಧಿಸೂಚನೆ</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#">ಅರ್ಜಿ ನಮೂನೆ</a>

                    </li> -->

                    <li class="nav-item">

                        <a class="nav-link" href="#footer">ಸಂಪಕಿ೯ಸಿ</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link login-link" href="<?php echo base_url() ?>govt/login" target="_blank"><i class="fas fa-home"></i>ಅಧಿಕೃತ ಲಾಗಿನ್</a>

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

            <div class="banner-image">

                <img src="<?php echo base_url() ?>assets/img/banner5.jpg" alt="" class="img-fluid">

            </div>

        </div>

    </section>

    <section class="news-sec">

        <div class="container-fluid">

            <div class="news-box">

                <div class="row">

                    <div class="col-md-3 p0">

                        <div class="news-title">

                            <h4>ಫ್ಲ್ಯಾಶ್ ನ್ಯೂಸ್</h4>

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

                                    <h6 class="text-center">ವಿದ್ಯಾರ್ಥಿ</h6>

                                    <a href="<?php echo base_url() ?>student/login" target="_blank" class="btn">ಲಾಗಿನ್ ಮಾಡಿ</a>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-4 col-md-12 col-lg-12">

                            <div class="card custom-card bg-grey">



                                <img src="<?php echo base_url() ?>assets/img/INDUST.png" alt="" style="width: 100%;">

                                <div class="box">

                                    <h6 class="text-center">ಇಂಡಸ್ಟ್ರಿ</h6>

                                    <a href="<?php echo base_url() ?>industry/login" target="_blank" class="btn">ಲಾಗಿನ್ ಮಾಡಿ</a>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-4 col-md-12 col-lg-12">

                            <div class="card custom-card bg-grey">



                                <img src="<?php echo base_url() ?>assets/img/insti.png" alt="" style="width: 100%;">

                                <div class="box">

                                    <h6 class="text-center">ಸಂಸ್ಥೆಗಳು</h6>

                                    <a href="<?php echo base_url() ?>institute/" target="_blank" class="btn">ಲಾಗಿನ್ ಮಾಡಿ</a>

                                </div>

                            </div>

                        </div>

                    </div>



                   

                    

                  



                </div>

                <div class="col-md-9">

                    <div class="row">

                        <div id="about"  class="col-md-8">

                            <div class="mid-lay">

                                <div class="mid-lay-img">

                                    <i class="fas fa-university"></i>

                                </div>

                               <div class="about">

                                   <h4>ನಮ್ಮ ಬಗ್ಗೆ</h4>

                                   <p> ಕೆಎಲ್‌ಡಬ್ಲ್ಯೂ ಕಾಯ್ದೆ, 1965 ರ ವ್ಯಾಪ್ತಿಗೆ ಬರುವ ನೌಕರರ ಕಲ್ಯಾಣವನ್ನು ಉತ್ತೇಜಿಸಲು ಹಣಕಾಸು ಮತ್ತು ಚಟುವಟಿಕೆಗಳನ್ನು ನಡೆಸಲು ಕರ್ನಾಟಕ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ನಿಧಿಯನ್ನು ರಚಿಸಲಾಗಿದೆ. ವಿವಿಧ ಕೈಗಾರಿಕೆಗಳಲ್ಲಿ ಕೆಲಸ ಮಾಡುವ ನೌಕರರು, ಅವರ ಅವಲಂಬಿತರು ಮತ್ತು ಮಕ್ಕಳು ಈ ಕೆಳಗಿನ ಕಲ್ಯಾಣ ಯೋಜನೆಗಳಿಗೆ ಅರ್ಹರಾಗಿದ್ದಾರೆ. </p>

                                   <p><b> ಸೂಚನೆ: </b> ಪ್ರತಿ ವರ್ಷ ಜನವರಿ 15 ರ ಮೊದಲು ನೌಕರರು, ಉದ್ಯೋಗದಾತರು 20: 40 ಅನುಪಾತದಲ್ಲಿ ಕೊಡುಗೆ ನೀಡುತ್ತಾರೆ, ಅಂದರೆ ರೂ. 60 / - ಪ್ರತಿ ಉದ್ಯೋಗಿಗೆ ಉದ್ಯೋಗದಾತರಿಂದ ಕಲ್ಯಾಣ ನಿಧಿಗೆ ರವಾನಿಸಬೇಕು.</p>

                                

                               </div>

                            </div>



                        </div>

                        <div  class="col-md-4 pr-0">

                            <div class="alert-box">

                                <h4 class="alert-title">

                                    ಪ್ರಮುಖ ಎಚ್ಚರಿಕೆಗಳು

                                </h4>

                                <div class="alert-message-box z-depth-2">

                                    <ul id="marquee-vertical" style="height:280px">

                                        <li>

                                            <div class="alert-message">

                                                <p><b>ಕಾರ್ಮಿಕರ ಮಕ್ಕಳಿಗೆ ಶಿಕ್ಷಣ ನೆರವು:</b>ಪ್ರೌಢಶಾಲೆ(8 ನೇ ತರಗತಿಯಿಂದ 10 ನೇ ತನಕ) ರೂ .3,000 / - ಪಿಯುಸಿ / ಐಟಿಐ / ಡಿಪ್. / ಟಿಸಿಎಚ್ ರೂ. 4,000 / - ಪದವಿ ಕೋರ್ಸ್‌ಗಳು ರೂ. 5,000 / - ಸ್ನಾತಕೋತ್ತರ ಕೋರ್ಸ್ಗಳು. ರೂ. 6,000 / - ಮತ್ತು ಎಂಜಿನಿಯರಿಂಗ್ / ವೈದ್ಯಕೀಯ. ರೂ. 10,000 / - (ಸಾಮಾನ್ಯ ಅರ್ಹತೆಗೆ 50% ಮತ್ತು ಎಸ್‌ಸಿ / ಎಸ್‌ಟಿಗೆ 45% ಅಂಕಗಳನ್ನು ಅನ್ವಯಿಸುವ ಅರ್ಹತೆ. </p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>

                                        <li>

                                            <div class="alert-message">

                                                <p><b>ವೈದ್ಯಕೀಯ ನೆರವು:</b> 18-60 ವರ್ಷ ವಯಸ್ಸಿನ ಕಾರ್ಮಿಕರಿಗೆ, ಇಎಸ್ಐ ಯೋಜನೆಯಡಿ ಕನಿಷ್ಠ ರೂ. 1,000 / - ರಿಂದ ಗರಿಷ್ಠ ರೂ. 10,000 / - ಪ್ರಮುಖ ಕಾಯಿಲೆಗಳ ಚಿಕಿತ್ಸೆಗಾಗಿ, ಹೃದಯ ಶಸ್ತ್ರಚಿಕಿತ್ಸೆ, ಮೂತ್ರಪಿಂಡ ಕಸಿ, ಕ್ಯಾನ್ಸರ್ ಚಿಕಿತ್ಸೆ, ಆಂಜಿಯೋಪ್ಲ್ಯಾಸ್ಟಿ, ಕಣ್ಣು, ಮೂಳೆಚಿಕಿತ್ಸೆ, ಗರ್ಭಾಶಯದ ಕಾರ್ಯಾಚರಣೆಗಳು, ಗಾಲ್ ಗಾಳಿಗುಳ್ಳೆಯ ತೊಂದರೆಗಳು, ಮೂತ್ರಪಿಂಡದ ಕಲ್ಲು ತೆಗೆಯುವಿಕೆ, ಮಿದುಳಿನ ರಕ್ತಸ್ರಾವ, ಮತ್ತು ವೈದ್ಯಕೀಯ ತಪಾಸಣೆಗಾಗಿ ಪ್ರತಿ ಪ್ರಕರಣಕ್ಕೆ ರೂ. 500 / - ರಿಂದ ರೂ. 1000 / -    </p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>

                                        <li>

                                            <div class="alert-message">

                                                <p><b>ಅಪಘಾತ ಲಾಭ:</b> ರೂ. 1,000 / - ರಿಂದ ರೂ. 3,000 / - 18-60 ವರ್ಷದೊಳಗಿನ ಕಾರ್ಮಿಕರಿಗೆ, ಅಪಘಾತದ ಮೂರು ತಿಂಗಳೊಳಗೆ ವೈದ್ಯಕೀಯ ದಾಖಲೆಗಳೊಂದಿಗೆ ಅರ್ಜಿಯನ್ನು ಇಎಸ್ಐ ಕಾಯ್ದೆ, 1948 ರ ಅಡಿಯಲ್ಲಿ ಕಳುಹಿಸಲಾಗುವುದು. </p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>



                                        <li>

                                            <div class="alert-message">

                                                <p>ಅಂತ್ಯಕ್ರಿಯೆಯ ವೆಚ್ಚ ರೂ. 5,000 / - ಮರಣಿಸಿದವರ ಅವಲಂಬಿತರಿಗೆ ಪಾವತಿಸಬೇಕಾದ ಫಲಾನುಭವಿಯ ಸಾವಿಗೆ, ಆರು ತಿಂಗಳೊಳಗೆ ನಿಗದಿತ ಸ್ವರೂಪದಲ್ಲಿ ಅನ್ವಯಿಸಬೇಕು. </p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>



                                        <li>

                                            <div class="alert-message">

                                                <p>ವೈದ್ಯಕೀಯ ತಪಾಸಣೆ ಶಿಬಿರಗಳು: ರೂ. 30,000 / - ವರ್ಷಕ್ಕೊಮ್ಮೆ ಕಲ್ಯಾಣ ನಿಧಿಗೆ ಕೊಡುಗೆ ನೀಡುವ ಕಾರ್ಮಿಕರಿಗಾಗಿ ಟ್ರೇಡ್ ಯೂನಿಯನ್ / ಅಸೋಸಿಯೇಷನ್‌ಗಳು ಪ್ರಾಯೋಜಿಸುವ ವಾರ್ಷಿಕ ವೈದ್ಯಕೀಯ ತಪಾಸಣೆ ಶಿಬಿರಗಳಿಗೆ ಹಣಕಾಸಿನ ನೆರವು.</p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>



                                        <li>

                                            <div class="alert-message">

                                                <p>ವಾರ್ಷಿಕ ಕ್ರೀಡಾ ಚಟುವಟಿಕೆ: ರೂ. 50,000 / - ನೋಂದಾಯಿತ ಕಾರ್ಮಿಕ ಸಂಘಗಳು ವರ್ಷದಲ್ಲಿ ಒಂದು ಬಾರಿ ಜಿಲ್ಲಾ ಮಟ್ಟದಲ್ಲಿ ವಾರ್ಷಿಕ ಕ್ರೀಡಾ ಚಟುವಟಿಕೆಗಳಿಗೆ ಹಣಕಾಸಿನ ನೆರವು.</p>

                                            </div>

                                            <div class="devider"></div>

                                        </li>

                                    </ul>



                                </div>



































                            </div>

                        </div>

                        <div id="report" class="col-md-12">

                            <!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->



                            <<canvas id="myChart" width="500" height="200"></canvas>

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

                        <h4 class="help-title">ಸಹಾಯವಾಣಿ ಕೇಂದ್ರ</h4>

                        <div class="help-message-box">

                            <p>ತಾಂತ್ರಿಕ ಸಮಸ್ಯೆಗಳ ಪರಿಹಾರಕ್ಕಾಗಿ ಅಭ್ಯರ್ಥಿ ಸಹಾಯ ಕೇಂದ್ರವನ್ನು ಸಂಪರ್ಕಿಸಬಹುದು</p>

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

                <div id="footer" class="row">

                    <div class="col-md-4">

                        <h6 class="footer-title">ಬಗ್ಗೆ </h6>

                        <p>

                           ಕರ್ನಾಟಕ ರಾಜ್ಯದಲ್ಲಿ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣವನ್ನು ಸಂವರ್ಧನಗೊಳಿಸುವುದಕ್ಕೆ ಹಣಕಾಸು ಒದಗಿಸಲು ಮತ್ತು ಚಟುವಟಿಕೆಗಳನ್ನು ನಡೆಸುವುದಕ್ಕಾಗಿ ಒಂದು ನಿಧಿಯನ್ನು ಕರ್ನಾಟಕ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ನಿಧಿ ಅಧಿನಿಯಮ 1965 ರ ಅಡಿಯಲ್ಲಿ ಸ್ಥಾಪಿಸಲಾಗಿದೆ. 

                        </p>

                    </div>

                    <div class="col-md-4 ">

                        <h6 class="footer-title">ಪ್ರಮುಖ ವೆಬ್‌ಸೈಟ್‌ಗಳು</h6>

                        <ul class="footer-menu">

                            <li><a class=" js-scroll-trigger" target="_blank" href="https://klwb.karnataka.gov.in/">
ಕರ್ನಾಟಕ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ಮಂಡಳಿ</a></li>

                            <!-- <li><a class=" js-scroll-trigger" href="#">ಸಮುದಾಯ  ಭವನ ಆನ್‌ಲೈನ್ ಬುಕಿಂಗ್

                                </a></li> -->
                                <li><a class=" js-scroll-trigger" target="_blank" href="https://labour.karnataka.gov.in/english">
ಕಾರ್ಮಿಕ ಇಲಾಖೆ

                                    </a></li>

                            <li><a class=" js-scroll-trigger" href="#">ಕರ್ನಾಟಕ ರಾಜ್ಯ ಕಾರ್ಮಿಕ ಸಂಸ್ಥೆ

                                    </a></li>



                        </ul>

                    </div>

                    <div class="col-md-4">

                        <h6 class="footer-title">ನಮ್ಮನ್ನು ಸಂಪರ್ಕಿಸಿ</h6>

                        <p>

                            <span style="margin-bottom: -10px;display: block;"> ಕಲ್ಯಾಣ ಮಂಡಳಿ</span><br>

                            No.48, 2nd Floor,<br>

                           ಮಥಿಕರೆ ಮುಖ್ಯ ರಸ್ತೆ, ಆರ್‌ಟಿಒ ಕಚೇರಿ ಹತ್ತಿರ,<br>

                          ಯಶ್ವಂತ್ಪುರ, ಬೆಂಗಳೂರು - 560022.<br>

                            Ph: <a href="tel:+08023570266">080 23570266</a>/ <a href="tel:+08023575130">23575130</a>       <br>

                            Fax: 080 23475188<br>

                            

                            Email ID: <a href="mailto:welfarecommissioner123@gmail.com">welfarecommissioner123@gmail.com</a>

                        </p>

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
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
    <script>

        $('#tx').telex({

            messages: [

                {

                    id: 'msg1',

                    content: '  <h6> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು</span> <a href="">CLICK HERE</a><span class="brd"></span> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅರ್ಜಿ ಸಲ್ಲಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳಿಗಾಗಿ ಸಾರ್ವಜನಿಕರಿಗೆ ಅಧಿಸೂಚನೆ ನೀಡಲಾಗಿದೆ</span> <a href="">CLICK HERE</a>  <h6>   <h6> <span> ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು </span> <a href="">CLICK HERE</a>  <h6> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು</span> <a href="">CLICK HERE</a></h6>'

                },

                {

                    id: 'msg2',

                    content: ' <h6> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು</span> <a href="">CLICK HERE</a><span class="brd"></span> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅರ್ಜಿ ಸಲ್ಲಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳಿಗಾಗಿ ಸಾರ್ವಜನಿಕರಿಗೆ ಅಧಿಸೂಚನೆ ನೀಡಲಾಗಿದೆ</span> <a href="">CLICK HERE</a>  <h6>   <h6> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು</span> <a href="">CLICK HERE</a>  <h6> <span>ಆನ್‌ಲೈನ್‌ನಲ್ಲಿ ಅನ್ವಯಿಸಲು ಮಾರ್ಗಸೂಚಿಗಳು</span> <a href="">CLICK HERE</a></h6>',

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

            // data: [dat.application,dat.institute,dat.industry, dat.student, dat.male,dat.female,dat.sc, dat.st],

            data:[10,9,8,7.8,7,6,5,4],

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

</script>



<!--     <script>

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

    </script> -->

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