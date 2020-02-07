<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                            <form action="" method="POST">
                                <div class="pay-form z-depth-1">
                                    <div class="pay-ff">
                                        <p style="font-style: italic;font-weight: 700;">Payment Form</p>
                                    </div>
                                    <div class="form-pay">
                                        <div class="row">
                                            <div class="col l5 m6 s12">
                                                <div class="input-field">
                                                    <!-- <select name="p_cc">
                                                        <option value="" disabled selected>Company Category</option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select> -->
                                                    <input id="category" readonly name="category" type="text" class="validate" required value="<?php echo (!empty($act))?$act:''; ?>">
                                                    <label for="category">Company Category</label>
                                                </div>
                                            </div>
                                            <div class="col l3 m5 s12">
                                                <div class="input-field">
                                                    <input id="reg_no" readonly name="reg_no" type="text" class="validate" required value="<?php echo (!empty($info->reg_id))?$info->reg_id:''; ?>">
                                                    <label for="reg_no">Reg No</label>
                                                </div>
                                            </div>
                                            <div class="col l3 m5 s12">
                                                <div class="input-field">
                                                    <select name="p_year" v-model="year"  @change="countPrice()">
                                                    <option value="" disabled selected>Year</option>
                                                    <?php

                                                    for ($i=2000; $i <= date('Y') ; $i++) { 
                                                        echo '<option value="15-1-'.$i.'">'.$i.'</option>';
                                                    }
                                                    
                                                    ?>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col l11 m10 s12">
                                                <div class="input-field">
                                                <input id="company" readonly name="company" type="text" class="validate" required value="<?php echo (!empty($info->indNAme))?substr($info->indNAme,0,100):''; ?>">
                                                    <label for="company">Company Name</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col l3 m6 s12">
                                                <div class="input-field">
                                                <input id="district" readonly name="district" type="text" class="validate" required value="<?php echo (!empty($info->district))?$info->district:''; ?>">
                                                <label for="district">District</label>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col l3 m6 s12">
                                                <div class="input-field">
                                                    <input id="taluk" readonly name="taluk" type="text" class="validate" required value="<?php echo (!empty($info->taluk))?$info->taluk:''; ?>">
                                                    <label for="taluk">Taluk</label>
                                                </div>
                                            </div> -->
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cmale" name="p_cmale" type="number" @change="countPrice()" class="validate" required v-model="male">
                                                    <label for="p_cmale">Male Employees</label>
                                                </div>
                                            </div>
                                            <div class="col l5 m5 s12">
                                                <div class="input-field">
                                                    <input id="p_cfemale" name="p_cfemale" type="number" @change="countPrice()"  class="validate" required v-model="female">
                                                    <label for="p_cfemale">Female Employees</label>
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
                                            <div class="btn-pay">
                                                <a href="<?php echo base_url('dashboard')?>" class="btn-sub btn-p rests z-depth-1 waves-effect waves-light">Back</a>
                                                <button class="btn-sub btn-p  z-depth-1 waves-effect waves-light">
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



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
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

        var app = new Vue({
            el: '#app',
            data: {
                male:'',
                female:'',
                employees:'',
                uprice:'',
                amount:'',
                interest:'',
                total:'',
                year:'',

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
                }
                
                
                    
            }
        })
    </script>
</body>

</html>