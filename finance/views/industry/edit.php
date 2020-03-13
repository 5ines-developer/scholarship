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
                    <div class="col s12 m3 l3 hide-on-med-and-down ">
                            <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <div class="title-list">
                                    <span class="list-title">Industry Add</span>
                                    <a href="<?php echo base_url('industries') ?>"  class="back-btn z-depth-1 waves-effect waves-ligh">Back</a>
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m12 l12">
                                            <form ref="form" @submit.prevent="formSubmit" action="<?php echo base_url('industry-edit/').$this->uri->segment(2); ?>" method="post">
                                                <div class="input-field col m10">
                                                    <input id="name" name="name" type="text" class="validate" v-model="name" @change="namecheck()" required="">
                                                    <label for="name">Industry Name</label>
                                                    <span class="helper-text red-text">{{nameError}}</span>
                                                </div>
                                                <div class="input-field col m6">
                                                    <input id="rno" name="rno" type="text" class="validate" v-model="regno" @change="regnocheck()" required="">
                                                    <label for="rno">Register Number</label>
                                                     <span class="helper-text red-text">{{noError}}</span>
                                                </div>
                                                <div class="input-field col sel-hr s12 m6">
                                                    <select name="act" class="" v-model="act" required="">
                                                            <option value="" disabled selected>Choose Act Type</option>
                                                            <option value="1">Labour ACt</option>
                                                            <option value="2">Factory ACt</option>
                                                        </select>
                                                    <label>Act Type</label>
                                                </div>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">



                                               
                                                <div class="input-field col s12">
                                                    <button class="waves-effect waves-light hoverable btn-theme btn">Submit</button>
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


        <!-- End Body form  -->
        <section>

        </section>

        <!-- footer -->

        <?php $this->load->view('include/footer'); ?>
        
        <!-- End footer -->
    </div>



    <!-- scripts -->
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/axios.min.js "></script>
    <script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js "></script>
    <?php $this->load->view('include/msg'); ?>
    <script>
        $(document).ready(function() {
            $('.sid-m >.collapsible-body').css({
                display: 'block',
            });
        });
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
                name:'<?php echo (!empty($result->name))?$result->name:''; ?>',
                nameError:'',
                regno:'<?php echo (!empty($result->reg_id))?$result->reg_id:''; ?>',
                noError:'',
                act:'<?php echo (!empty($result->act))?$result->act:''; ?>',

            },

            methods: {
                namecheck(){
                    this.nameError='';
                    const formData = new FormData();
                    formData.append('name',this.name);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                    axios.post('<?php echo base_url('industry/namecheck') ?>',formData)
                    .then(response =>{
                        if(response.data == 1){
                            this.nameError = 'Industry Already Exist!';
                        }
                    }).catch(error => {
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })

                },
                regnocheck(){
                    this.noError='';
                    const formData = new FormData();
                    formData.append('regno',this.regno);
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                    axios.post('<?php echo base_url('industry/regcheck') ?>',formData)
                    .then(response =>{
                        if(response.data == 1){
                            this.noError = 'Register Number Already Exist!';
                        }

                    }).catch(error => {
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })

                },
                formSubmit() {
                if ((this.noError == '') && (this.nameError == '')) {
                    this.$refs.form.submit();
                }
            }
                
            }
        })
    </script>
</body>

</html>