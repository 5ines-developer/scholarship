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
        <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col offset-l1 s12 m10 l10">
                        <div class="download">
                        </div>
                        <div class="fund-reg">
                            <div class="title-track">
                                <img width="100px" src="<?php echo $this->config->item('web_url') ?>assets/img/logo.png" alt="">
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




                                       <?php $number = $result->price;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ? "." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
  echo $result . "Rupees  " ;
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