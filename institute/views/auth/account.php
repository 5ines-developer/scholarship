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
                    <div class="col s12 m3 hide-on-small-only">
                        <?php $this->load->view('include/menu'); ?>
                    </div> <!-- End menu-->

                    <div class="col s12 m9">
                        <div class="card">
                            <div class="card-content">
                                <div class="row m0">
                                    <div class="app-detail-items">
                                        <div class="col s12">
                                            <div class="app-detail-item">
                                                <div class="app-item-heading">
                                                    <p>INSTITUTE DETAILS</p> 
                                                </div> 
                                                <div class="app-item-body pl15 pr15">
                                                    <div class="row ">
                                                        <a href="#edtModal" class="waves-effect waves-light editButton modal-trigger"> <i class="material-icons tiny"> edit </i> Edit</a>
                                                        <div class="col s12 l4">
                                                            <ul>
                                                                <li>
                                                                    <p class="app-item-content-head">Institute Name</p> 
                                                                    <p class="app-item-content"><?php echo $info->name ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Institute Reg.No</p> 
                                                                    <p class="app-item-content"><?php echo $info->reg_no ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Email</p> 
                                                                    <p class="app-item-content"><?php echo $info->email ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Phone</p> 
                                                                    <p class="app-item-content"><?php echo $info->phone ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Principal Name </p> 
                                                                    <p class="app-item-content"><?php echo $info->principal ?></p>
                                                                </li>
                                                            </ul>
                                                        </div> 
                                                        <div class="col s12 l8">
                                                            <ul>
                                                                <li>
                                                                    <p class="app-item-content-head">District</p> 
                                                                    <p class="app-item-content"><?php echo $info->district ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Taluk</p> 
                                                                    <p class="app-item-content"><?php echo $info->taluk ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Pin Code</p> 
                                                                    <p class="app-item-content"><?php echo $info->pin ?></p>
                                                                </li> 
                                                                <li>
                                                                    <p class="app-item-content-head">Full address Address</p> 
                                                                    <p class="app-item-content"><?php echo $info->address ?></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6">
                                                <div class="app-detail-item">
                                                    <div class="app-item-heading">
                                                        <p>Registration Certificate</p>
                                                    </div> 
                                                    <div class="app-item-body">
                                                        <div class="row m0">
                                                            <div class="col s12">
                                                                <ul>
                                                                    <li>
                                                                        <div class="app-item-content">
                                                                            <img class="responsive-img" src="<?php echo base_url().$info->reg_certification ?>" alt="">
                                                                            <button class="upload-btn "><i class="material-icons ">backup </i> Upload</button>
                                                                        </div>
                                                                    </li> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s12 m6">
                                                <div class="app-detail-item">
                                                    <div class="app-item-heading">
                                                        <p>Principal Signature</p>
                                                    </div> 
                                                    <div class="app-item-body">
                                                        <div class="row m0">
                                                            <div class="col s12">
                                                                <ul>
                                                                    <li>
                                                                        <div class="app-item-content">
                                                                            <img class="responsive-img" src="<?php echo base_url().$info->priciple_signature ?>" alt="">
                                                                            <button class="upload-btn "><i class="material-icons ">backup </i> Upload</button>
                                                                        </div>
                                                                    </li> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s12 m6">
                                                <div class="app-detail-item">
                                                    <div class="app-item-heading">
                                                        <p>Seal</p>
                                                    </div> 
                                                    <div class="app-item-body">
                                                        <div class="row m0">
                                                            <div class="col s12">
                                                                <ul>
                                                                    <li>
                                                                        <div class="app-item-content">
                                                                            <img class="responsive-img" src="<?php echo base_url().$info->seal ?>" alt="">
                                                                            <button class="upload-btn "><i class="material-icons ">backup </i> Upload</button>
                                                                        </div>
                                                                    </li> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End right board -->
                </div>
            </div>
        </section>


    <!-- End Body form  -->
    <div id="edtModal" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
    <!-- footer -->
        
    <?php $this->load->view('include/footer'); ?>
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<?php $this->load->view('include/msg'); ?>
<script>
   


    var app = new Vue({
        el: '#app',
        data: {
          
        },  
        mounted(){
           
        },
        methods:{
           
        }
    })
</script>
</body>
</html>