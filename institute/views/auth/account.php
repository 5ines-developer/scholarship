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
                                                                    <p class="app-item-content"><?php echo $info->school ?></p>
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
                                                                            <img class="responsive-img" :src="certificate" alt="">
                                                                            <button class="upload-btn " @click="SelectFile('regfile')"><i class="material-icons ">backup </i> Upload</button>
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
                                                                            <img class="responsive-img" :src="signature" alt="">
                                                                            <button class="upload-btn " @click="SelectFile('signature')"><i class="material-icons ">backup </i> Upload</button>
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
                                                        <p>Institute Seal</p>
                                                    </div> 
                                                    <div class="app-item-body">
                                                        <div class="row m0">
                                                            <div class="col s12">
                                                                <ul>
                                                                    <li>
                                                                        <div class="app-item-content">
                                                                            <img class="responsive-img" :src="seal" alt="">
                                                                            <button class="upload-btn " @click="SelectFile('seal')"><i class="material-icons ">backup </i> Upload</button>
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

    <input type="file" id="profileimg" @change="upload"  ref="fileInput" class="hide" accept="image/*">
    <!-- End Body form  -->
    <div id="edtModal" class="modal modal-fixed-footer">
        <form action="<?php echo base_url() ?>update-account" method="post">
        <div class="modal-content">
            <h5>Institute  Detail Settings</h5>
                <div class="row m0">
                        <div class="input-field col m6">
                            <input id="iname" value="<?php echo $info->school ?>" readonly name="iname" type="text" required class="validate">
                            <label for="iname">Institute Name</label>
                        </div>

                        <div class="input-field col m6 ">
                            <input id="regno" required name="regno" readonly value="<?php echo $info->reg_no ?>" type="text" class="validate">
                            <label for="regno">Registration Number</label>
                        </div>

                        <div class="input-field col m6">
                            <input id="email" name="email" type="email" value="<?php echo $info->email ?>" required class="validate">
                            <label for="email">Email</label>
                        </div>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        

                        <div class="input-field col m6">
                            <input id="number" value="<?php echo $info->phone ?>" name="number" type="number" required class="validate">
                            <label for="number">Phone Number</label>
                        </div>

                        <div class="input-field col m6">
                            <input id="prname" value="<?php echo $info->principal ?>" type="text" name="prname" required class="validate">
                            <label for="prname">Principal Name</label>
                        </div>

                        <div class="input-field col s12 m6">
                            <?php echo '<input type="text" name="taluk" readonly required value="'.$info->taluk.'">'; ?>
                            <label>Taluk</label>
                        </div>

                        <div class="input-field col s12 m6">
                            <?php echo '<input type="text" name="district" readonly required value="'.$info->district.'">'; ?>
                            <label>District</label>
                        </div>

                        <div class="input-field col m6">
                            <input id="pin" name="pin" readonly value="<?php echo $info->pin ?>" required type="number" class="validate">
                            <label for="pin">Pin Code</label>
                        </div>


                        <div class="input-field col s12 m12">
                            <textarea id="address" required name="address" class="materialize-textarea"><?php echo $info->address ?></textarea>
                            <label for="address">Full Address</label>
                        </div>
                        
                        <div class="clearfix"></div>
                    
            </div>
        </div>
        <div class="modal-footer">
            <a class="waves-effect waves-light hoverable red darken-4 btn modal-close">Cancel</a>  
            <button class="waves-effect waves-light hoverable btn-theme btn">Update</button>  
        </div>
        </form>
    </div>
    <!-- footer -->
    <!-- <input type="file" v-modal="file">     -->

    <?php $this->load->view('include/footer'); ?>
    <!-- End footer --> 
    </div>
             


<!-- scripts -->
<script src="<?php echo $this->config->item('web_url') ?>assets/js/vue.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
<script src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<?php $this->load->view('include/msg'); ?>
<script>
    var app = new Vue({
        el: '#app',
        data: {
          type : '',
          file: '',
          seal: '<?php echo base_url('show-images/').$info->seal ?>',
          signature: '<?php echo base_url('show-images/').$info->priciple_signature ?>',
          certificate:'<?php echo base_url('show-images/').$info->reg_certification ?>'

        },  
        mounted(){
           
        },
        methods:{
            SelectFile(type){
                this.type = type;
                this.$refs.fileInput.click()
            },
            upload(e){
                const file = e.target.files[0];
                formData = new FormData();
                formData.append('file', file);
                formData.append('type', this.type);
                formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                

                if(this.type == 'regfile'){
                    this.certificate = URL.createObjectURL(file);
                }
                else if(this.type == 'signature'){
                    this.signature = URL.createObjectURL(file);
                }
                else{
                    this.seal = URL.createObjectURL(file);
                }
                
                axios.post('<?php echo base_url() ?>institute-doc', formData,{
                        headers: {
                        'Content-Type': 'multipart/form-data'
                        } 
                })
                .then(function (response) {
                    var msg = response.data.msg;
                    M.toast({html: msg, classes: 'green darken-2'});
                    self.disabled = true;
                })
                .catch(function (error) {
                    var msg = error.response.data.msg;
                    M.toast({html: msg, classes: 'red darken-4'});
                })
            }
        }
    })
</script>
</body>
</html>