<?php
$this->ci =& get_instance();
$this->load->library('Encryption_url');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link  rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/material-icons.css">
</head>

<body>
    <div id="app">
        <?php $this->load->view('include/header'); ?>
        <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col offset-l1 s12 m10 l10">
                        <div class="download">
                            <a href="<?php $id = $this->ci->encryption_url->safe_b64encode($result->id); echo base_url('payments/receipts/').$id ?>" class="rec-down waves-effect waves-light">Download</a>
                        </div>
                        <div class="fund-reg">
                            <div class="title-track">
                                <h5>K.A.S Letter(60606)</h5>
                                <h6>Payment Receipt</h6>
                            </div>
                            <div class="date-fund">
                                <p>Karnataka Labour Welfare Board Office</p>
                                <p><b>Place : </b>Bangalore</p>
                                <p><b>Date : </b><?php echo date('d M, Y',strtotime($result->payed_on)) ?></p>
                            </div>
                            <div class="receipt-detail">

                                <ul>
                                    <li>Recieved From <span style="text-decoration:underline;font-weight: 400;"><?php echo (!empty($result->comp))?$result->comp:''; ?></span> </li>
                                    <li>Karnataka Labour Welfare Board scholarship contribution fund for the Calender year  <span style="text-decoration:underline;font-weight: 400;"><?php echo (!empty($result->year))?$result->year:''; ?></span></li>
                                    <li>Amount Rs: <span style="text-decoration:underline;font-weight: 400;"> <?php echo (!empty($result->price))?$result->price:''; ?> </span> </li>
                                    <li>Rs in Words <span style="text-decoration:underline;font-weight: 400;"> 
                                        <?php $num = $result->price;
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
                                                  } }
                                              else if( ! ( ( int ) $num ) )
                                              {
                                                  $words ='';
                                              }

                                              echo $words;


                                               ?>

                                               </span> </li>

                                    <li><small>This is computer generated Reciept signature is not required.</small></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Body form  -->

        <!-- End Body form  -->
        <!-- footer -->
         <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                preventScrolling: false
            });
        });

        var app = new Vue({
            el: '#app',
            data: {
                disabled: false

            },

            methods: {


            }
        });
    </script>
</body>

</html>