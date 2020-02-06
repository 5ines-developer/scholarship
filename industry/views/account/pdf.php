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
        body { font-family: 'Baloo Tamma',  sans-serif; font-size:15px}
        .center{ text-align:center }
        p{margin:0px;}
        .left{width:50%; float:left}
        .clearfix{clear:both}
         .mt10{
            margin-top:10px
        }
        .dotted-line{
            font-weight:bold;
            font-size:14px
        }
        .dashed-line{
            font-weight:600;
            font-size:13px
        }
        .bold{
            font-weight:bold
        }
        #shcoolapp{
            width:80%;
            margin:auto;
        }
    </style>
</head>
<body>
<div style="border:1px solid black; padding: 100px 0px; ">
<div class="container z-depth-2 mt15" id="shcoolapp">
    <div class="row">
        <div class="col m10 push-m1">
            <div class="col s12">
                <p class="bold center">ಭಾಗ-2</p>
                <p class="bold center">ಉದ್ಯೋಗ ಪ್ರಮಾಣ ಪತ್ರ</p>
                <p class="center">(ಉದ್ಯೋಗಾದಾತರು ಭರ್ತಿಮಾಡಿ ತಪ್ಪದೆ ದೃಡೀಕರಿಸವುದು)</p><br>
            </div>
            <div class="col s12">
                <div>
                    <?php if ($info->name == '1') {
                        $par = $info->father_name;
                    }elseif ($info->name == '2') {
                       $par = $info->mothor_name;
                    } 

                    $num = $info->msalary;
                    $num    = ( string ) ( ( int ) $num );
   
            if( ( int ) ( $num ) && ctype_digit( $num ) )
            {
                $words  = array( );
               
                $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
               
                $list1  = array('','one','two','three','four','five','six','seven',
                    'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                    'fifteen','sixteen','seventeen','eighteen','nineteen');
               
                $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                    'seventy','eighty','ninety','hundred');
               
                $list3  = array('','thousand','million','billion','trillion',
                    'quadrillion','quintillion','sextillion','septillion',
                    'octillion','nonillion','decillion','undecillion',
                    'duodecillion','tredecillion','quattuordecillion',
                    'quindecillion','sexdecillion','septendecillion',
                    'octodecillion','novemdecillion','vigintillion');
               
                $num_length = strlen( $num );
                $levels = ( int ) ( ( $num_length + 2 ) / 3 );
                $max_length = $levels * 3;
                $num    = substr( '00'.$num , -$max_length );
                $num_levels = str_split( $num , 3 );
               
                foreach( $num_levels as $num_part )
                {
                    $levels--;
                    $hundreds   = ( int ) ( $num_part / 100 );
                    $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                    $tens       = ( int ) ( $num_part % 100 );
                    $singles    = '';
                   
                    if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); 
                } 

                    $commas = count( $words ); 
                    if( $commas > 1 )
                {
                    $commas = $commas - 1;
                }
               
                $words  = implode( ', ' , $words );
               
                //Some Finishing Touch
                //Replacing multiples of spaces with one space
                $words  = trim( str_replace( ' ,' , ',' , trim( ucwords( $words ) ) ) , ', ' );
                if( $commas )
                {
                    $words  = str_replace( ',' , ' and' , $words );
                }
                
            }
            else if( ! ( ( int ) $num ) )
            {
                $words ='';
            }
                    

                    

                    ?>

                    <p>ಕುಮಾರ/ಕುಮಾರಿ <span class="dotted-line"> &nbsp; <?php echo (!empty($info->name))?$info->name:''; ?> &nbsp; </span> ವಿದ್ಯಾರ್ಥಿಯ  ತಂದೆ/ತಾಯಿ/ಪೋಷಕರು ಆದ
                                  ಶ್ರೀ/ ಶ್ರೀಮತಿ <span class="dotted-line">  &nbsp; <?php echo (!empty($info->par))?$info->par:''; ?> &nbsp; </span> ಇವರು <span class="dotted-line">&nbsp;  <?php echo (!empty($info->indName))?$info->indName:''; ?> &nbsp; </span>
                                ಸಂಸ್ಥೆಯಲ್ಲಿ  ಕೆಲಸಮಾಡುತಿದ್ದು, ಇವರ ತಿಂಗಳ ಸಂಬಳ (ಎಲ್ಲಾ ಭತ್ಯೆಗಳು ಸೇರಿದಂತೆ)  ರೂ<span class="dotted-line"> &nbsp; <?php echo (!empty($info->msalary))?$info->msalary:''; ?> &nbsp; </span> (ಅಕ್ಷರಗಳಲ್ಲಿ) <span class="dotted-line">&nbsp;  <?php echo (!empty($words))?$words:''; ?> &nbsp;</span> ಇರುತ್ತದೆ.
                            2018  ನೇ ಡಿಸೆಂಬರ್ ತಿಂಗಳ ವೇತನದಲ್ಲಿ ವಂತಿಕೆ ಕಡಿತ ಮಾಡಿ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ಮಂಡಳಿಗೆ ಪಾವತಿಸಲಾಗಿದೆಯೆಂದು ದೃಡೀಕರಿಸಲಾಗಿದೆ.</p><br>
                </div>
                <p class="bold center"><?php echo date('Y') ?>ನೇ,ಕ್ಯಾಲೆಂಡರ್ ವರ್ಷಕ್ಕೆ ಕಾರ್ಮಿಕ ಕಲ್ಯಾಣ ನಿಧಿಗೆ ವಂತಿಕೆ ಪಾವತಿಸಿರುವ ವಿವರ.</p><br>
                        <div>
                            <p>ವಂತಿಕೆ ಪಾವತಿಸಿದ ಮೊತ್ತ:  <span class="dotted-line"> <?php echo (!empty($words))?$words:''; ?>  </span> ದಿನಾಂಕ:  <span class="dotted-line">  <?php echo (!empty($words))?$words:''; ?> </span> ಚೆಕ್/ಡಿಡಿ/ಚಲನ್ ಸಂಖ್ಯೆ  <span class="dotted-line">  <?php echo (!empty($words))?$words:''; ?> </span> </p>
                        </div>
            </div><br>

            <div class="col s12 m5 foo-address left">                
                <p>ಸ್ಥಳ: <span class="dashed-line"> <?php echo $info->talqName ?> </span></p>
                <p>ದಿನಾಂಕ: <span class="dashed-line"> <?php echo date('d M, Y') ?> </span></p>
                <p>ದೂರವಾಣಿ ಸಂಖ್ಯೆ/ಮೊಬೈಲ್ ಸಂಖ್ಯೆ: <span class="dashed-line"> <?php echo $info->parent_phone  ?> </span></p>
            </div>
            <div class="col s12 m5 push-m2 foo-address left">
                <p>ಉದ್ಯೋಗ ಸಂಸ್ಥೆಯ ಅಧಿಕೃತ ಅಧಿಕಾರಿ ಪಧಾನಾಮ/ಸಹಿ ಮತ್ತು ಮೊಹರು </p>
                <br>
                <span class="dashed-line"> <?php echo $img->name  ?> </span>
                <img src="<?php echo base_url().$img->sign  ?>" width="100px" class="mr30" alt="">
                <img src="<?php echo base_url().$img->seal  ?>" width="100px" alt="">
            </div>
            <div class="clearfix"></div>
            
        </div>
    </div>
</div>
</div>

</body>
</html>