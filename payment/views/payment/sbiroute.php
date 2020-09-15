<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>

    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
</head>
<body>


<?php 

        $price     = round($res['price']);
        $interest  = $res['interest'];
        $tot       = (int)$price + (int)$interest;
        $reg_no    = $res['comp_reg_id'];
        $pyear     = $res['year'];
        $ordId     = $res['pay_id'];

        $sucurl = base_url('payments/success?item=').$ordId;
        $failurl = base_url('make-payment?item=').$ordId;
        $key = "A7C9F96EEE0602A61F184F4F1B92F0566B9E61D98059729EAD3229F882E81C3A";

        // https://test.sbiepay.sbi/secure/fail.jsp|SBIEPAY
        

        $request ="1000112|DOM|IN|INR|".$tot."|".$pyear."|".$sucurl."|".$failurl."|https://test.sbiepay.sbi/secure/fail.jsp|SBIEPAY|".$reg_no."|NB|ONLINE|ONLINE";

        // //requestparameter = MerchantId | OperatingMode | MerchantCountry | MerchantCurrency | PostingAmount | OtherDetails | SuccessURL | FailURL | AggregatorId | MerchantOrderNo | MerchantCustomerID | Paymode | Accesmedium | TransactionSource

        require_once APPPATH .'AES128_php.php'; 
        $AESobj=new AESEncDec();
        $EncryptTrans = $AESobj->encrypt($request,$key);
        $EncryptTrans = str_replace("\n"," ",$EncryptTrans);
        ?>
        <!-- <form id="paygate" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
            <input type="hidden" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
            <input type="hidden" name="merchIdVal" value ="1000112"/>
            <input type="hidden" name="submit" value="Submit" class="btn-sub btn-p  z-depth-1 waves-effect waves-light">
        </form> -->

        <form id="myform" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
            <input type="hidden" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
            <input type="hidden" name="merchIdVal" value ="1000112"/>
        </form>

         <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
        <script>
            $(window).on('load', function () {
                $("#myform").submit(); 
                $('.btn-sub').click();
            });
        </script>


</body>

</html>

