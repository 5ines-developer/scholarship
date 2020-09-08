<?php $this->ci =& get_instance(); ?>

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
    <link href="<?php echo $this->config->item('web_url') ?>assets/css/select2.css" rel="stylesheet" />

    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/select2.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
</head>

<body>


    <div id="modal1" class="modal">
        <div class="modal-content">
            <h6>Lorem ipsum </h6>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad hic ut quae, magni iure. Eaque expedita doloremque tenetur hic recusandae, voluptatum reprehenderit. Saepe alias eius quo, dicta ea? Quia, fuga.</p>
            <form ref="c_forms" @submit.prevent="contForm"  action="#" method="post">
                <p>
                  <label>
                    <input v-model="terms"  type="checkbox" name="terms" value="terms" required="" />
                    <span>I agree the Terms & Conditions</span>
                  </label>
                </p>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <span class="helper-text red-text">{{termError}}</span>
                <div class="btn-pay">
                    <button name="agree-pay" id="agree-pay" type="submit" class="btn-sub left m0 z-depth-1 waves-effect waves-light">Submit</button><br>
                </div>
            </form>
        </div>
    </div>



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
                                        <img class="responsive-img add-logo" src="<?php echo $this->config->item('web_url') ?>assets/image/logo.png" alt="Karnataka Labour Welfare Board">
                                    </div>
                                    <div class="col col l4 m5 s12">
                                        <div class="com-detail">
                                            <h5>Karnataka Labour Welfare Board Contribution</h5>
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
                            
                            <form action="#" method="post" enctype="multipart/form-data" id="payment">
                                <div class="pay-form z-depth-1">
                                    <div class="pay-ff">
                                        <p style="font-style: italic;font-weight: 700;">Payment Form</p>
                                    </div>
                                    <div class="form-pay">
                                        <div class="row">
                                            <div class="col l5 m6 s12">
                                                <div class="input-field">
                                                    <select id="category" name="category" class="select" required v-model='category'>
	                                                    <option value="" disabled>Company Category</option>
	                                                    <option value="1">Shops and Commercial Act</option>
                                                        <option value="2">Factory Act</option> 
	                                            		<option value="3">Others</option> 
                                                        <span class="helper-text red-text">{{cat_error}}</span>
                                                	</select>
                                                </div>
                                            </div>
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <select id="p_year" name="p_year" v-model="year" class="select" @change="checkpayment()" required="" >
                                                    <option value="" disabled>Year</option>
                                                    <?php for($i=date('Y'); $i>= 2000; $i--){ 
                                                        echo '<option value="15-1-'.$i.'">'.$i.'</option>';
                                                    } ?>
                                                    </select>
                                                    <span class="helper-text red-text">{{pay_check}}</span>
                                                    <span class="helper-text red-text yearError"></span>
                                                </div>
                                            </div>
                                            <div class="col l10 m10 s12">
                                                <div class="input-field">
                                                    <select id="company" name="company" v-model="company">
                                                    <option value="" disabled >Select Your Industry</option>
                                                    
                                                	</select>
                                                	<p class="inregister"></p>
                                                    <span class="helper-text red-text">{{comError}}</span>
                                                </div>

                                            </div>
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">


                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="c_conreg" type="text" readonly name="reg_no" class="c_conreg validate" required="" >
		                                            <input id="c_comp" type="hidden" name="c_comp" v-model="reg_no" >
		                                            <label class="crg" for="c_conreg">Industry Reg No</label>
                                                    <span class="helper-text red-text">{{regError}}</span>
                                                </div>
                                            </div>

                                            
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cmale" name="p_cmale" type="number" @change="checkpayment()" class="validate" required v-model="male">
                                                    <label for="p_cmale">Male Employees</label>
                                                    <span class="helper-text red-text">{{maleError}}</span>
                                                </div>
                                            </div>
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cfemale" name="p_cfemale" type="number" @change="checkpayment()"  class="validate" required v-model="female">
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
                                                        <td colspan="1" class="cname"></td>
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
                                            <div class="btn-pay" v-bind:class="{ hide: hidden }">
                                                <button type="reset" class="btn-sub btn-p rest z-depth-1 waves-effect waves-light">Reset</button>
                                                <button name="submit-pay" id="submit-pay" type="submit" class="btn-sub btn-p  z-depth-1 waves-effect waves-light"> Pay now</button>
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
        $pyear    = $_POST['pyear'];
        $reg_no    = $_POST['reg_no'];
        $price     = round($_POST['price']);
        $interest  = $_POST['interest'];
        // $terms  = $_POST['terms'];

        ?>
        <form action="<?php echo base_url('payments/submit_pay') ?>" method="post" enctype="multipart/form-data">
            <input name="category"  type="hidden"  value=" <?php echo $category?>">
            <input name="p_cfemale" type="hidden"  value=" <?php echo $p_cfemale?>">
            <input name="p_cmale" type="hidden" value=" <?php echo $p_cmale?>">
            <input name="p_year" type="hidden" value=" <?php echo $pyear?>">
            <input name="reg_no" value=" <?php echo $reg_no?>" type="hidden">
            <input name="prices" value=" <?php echo $price?>" type="hidden">
            <input name="interests" value=" <?php echo $interest?>" type="hidden">
            <!-- <input name="terms" value=" <?php echo $terms?>" type="hidden"> -->
           
            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            
                <script  src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="rzp_test_sxDgwwnBVvPNnz"
                    data-buttontext="Pay Now"
                    data-name="Karnataka labour welfare board"
                    data-description="Karnataka labour welfare board contribution."
                    data-image="<?php echo base_url('assets/images/logo.png')?>"
                    data-amount="<?php echo $price.'00' ?>"
                    data-prefill.contact="9876543210"
                    data-prefill.name="testing"
                    data-prefill.email="prathwi@5ine.in"
                    data-theme.color="#ef7920"
                ></script>
            <input type="hidden" value="Hidden Element" name="hidden">
        </form>
        <!--   rzp_test_sxDgwwnBVvPNnz -->
            <!--   rzp_live_gzxNI1eiSwtWSH -->
        <script type="text/javascript"> 
            window.onload = function(){
                document.getElementsByClassName('razorpay-payment-button').click();
            }
        </script>
