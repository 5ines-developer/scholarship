<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
</head>
<body>
   <div id="app">
    
    <?php $this->load->view('include/header'); ?>

   <!-- form section -->
    <section class="bg pt30 pb30">
        <div class="container">
            <div class="row m0">
                <div class="col s12 m12 l10 push-l1">
                    <div class="card instreg">
                        <div class="card-content">
                            <div class="card-outer-heading">
                                Institution Registration
                            </div>

                            <div class="card-body">
                                <form action="<?php echo base_url() ?>register" method="post" enctype="multipart/form-data">
                                    <div class="input-field col m6">
                                        <input id="iname" name="iname" type="text" required class="validate">
                                        <label for="iname">Institute Name</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="email" name="email" type="email" required class="validate">
                                        <label for="email">Email</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="number" name="number" type="number" required class="validate">
                                        <label for="number">Phone Number</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="prname"    type="text" name="prname" required class="validate">
                                        <label for="prname">Principal Name</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <select name="taluk" required>
                                            <option value="" disabled selected>Select Taluk</option>
                                            <?php 
                                                if(!empty($taluk)){
                                                    foreach ($taluk as $key => $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->title.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label>Taluk</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <select name="district" required>
                                            <option value="" disabled selected>Select District</option>
                                            <?php 
                                                if(!empty($district)){
                                                    foreach ($district as $key => $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->title.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label>District</label>
                                    </div>

                                    <div class="input-field col m6">
                                        <input id="pin" name="pin" required type="number" class="validate">
                                        <label for="pin">Pin Code</label>
                                    </div>

                                    <div class="input-field col s12 m6">
                                        <textarea id="address" required name="address" class="materialize-textarea"></textarea>
                                        <label for="address">Full Address</label>
                                    </div>

                                    <!-- <div class="card-full-divider clearfix"></div> -->
                                    
                                    <div class="input-field col m6 ">
                                        <input id="regno" required name="regno" type="text" class="validate">
                                        <label for="regno">Registration Number</label>
                                    </div>
                                    
                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="regfile">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" placeholder="Upload Institution Reg file" type="text">
                                        </div>
                                    </div>

                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="signature">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" required placeholder="Upload Principal Signature" type="text">
                                        </div>
                                    </div>

                                    <div class="file-field input-field col s12 m6">
                                        <div class="btn ">
                                            <span>File</span>
                                            <input type="file" required name="seal">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" placeholder="Upload Institution seal" type="text">
                                        </div>
                                    </div>
                                    <div class="card-full-divider clearfix"></div>
                                    <div class="col s12">
                                       <button class="waves-effect waves-light hoverable btn-theme btn">Register</button>  
                                    </div>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php $this->load->view('include/footer'); ?>
    
   </div> 
              


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<?php $this->load->view('include/msg'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var instances = M.FormSelect.init(document.querySelectorAll('select'));
    });


    var app = new Vue({
        el: '#app',
        data: {
            
        },

        methods:{
            
            
        }
    })
</script>
</body>
</html>