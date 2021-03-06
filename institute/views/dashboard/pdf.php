<!DOCTYPE html>
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>Scholarship</title>
 
    

    <style>
        /* @font-face { font-family: Blanch; src: url('../../assets/fonts/Lohit-Kannada.ttf') format('truetype'); font-style: normal; font-weight:900; }
         */
        @import url('https://fonts.googleapis.com/css?family=Baloo+Tamma&display=swap');
        body { 
            font-family: 'Baloo Tamma', Arial,  sans-serif; 
           
        }
        .center{ text-align:center }
        p{margin:0px;}
        .left{width:50%; float:left}
        .clearfix{clear:both}
        #shcoolapp{
            width:80%;
            margin:auto;
        }
        .dotted-line{
            font-weight:bold;
            font-size:15px
        }
        .dashed-line{
            font-weight:600;
            font-size:14px
        }
        .bold{
            font-weight:bold
        }
        ol{
            padding-left:15px;
            margin:50px 0px
        }
        .mt10{
            margin-top:10px
        }
    </style>
</head>
<body class="">
<div style="border:1px solid black; padding: 100px 0px; ">
    <div class="container z-depth-2 mt15" id="shcoolapp">
        <div class="row">
            <div class="col m10 push-m1">
                <div class="col s12">
                    <p class="bold center">ಭಾಗ-3</p>
                    <p class="bold center">ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಯ ಮುಖ್ಯಸ್ಥರ ಪ್ರಮಾಣ ಪತ್ರ</p>
                    <p class="center">(ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಯವರು ಭರ್ತಿ ಮಾಡಿ ತಪ್ಪದೇ ದೃಡೀಕರಿಸವುದು)</p>
                </div>
                <div class="col s12">
                    <ol>
                        <li>
                            <div>
                                <p>ಕುಮಾರ/ಕುಮಾರಿ <span class="dotted-line"> <?php echo $info->name ?> </span> ಇವರು ಕಳೆಧ ಸಾಲಿನಲ್ಲಿ
                                ನಡೆದ <span class="dotted-line"> <?php echo $info->prv_class ?> </span> ತರಗತಿಯ ಪರೀಕ್ಷೆಯಲ್ಲಿ ಶೇಕಡಾ <span class="dotted-line"> <?php echo $info->prv_marks ?>% </span>  ಅಂಕಗಳನ್ನು
                                ಪಡೆದ್ದು   ತೇರ್ಗಡೆಯಾಗಿರುತಾರೆ.</p>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p><?php echo date('Y', strtotime('-1 years')).'-'.date('Y')?>ನೇ ಶೈಕ್ಷಣಿಕ ಸಾಲಿನಲ್ಲಿ <span class="dotted-line"> <?php echo (!empty($info->gradutions))?$info->gradutions.'&nbsp;&nbsp;':'';  echo (!empty($info->corse))?$info->corse.'&nbsp;&nbsp;':'';  echo (!empty($info->cLass))?$info->cLass.'&nbsp;&nbsp;':''; ?> </span> ತರಗತಿಯಲ್ಲಿ ವ್ಯಾಸಂಗ ಮಾಡುತ್ತಿದ್ದಾರೆಂದು ದೃಡೀಕರಿಸಲಾಗಿದೆ.</p>
                            </div>
                        </li>
                    </ol>
                </div>
                <div class="col s12 m5 foo-address left">
                    
                    <p>ಜಿಲ್ಲೆ: <span class="dashed-line"> <?php echo $info->dst ?> </span></p> 
                    <p>ಸ್ಥಳ: <span class="dashed-line"> <?php echo $info->tlk ?> </span></p>
                    <p>ದಿನಾಂಕ: <span class="dashed-line"> <?php echo date('d M, Y',strtotime($info->schl_approve)); ?> </span></p>
                    <p>ದೂರವಾಣಿ ಸಂಖ್ಯೆ (STD CODE ಸಹಿತ): <span class="dashed-line"> <?php echo $info->schoolPhone  ?> </span></p>
                </div>
                <div class="col s12 m5 push-m2 foo-address left">
                    <img src="<?php echo base_url('show-images/').$img->priciple_signature ?>" width="80px" class="mr30" alt="">
                    <img src="<?php echo base_url('show-images/').$img->seal ?>" width="80px" alt="">
                    <p class="mt10">ಮುಖ್ಯೋಪಾಧ್ಯಾರ/ಪ್ರಾಂಶುಪಾಲರ ಸಹಿ ಹಾಗು ಮೊಹರು</p>
                    <br><br>
                </div>
                <div class="clearfix"></div>
                <div class="col s12 center foo-address"><p>( ವಿ.ಸೂ: ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಯ ಪೂರ್ಣ ವಿಳಾಸವುಳ್ಳ ಮೊಹರು ತಪ್ಪದೆ ಹಾಕುವುದು. )</p></div>
            </div>
        </div>
    </div>

</div>

</body>
</html>