<?php   }else if(empty($_POST['terms']))
    { 
        ?>
        <script>

        $(window).on('load', function () {
            var Modalelem = document.querySelector('.modal');
            var instance = M.Modal.init(Modalelem,{ dismissible: false });
            instance.open();
       });
        </script>

  <?php  }

   ?>


<?php if(isset($_POST['submit-pay'])) {  ?>
<script type="text/javascript">
    $(function(){
                $('.razorpay-payment-button').attr('name','razorpay-payment-button');
        $('.razorpay-payment-button').click();
    });
</script>
<?php } ?>
     <script>


       

        $(document).ready(function($) {
            $(".select").css({display: "inline", height: 0, padding: 0, width: 0});
            // $('.modal').modal();
        });

     	<?php $this->load->view('include/msg'); ?>
        $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';


    $('#company').select2({
        placeholder: 'Select a company',
        minimumInputLength: 1,
        ajax: {
            url: "<?php echo base_url('payments/search') ?>",
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term,[csrfName]: csrfHash // search term
                };
            },
            processResults: function (data) {
            	return {
            		results: data,
            	};


            },
                cache: true
            },
    });

     $(document).on('change','#company',function(){
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var cmp = $(this).val();
        $('#c_comp').val(cmp);
		var name  = $('#company option:selected').text();
		$('.cname').text(name);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('payments/companyChange') ?>",
            data: { comp : cmp, [csrfName]: csrfHash },
            dataType: "html",
            success: function (response) {
                if (response !='') {
                	$('#c_conreg').val(response);
                    $(".crg").addClass('active'); 
                    $('.inregister>span').remove();
                }else{
                    $('.inregister').append('<span class="helper-text red-text">Industry is not registered, please  register to make the payment</span>');
                    $('#c_conreg').val(response);
                    $(".crg").removeClass('active'); 
                }
            }
        });

    });
});
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                preventScrolling: false
            });
            var instances = M.FormSelect.init(document.querySelectorAll('.select'));
        });

        var app = new Vue({
            el: '#app',
            data: {
                category:'',
                male:'',
                female:'',
                employees:'',
                uprice:'',
                amount:'',
                interest:'',
                total:'',
                year:'',
                hidden:false,
                cat_error:'',
                regError:'',
                pay_check:'',
                comError:'',
                maleError:'',
                FemaleError:'',
                vprice:'',
                vinterest:'',
                company:'',
                reg_no:'',
                pyear:'',
                terms:'',
                termError:'',

            },
            
            methods: {
                contForm(e){
                    e.preventDefault();
                    this.termError = '';
                    if (this.terms == '') {
                       this.termError = 'Please agree the Terms & Conditions to make the payment'; 
                    }else{
                        var Modalelem = document.querySelector('.modal');
                        var instance = M.Modal.init(Modalelem,{ dismissible: false });
                        instance.close();
                        this.$refs.c_forms.submit();
                    }
                },
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

                    var reg_no = document.getElementById('c_conreg');
                    this.pay_check='';
                    var self=this;
                    var selDate = this.year;
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();                  
                    var spl = selDate.split("-");
                    var selyear = spl['2'];

                    const formData = new FormData();
                    formData.append('reg_no', reg_no.value);
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
                
                
                    
            }
        })
    </script>
</body>

</html>