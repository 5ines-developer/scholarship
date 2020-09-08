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
    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <style>
        .razorpay-payment-button{display: none;}
    </style>
</head>

<body>
    <div id="app">
    <?php $this->load->view('include/header'); ?>
        <!-- Body form  -->
        <section class="board">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col s12 m12">
                        <div class="payment-reg">
                            <div class="pay-title">
                                <p style="font-style: italic;font-weight: 700;">PAYMENT</p>
                            </div>
                            <!-- address detail -->
                            <div class="addre-pp">
                                <div class="row">
                                    <div class="col l2 m3 s12">
                                        <img class="responsive-img add-logo" src="assets/image/logo.png" alt="Karnataka Labour Welfare Board">
                                    </div>
                                    <div class="col col l4 m5 s12">
                                        <div class="com-detail">
                                            <p><?php echo (!empty($info->indNAme))?$info->indNAme:''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col col l5 m5 s12">
                                        <div class="pay-date">
                                            <p><b>Date :</b><?php echo date('d M, Y') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="under-line"></div>
                            <!-- ref="form" @submit.prevent="formSubmit" -->
                            

                            <form action="#" method="post"  enctype="multipart/form-data" id="payment">
                                <div class="pay-form z-depth-1">
                                    <div class="pay-ff">
                                        <p style="font-style: italic;font-weight: 700;">Payment Form</p>
                                    </div>
                                    <div class="form-pay">
                                        <div class="row">
                                            <div class="col l5 m6 s12">
                                                <div class="input-field">
                                                    <input id="category" readonly name="category" type="text" class="validate" required v-model='category'>
                                                    <label for="category">Company Category</label>
                                                    <span class="helper-text red-text">{{cat_error}}</span>
                                                </div>
                                            </div>
                                            <div class="col l3 m5 s12">
                                                <div class="input-field">
                                                    <input id="reg_no" readonly name="reg_no" type="text" class="validate" required  v-model="reg_no">
                                                    <label for="reg_no">Reg No</label>
                                                    <span class="helper-text red-text">{{regError}}</span>
                                                </div>
                                            </div>
                                            <div class="col l3 m5 s12">
                                                <div class="input-field">
                                                    <select id="p_year" name="p_year" v-model="year"  @change="checkpayment()" required="" >
                                                    <option value="" disabled>Year</option>
                                                    <?php
                                                    for($i=date('Y'); $i>= 2000; $i--){ 
                                                        echo '<option value="15-1-'.$i.'">'.$i.'</option>';
                                                    }
                                                    
                                                    ?>
                                                    </select>
                                                    <span class="helper-text red-text">{{pay_check}}</span>
                                                    <span class="helper-text red-text yearError"></span>
                                                </div>
                                            </div>
                                            <div class="col l11 m10 s12">
                                                <div class="input-field">
                                                <input id="company" readonly name="company" type="text" class="validate" required v-model="company">
                                                    <label for="company">Company Name</label>
                                                    <span class="helper-text red-text">{{comError}}</span>
                                                </div>
                                            </div>

                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                            
                                            
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cmale" name="p_cmale" type="number" @change="countPrice()" class="validate" required v-model="male">
                                                    <label for="p_cmale">Male Employees</label>
                                                    <span class="helper-text red-text">{{maleError}}</span>
                                                </div>
                                            </div>
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cfemale" name="p_cfemale" type="number" @change="countPrice()"  class="validate" required v-model="female">
                                                    <label for="p_cfemale">Female Employees</label>
                                                    <span class="helper-text red-text">{{FemaleError}}</span>
                                                    <input type="hidden" name="price" v-model="vprice">
                                                    <input type="hidden" name="interest" v-model="vinterest">
                                                    <input type="hidden" name="pyear" v-model="pyear">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-for">
                                            <table class="responsive-table">
                                                <thead class="amt-tab">
                                                    <tr>
                                                        <th colspan="1">Company Name</th>
                                                        <th>Total no of Employees</th>
                                                        <th>Unit Price</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="amt-resu">
                                                    <tr>
                                                        <td colspan="1"><?php echo strlen($info->indNAme) > 50 ? substr($info->indNAme,0,60)."..." : $info->indNAme; ?></td>
                                                        <td>{{employees}}</td>
                                                        <td class="grey-text">60₹</td>
                                                        <td>{{amount}}</td>
                                                    </tr>
                                                    <tr class="wid-pp">
                                                        <td colspan="3">Interest</td>
                                                        <td>{{interest}}</td>
                                                    </tr>
                                                    <tr class="wid-pp1">
                                                        <td colspan="3"><b>Total</b></td>
                                                        <td>{{total}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="btn-pay"  v-bind:class="{ hide: hidden }">
                                                <a href="<?php echo base_url('dashboard')?>" class="btn-sub btn-p rests z-depth-1 waves-effect waves-light">Back</a>
                                                <button name="submit-pay" id="submit-pay" type="submit" class="btn-sub btn-p  z-depth-1 waves-effect waves-light">
                                                Pay now</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
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



 <?php

    if(isset($_POST['submit-pay']))
    {
        $category  = $_POST['category'];
        $p_cfemale = $_POST['p_cfemale'];
        $p_cmale   = $_POST['p_cmale'];
        $company   = $_POST['company'];
        $pyear    = $_POST['pyear'];
        $reg_no    = $_POST['reg_no'];
        $price     = round($_POST['price']);
        $interest  = $_POST['interest'];

        ?>
        <form action="<?php echo base_url('payments/submit_pay') ?>" method="post" enctype="multipart/form-data">
            <input name="category"  type="hidden"  value=" <?php echo $category?>">
            <input name="p_cfemale" type="hidden"  value=" <?php echo $p_cfemale?>">
            <input name="p_cmale" type="hidden" value=" <?php echo $p_cmale?>">
            <input name="company"  type="hidden" value=" <?php echo $company?>">
            <input name="p_year" type="hidden" value=" <?php echo $pyear?>">
            <input name="reg_no" value=" <?php echo $reg_no?>" type="hidden">
            <input name="prices" value=" <?php echo $price?>" type="hidden">
            <input name="interests" value=" <?php echo $interest?>" type="hidden">
            <input name="emails" value=" <?php echo $info->email ?>" type="hidden">
            <input name="phones" value=" <?php echo $info->mobile ?>" type="hidden">
            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!--   rzp_test_sxDgwwnBVvPNnz -->
            <!--   rzp_live_gzxNI1eiSwtWSH -->
                <script  src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="rzp_test_sxDgwwnBVvPNnz"
                    data-buttontext="Pay with Razorpay"
                    data-name="Karnataka labour welfare board"
                    data-description="Karnataka labour welfare board contribution."
                    data-image="<?php echo base_url('assets/images/logo.png')?>"
                    data-amount="<?php echo $price.'00' ?>"
                    data-prefill.contact="<?php echo $info->mobile ?>"
                    data-prefill.name=" <?php echo $company ?>"
                    data-prefill.email=" <?php echo $info->email ?>"
                    data-theme.color="#ef7920"
                ></script>
            <input type="hidden" value="Hidden Element" name="hidden">
        </form>
        <script type="text/javascript"> 
            window.onload = function(){
                document.getElementsByClassName('razorpay-payment-button').click();
            }
        </script>
<?php   } ?>


    

    <?php if(isset($_POST['submit-pay'])) {  ?>
    <script type="text/javascript">
        $(function(){
            $yearError = '';
            $year = $('#p_year').val();
            if ($year == '') {
                $('.yearError').append('<span>Please Select the Year</span>');
            }
            $('.razorpay-payment-button').attr('name','razorpay-payment-button');
            $('.razorpay-payment-button').click();
        });
    </script>
     <?php } ?>

    <script>
        <?php $this->load->view('include/msg'); ?>
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                preventScrolling: false
            });
        });

        $(document).ready(function($) {
            $("select[required]").css({display: "inline", height: 0, padding: 0, width: 0});
        });

        var app = new Vue({
            el: '#app',
            data: {
                category:'<?php echo (!empty($act))?$act:''; ?>',
                male:'',
                female:'',
                employees:'',
                uprice:'',
                amount:'',
                interest:'',
                total:'',
                year:'',
                company:'<?php echo (!empty($info->indNAme))?substr($info->indNAme,0,100):''; ?>',
                reg_no:'<?php echo (!empty($info->reg_id))?$info->reg_id:''; ?>',
                hidden:false,
                cat_error:'',
                regError:'',
                pay_check:'',
                comError:'',
                maleError:'',
                FemaleError:'',
                vprice:'',
                vinterest:'',
                pyear:'',
            },
            
            methods: {

                countPrice(){

                    let emp ='';
                    let male = parseInt(this.male);
                    let female = parseInt(this.female);

                    if(this.female == '' && this.male==''){
                        emp = '';
                    }else if (this.male == '' && this.female != '') {
                        emp = female;                        
                    }else if(this.female == '' && this.male != ''){
                        emp = male; 
                    }else{
                        emp = (male + female);
                    }
                    
                    var selDate = this.year;
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();                  
                    var spl = selDate.split("-");
                    var selyear = spl['2'];
                    var months;
                    months = (today.getFullYear() - selyear )  * 12;

                    var selday = spl['0'];
                    var day = ((today.getDate() - selday) );

                    if(selday >= day){
                        var days = selday - day;
                    }else{
                        var days = day - selday;
                    }


                    var price  = emp * 60;

                    if(months <= 3 && days >= 1){ 
                        var interest = (price * 12) / 100;
                    }else if(months >= '3'){
                        var interest = (price * 18) / 100;
                    }else{
                        var interest = '';
                    }

                    
                    this.employees = emp;
                    this.amount  =  emp * 60;
                    this.interest  =  interest;
                    this.total   =  interest + price;
                    this.vprice = this.total;
                    this.vinterest = this.interest;
                    this.pyear = selyear;
                },
                checkpayment(){
                    this.pay_check='';
                    var self=this;
                    var selDate = this.year;
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();                  
                    var spl = selDate.split("-");
                    var selyear = spl['2'];

                    const formData = new FormData();
                    formData.append('reg_no', this.reg_no);
                    formData.append('year', selyear);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                    axios.post('<?php echo base_url() ?>payments/checkpayment', formData)
                    .then(response => {
                        if(response.data != ''){
                           this.hidden=true;
                           this.pay_check = 'You have already paid the contribution for the selected year';
                        }else{
                            this.hidden=false;
                            this.countPrice();
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })
                },
                formSubmit(e){
                    e.preventDefault();

                    var selDate = this.year;
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();                  
                    var spl = selDate.split("-");
                    var selyear = spl['2'];

                    if(this.category == ''){ this.cat_error='Please Select the category'; }
                    if(this.reg_no == ''){ this.regError='Please Enter the register number'; }
                    if(this.selyear == ''){this.pay_check='Please Select the year'; }
                    if(this.company == ''){this.comError='Please Select the company'; }
                    if(this.male == ''){this.maleError='Please Enter the male employees count'; }
                    if(this.female == ''){this.FemaleError='Please Enter the female employees count'; }
                    if(this.FemaleError == '' && this.maleError =='' && this.cat_error=='' && this.regError=='' && this.comError=='' && this.pay_check=='' ){
                        const formData = new FormData();
                        formData.append('category', this.category);
                        formData.append('reg_no', this.reg_no);
                        formData.append('year', this.selyear);
                        formData.append('male', this.male);
                        formData.append('female', this.female);
                        formData.append('company', this.company);
                        formData.append('total', this.total);
                        formData.append('interest', this.interest);
                        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                        axios.post('<?php echo base_url() ?>payments/submit_pay', formData,
                        { headers: { 'Content-Type': 'multipart/form-data' } })
                        .then(response => {
                            console.log(response);
                        })
                        .catch(error => {
                            this.loader=false;
                            if (error.response) {
                                this.errormsg = error.response.data.error;
                            }
                        })
                    }
                }
            }
        })
    </script>
</body>

</html>