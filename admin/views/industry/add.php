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
                    <div class="col s12 m3 l3 hide-on-med-and-down ">
                            <?php $this->load->view('include/menu'); ?>
                    </div>
                    <!-- End menu-->

                    <div class="col s12 m12 l8">
                        <div class="card  darken-1">
                            <div class="card-content bord-right">
                                <div class="title-list">
                                    <span class="list-title left">Industry Add</span>'
                                    <div class="row m0 right">
                                        <a href="#import"  class="bulk-btn z-depth-1 white-text green darken-3 waves-effect waves-ligh modal-trigger">Bulk Upload</a>
                                        <a href="<?php echo base_url('industry') ?>"  class="back-btn z-depth-1 waves-effect waves-ligh">Back</a>
                                    </div>
                                </div>
                                <div class="board-content">
                                    <div class="row m0">
                                        <div class="col s12 m12 l12">
                                            <form ref="form" @submit.prevent="formSubmit" action="<?php echo base_url('industry-add') ?>" method="post">
                                                <div class="input-field col m10">
                                                    <input id="name" name="name" type="text" placeholder="Enter full name with adress & Pincode" class="validate" v-model="name" @change="namecheck()" required="" required="">
                                                    <label for="name">Industry Name</label>
                                                    <span class="helper-text red-text">{{nameError}}</span>
                                                </div>
                                                <div class="input-field col m6">
                                                    <input id="rno" name="rno" type="text" class="validate" v-model="regno" @change="regnocheck()" required="">
                                                    <label for="rno">Register Number</label>
                                                     <span class="helper-text red-text">{{noError}}</span>
                                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                <div class="input-field col sel-hr s12 m6">
                                                    <select name="act" class="" required="">
                                                            <option value="" disabled selected>Choose Act Type</option>
                                                            <option value="1">Shops and Commercial Act</option>
                                                            <option value="2">Factory ACt</option>
                                                            <option value="3">Others</option>
                                                        </select>
                                                    <label>Act Type</label>
                                                </div>
                                                
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
       <div id="import" class="modal">
            <div class="modal-content company-mc">
                <h4>Industry Bulk Upload</h4>
                <a href="#!" class="modal-close">
                    <i class="material-icons cc-close">close</i>
                </a>
            </div>
            <div class="modal-footer company-mf">
                <form action="<?php echo base_url('upload-industry') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-file">
                        <div class="left p5">
                            <a href="<?php echo $this->config->item('web_url') ?>assets/docs/company-bulk-upload.xlsx">Download Sample excel</a>
                        </div>
                        <div class="row">
                            <div class="col l12 s12 m12">
                                <div class="file-field input-field col l12 m0 upload-fil">
                                    <div class="btn ">
                                        <span>File</span>
                                        <input type="file" name="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" placeholder="Import the excel file here" type="text" required="">
                                    </div>
                                </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="col l12">
                                    <div class="ff-inp">
                                        <p><b>Note:</b>File should be in .csv / .xsl format Size should be not more than 200KB</p>
                                    </div>
                                </div>
                                <div class="col l12 m12 s12">
                                    <center> <button class="btn-sub z-depth-1 waves-effect waves-light">
                                        Submit</button></center>
                                </div>
                            </div>
                        </div>


                    </div>

                </form>

            </div>
        </div>

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
            $('.modal').modal();
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
                name:'',
                nameError:'',
                regno:'',
                noError:'',

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