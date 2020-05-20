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
        <section class="board hiegt-box">
            <div class="container-wrap1">
                <div class="row m0">
                    <div class="col s12 m3 hide-on-med-and-down">
                    <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <div class="title-list">
                                    <span class="list-title">Government Employee Add</span>
                                    <a href="<?php echo base_url('employee') ?>" class="back-btn z-depth-1 waves-effect waves-ligh right">Back</a>
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m12 l12">
                                            <form ref="form" @submit.prevent="checkForm" action="<?php echo base_url() ?>employee/update" method="post">
                                                <div class="input-field col m8">
                                                    <input id="em_name" name="em_name" required type="text" class="validate" value="<?php echo (!empty($result->name))?$result->name:''; ?>">
                                                    <label for="em_name">Employee Name</label>
                                                </div>
                                                <div class="input-field col m8">
                                                    <input id="email" readonly name="email" required type="email" class="validate" value="<?php echo (!empty($result->email))?$result->email:''; ?>">
                                                    <label for="email">Email</label>
                                                    <?php echo validation_errors(); ?>
                                                </div>
                                                <div class="input-field col m8">
                                                    <input id="phone" name="phone" required type="number" class="validate" v-model="phone" @change="mobileCheck">
                                                    <label for="phone">Phone</label>
                                                    <span class="helper-text red-text">{{mobileError}}</span><br>
                                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                <div class="col sel-hr s12 m8">
                                                    <label >Employee Designation</label>
                                                    <p class="mb10 mt10">
                                                        <label>
                                                            <input class="with-gap" name="designation" value="2" type="radio"  <?php echo ($result->type == '2')?'checked':''; ?> />
                                                            <span>Verification</span>
                                                        </label>
                                                        <label class="ml20">
                                                            <input class="with-gap" name="designation" value="3" type="radio"  <?php echo ($result->type == '3')?'checked':''; ?>/>
                                                            <span>Financial</span>
                                                        </label>
                                                        <label class="ml20">
                                                            <input class="with-gap" name="designation" value="4" type="radio" <?php echo ($result->type == '4')?'checked':''; ?> />
                                                            <span>Payment Officer</span>
                                                        </label>
                                                    </p>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $result->id ?>">
                                                <div class="input-field col s12">
                                                    
                                                    <button class="waves-effect waves-light hoverable btn-theme btn mr10">Submit</button>
                                                    <button class="waves-effect waves-light hoverable btn-theme btn" type="button">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End right board -->
                </div>
            </div>
        </section>


      

        <?php $this->load->view('include/footer'); ?>
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js"></script>
    <?php $this->load->view('include/msg'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.FormSelect.init(document.querySelectorAll('select'));
        });
        document.addEventListener('DOMContentLoaded', function() {
            var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
            var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
                constrainWidth: false,
                alignment: 'right'
            })
        });


        var app = new Vue({
            el: '#app',
            data: {
                mobileError: '',
                phone: '<?php echo (!empty($result->phone))?$result->phone:''; ?>',
                id:'<?php echo (!empty($result->id))?$result->id:''; ?>',

            },

            methods: {
                onFileChange(e) {
                    const file = e.target.files[0];
                    this.student.profile = URL.createObjectURL(file);
                },
                mobileCheck(){
                    this.mobileError='';
                    if (this.phone.length != 10) {
                        this.mobileError = 'Mobile number must be 10 digits!';
                    }else{
                        this.mobileError='';
                        const formData = new FormData();
                        formData.append('phone',this.phone);
                        formData.append('id',this.id);
        formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                        
                        axios.post('<?php echo base_url('employee/mobile_check') ?>', formData)
                        .then(response => {
                            if (response.data == '1') {
                                this.mobileError = 'This Mobile number already exist!';
                            } else {
                                this.mobileError = '';
                            }

                        }).catch(error =>{
                            if (error.response) {
                                this.errormsg = error.response.data.error;
                            }
                        } )
                    }
                        
                },
                checkForm() {
                if ((this.mobileError == '')) {
                        this.$refs.form.submit();
                    }
                }
            }
        })
    </script>
</body>

</html>