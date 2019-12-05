<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
<div id="app">
    <?php $this->load->view('includes/header'); ?>

    <!-- Banner -->
    <section class="application-banner">
        <div class="parallax-container">
            <div class="parallax"><img src="<?php echo base_url() ?>assets/image/application-bg.jpg"></div>
        </div>
    </section>
    <!-- End Banner -->

    <!-- application form  -->
    <section class="application-form">
        <div class="container">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        
                        <div class="card-header center-align">
                            <div class="right">
                                <a href="<?php echo base_url('student/profile')?>" class="white-text">
                                    <span> <i class="material-icons">backspace</i> </span><br />
                                    <span>Back</span>
                                </a>
                            </div>
                            <p> Online Scholarship Application Form</p>
                            <p>ಸಂಘಟಿತ ಕಾರ್ಮಿಕ ಮಕ್ಕಳಿಂದ ಶೈಕ್ಷಣಿಕ ಪ್ರೋತ್ಸಾಹ ಧನ ಸಹಾಯಕ್ಕಾಗಿ ಅರ್ಜಿ</p>
                        </div>

                        <div class="card-body">
                            <div class="row m0">
                                <form action="#" method="post" enctype="multipart/form-data" id="s_apply" @submit="formSubmit"> 

                                    
                                    <!-- <div class="divider clearfix" tabindex="-1"></div> -->

                                        <div class="borderd-box">
                                            <div class="col s12 box-title ">
                                                <p>Student Details</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿ ವಿವರಗಳು</p>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="name" type="text" placeholder="ವಿದ್ಯಾರ್ಥಿ/ನಿಯ ಹೆಸರು (ಅಂಕಪಟ್ಟಿಯಲ್ಲಿರುವoತೆ)" class="validate" v-model="student.name" required="">
                                                <label for="name"> <span class="black-text">Student name</span> </label>
                                            </div>
                                            
                                            <div class="input-field col s12 m5">
                                                <input id="mobile" type="number" placeholder="ವಿದ್ಯಾರ್ಥಿ/ಪೋಷಕರ ಮೊಬೈಲ್ ಸಂಖ್ಯೆ" class="validate" v-model="student.phone" required="" >
                                                <label for="mobile"> <span class="black-text">Mobile Number</span>  </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="fname" type="text" placeholder="ತಂದೆ ಹೆಸರು" class="validate" name="s_father" required="" v-model="student.father" >
                                                <label for="fname"> <span class="black-text">Father Name</span>   </label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="mname" type="text" placeholder="ತಾಯಿ ಹೆಸರು" name="s_mother" class="validate" required="" v-model="student.mother">
                                                <label for="mname"> <span class="black-text">Mother Name</span></label>
                                            </div>


                                            <div class="input-field col s12 m10">
                                              <textarea id="address" class="materialize-textarea" name="s_address"  placeholder="ಪೂರ್ಣ ಅಂಚೆ ವಿಳಾಸ (ಪಿನ್ ಕೋಡ್ ಸಹಿತ)" required="" v-model="student.address"></textarea>
                                              <label for="address"><span class="black-text">Address</span></label>
                                            </div>
                                        </div> <!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Present Institution Details</p>
                                                <p>ಪ್ರಸ್ತುತ ಸಂಸ್ಥೆಯ ವಿವರಗಳು</p>
                                            </div>
                                            <p class="box-title "></p>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="pclass" type="text" placeholder="ಪ್ರಸ್ತುತ ತರಗತಿ" class="validate" required="" v-model="institute.pclass">
                                                <label for="pclass"> <span class="black-text">Present Class</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select required="" v-model="institute.name">
                                                    <option value="" selected>ಪ್ರಸ್ತುತ ಸಂಸ್ಥೆ</option>
                                                    <?php if (!empty($school)) {
                                                        foreach ($school as $sch => $schl) { 
                                                          echo '<option value="'.$schl->sId.'">'.$schl->sName.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label>Select Present Institution</label>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="input-field col s12 m5">
                                                <input id="pspin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="ins_pin" required="" v-model="institute.pin">
                                                <label for="pspin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>
                                            <div class="input-field col s12 m5 l5">
                                                <select id="in_talluk" required="" v-model="institute.talluk">
                                                    <option value="" selected>ತಾಲ್ಲೂಕು</option>
                                                    <?php if (!empty($talluk)) {
                                                        foreach ($talluk as $tal => $talk) { 
                                                          echo '<option value="'.$talk->tallukId.'">'.$talk->talluk.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="in_talluk">Taluk</label>
                                            </div>
                                            <div class="input-field col s12 m5 l5">
                                                <select id="in_district" required="" v-model="institute.district">
                                                    <option value="" selected>ಜಿಲ್ಲೆ</option>
                                                    <?php if (!empty($district)) {
                                                        foreach ($district as $dist => $distct) { 
                                                          echo '<option value="'.$distct->districtId.'">'.$distct->district.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="in_district">District</label>
                                            </div>
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Your Previous year Class and Marks</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಹಿಂದಿನ ಸಾಲಿನಲ್ಲಿ ತೇರ್ಗಡೆಯಾದ ತರಗತಿ ಮತ್ತು ಪರೀಕ್ಷಯಲ್ಲಿ ಪಡೆದಿರುವ ಅಂಕಗಳನ್ನು ನಮೂದಿಸುವುದು. </p>
                                            </div>
                                            

                                            <div class="col s12 m5">
                                                <div class="input-field col s12 ">
                                                    <input id="pv_class" type="text"  placeholder="ಹಿಂದಿನ ತರಗತಿ ಹೆಸರು" class="validate" required="" v-model="previous.class" >
                                                    <label for="pv_class"> <span class="black-text">Previous Class Name</span>   </label>
                                                </div>

                                                <div class="input-field col s12 ">
                                                    <input id="pv_marks" type="number"  placeholder="ಅಂಕಗಳು" class="validate" required="" v-model="previous.marks">
                                                    <label for="pv_marks"> <span class="black-text">Marks</span>   </label>
                                                </div>
                                            </div>

                                            <div class="col s12 m6">
                                                <p  class="mb5">Attach Your Marks Card Copy</p>
                                                <p class="mb20">(ಅಂಕಪಟ್ಟಿಯ  ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು) 

                                                <?php echo (!empty($result->prv_markcard))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->prv_markcard.'">Marks card</a>
                                                    </p>':'#'; ?>
                                                </p>

                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="pv_mrcard" ref="file" @change="markcard()" <?php echo (!empty($result->prv_markcard))?'':"required"; ?>>
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" >
                                                    </div>
                                                    
                                                    <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note :</span> <span class="red-text"> File Should be in pdf / jpg / png format. Size should be not more than 512KB </span></p>
                                                </div>
                                            </div>
                                            
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Industry Details</p>
                                                <p>ಉದ್ಯಮದ ವಿವರಗಳು</p>
                                            </div>
                                            <div class="mt10">
                                                <div class="col s12 m4 l2">
                                                    <label>
                                                        <input class="with-gap" v-model="industry.working" value="1" type="radio" checked="checked"  />
                                                        <span>Father (ತಂದೆ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 m4 l2">
                                                    <label>
                                                        <input class="with-gap" v-model="industry.working" value="2" type="radio"  />
                                                        <span>Mother (ತಾಯಿ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 m4 l2">
                                                    <label>
                                                        <input class="with-gap" v-model="industry.working" value="3" type="radio"  />
                                                        <span>Guardian (ರಕ್ಷಕ)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="clearfix mb20"></div>
                                            
                                            
                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_pname" type="text" placeholder="ಪೋಷಕ / ರಕ್ಷಕರ ಹೆಸರು" class="validate" v-model="industry.pname"  required="" >
                                                <label for="id_pname"> <span class="black-text">Parent / Guardian Name</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_msal" type="text" placeholder="ಮಾಸಿಕ ವೇತನ" class="validate" name="id_msal" required="" v-model="industry.salary">
                                                <label for="id_msal"> <span class="black-text">Monthly Salary</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_rel" type="text" placeholder="ವಿದ್ಯಾರ್ಥಿ ಮತ್ತು ಪೋಷಕರ ನಡುವಿನ ಸಂಬಂಧ" class="validate" v-model="industry.relation" required="" >
                                                <label for="id_rel"> <span class="black-text">Relation between Student & Parent</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="id_pin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="id_pin" required="" v-model="industry.pin" >
                                                <label for="id_pin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_talluk" id="id_talluk" required="" v-model="industry.talluk" >
                                                    <option value="" disabled selected>ತಾಲ್ಲೂಕು</option>
                                                    <?php if (!empty($talluk)) {
                                                        foreach ($talluk as $tal => $talk) { 
                                                          echo '<option value="'.$talk->tallukId.'">'.$talk->talluk.'</option>';
                                                     } } ?>
                                                </select>
                                                <label for="id_talluk">Talluk</label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_district" id="id_district" required="" v-model="industry.district" >
                                                    <option value="" selected>ಜಿಲ್ಲೆ</option>
                                                    <?php if (!empty($district)) {
                                                        foreach ($district as $dist => $distct) { 
                                                          echo '<option value="'.$distct->districtId.'">'.$distct->district.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="id_district">District</label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_name" id="id_name" required=""  v-model="industry.name" >
                                                    <option value="" selected>ಪೋಷಕ ಉದ್ಯಮದ ಹೆಸರು</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $comp => $compn) { 
                                                          echo '<option value="'.$compn->iId.'">'.$compn->iName.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="id_name">Parent Industry Name</label>
                                            </div>
                                            <div class="input-field col s12 m7">
                                              <textarea id="id_add" class="materialize-textarea" placeholder="ಉದ್ಯಮದ ವಿಳಾಸ" name="id_add" required=""   v-model="industry.address" ></textarea>
                                              <label for="id_add"><span class="black-text">Industry Address</span></label>
                                            </div>
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title mb20">
                                                <p>Does the student belong to the Scheduled Castes / Scheduled Tribes? If so Xerox copy of the cast certificate obtained from the Tahsildar To be Attached.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಪರಿಶಿಷ್ಠ ಜಾತಿ/ಪರಿಶಿಷ್ಠ ಪಂಗಡಗಳಿಗೆ ಸೇರಿದವರೇ ? ಹಾಗಿದ್ದರೆ ತಹಶೀಲ್ದಾರರಿಂದ ಪಡೆದ ಜಾತಿ ಪ್ರಮಾಣ ಪತ್ರದ ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸಬೇಕು.</p>
                                                <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->cast_certificate.'">Caste Certificate</a>
                                                    </p>':'#'; ?>
                                                
                                            </div>

                                            <div class="col s12">
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio" value="" checked v-model="caste.low"/>
                                                        <span>No (ಇಲ್ಲ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio"  value="1" v-model="caste.low"/>
                                                        <span>Yes (ಹೌದು)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="std_castfile" ref="file1"  @change="castecertificate()" <?php echo (!empty($result->cast_certificate))?'':"required"; ?>>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload cast certificate"  >
                                                </div>
                                                <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note: </span> <span class="red-text">File Should be in pdf / jpg / png format. Size should be not more than 512KB </span> </p>
                                            </div>
                                            
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Student Aadhar Card Number and Attach the Xerox copy.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಆಧಾರ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ  (ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು). </p>
                                                <?php echo (!empty($result->adharcard_file))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->adharcard_file.'">Aadhar Card</a>
                                                    </p>':'#'; ?>
                                            </div>
                                            

                                            <div class="input-field col s12 m5">
                                                <input id="adhar_no" type="number" placeholder="ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" v-model="adhaar.number">
                                                <label for="adhar_no"> <span class="black-text">Enter Your Aadhar Card Number</span>   </label>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2" @change="adhaarXerox" <?php echo (!empty($result->adharcard_file))?'':"required"; ?>>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: </span> <span class="red-text">File Should be in pdf / jpg / png format. Size should be not more than 512KB </span></span>
                                            </div>
                                            
                                        </div><!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Student Bank Details.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿ ಬ್ಯಾಂಕ್ ವಿವರಗಳು. </p>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="bn_name" type="text" placeholder="ಬ್ಯಾಂಕ್ ಹೆಸರು" class="validate" name="bn_name" required="" v-model="bank.name">
                                                <label for="bn_name"> <span class="black-text">Bank Name</span> </label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="bn_branch" type="text" placeholder="ಶಾಖೆಯ ಹೆಸರು" class="validate" name="bn_branch" required=""  v-model="bank.branch">
                                                <label for="bn_branch"> <span class="black-text">Branch Name</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="bn_ifsc" type="text" placeholder="ಐಎಫ್‌ಎಸ್‌ಸಿ ಸಂಖ್ಯೆ" class="validate" name="bn_ifsc" required="" v-model="bank.ifsc">
                                                <label for="bn_ifsc"> <span class="black-text">IFSC No.</span></label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="bn_acc" type="text" placeholder="ಖಾತೆ ಸಂಖ್ಯೆಯನ್ನು ಉಳಿಸಲಾಗುತ್ತಿದೆ" class="validate" name="bn_acc" required="" v-model="bank.account">
                                                <label for="bn_acc"> <span class="black-text">Saving Account Number</span></label>
                                            </div>

                                            <div class="file-field input-field col s12 m6">
                                            <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->passbook.'">Bank Passbook</a>
                                                    </p>':'#'; ?>
                                                <p >ನಿಮ್ಮ ಪಾಸ್‌ಬುಕ್ ಮುಂದಿನ ಪುಟವನ್ನು ಅಪ್‌ಲೋಡ್ ಮಾಡಿ</p>                                                
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="bn_passbk"  ref="file3" @change="bankPassbook" <?php echo (!empty($result->passbook))?'':"required"; ?>>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Passbook Front page" >
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right">File Should be in pdf / jpg / png format. Size should be not more than 512KB </span>
                                            </div>
                                            
                                            <input type="hidden" name="uniq" value="<?php echo random_string('alnum',16); ?>" v-model="uniq"/>
                                            <input type="hidden" name="aid" v-model="aid" />


                                            <p class="col s12 mb20 mt10">
                                                <label>
                                                    <input type="checkbox" name="terms" required="" v-model="terms" />
                                                    <span>I accept all the <a>Terms & Condition</a></span>
                                                </label>
                                            </p>
                                        </div><!-- End Box-->

                                        <button class="waves-effect waves-light hoverable btn-theme btn">Apply</button>
                                        <button class="waves-effect waves-light hoverable btn-theme btn">Reset</button>
                                    

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End application form  -->


    <!-- footer -->
    
    <?php $this->load->view('includes/footer'); ?>
</div>


<!-- scripts -->
<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/materialize.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/script.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems);
    });

    var app = new Vue({
        el: '#app',
        data: {
            loader:false,
            uniq:'<?php echo (!empty($result->uniq))?$result->uniq:''; ?>',
            terms:'<?php echo (!empty($result->terms))?'true':''; ?>',
            file:'',
            file1:'',
            file2:'',
            file3:'',
            aid:'<?php echo (!empty($result))?'1':''; ?>',
            student: {
                name: '<?php echo (!empty($result->name))?$result->name:''; ?>',
                phone: '<?php echo (!empty($result->parent_phone))?$result->parent_phone:''; ?>',
                father: '<?php echo(!empty($result->father_name))?$result->father_name:''; ?>',
                mother: '<?php echo (!empty($result->mothor_name))?$result->mothor_name:''; ?>',
                address:'<?php echo (!empty($result->saddress))?$result->saddress:''; ?>',
            },
            institute: {
                pclass:'<?php echo (!empty($result->class))?$result->class:''; ?>',
                pin:'<?php echo (!empty($result->ins_pin))?$result->ins_pin:''; ?>',
                name:'<?php echo (!empty($result->ins_talluk))?$result->ins_talluk:''; ?>',
                talluk:'<?php echo (!empty($result->ins_talluk))?$result->ins_talluk:''; ?>',
                district:'<?php echo (!empty($result->ins_district))?$result->ins_district:''; ?>',
            },
            previous:{
                class:'<?php echo (!empty($result->prv_class))?$result->prv_class:''; ?>',
                marks:'<?php echo (!empty($result->prv_marks))?$result->prv_marks:''; ?>',
            },
            industry:{
                working:'<?php echo (!empty($result->who_working))?$result->who_working:''; ?>',
                pname:'<?php echo (!empty($result->pName))?$result->pName:''; ?>',
                salary:'<?php echo (!empty($result->msalary))?$result->msalary:''; ?>',
                relation:'<?php echo (!empty($result->relationship))?$result->relationship:''; ?>',
                pin:'<?php echo (!empty($result->indPincode))?$result->indPincode:''; ?>',
                talluk:'<?php echo (!empty($result->talluk))?$result->talluk:''; ?>',
                district:'<?php echo (!empty($result->district))?$result->district:''; ?>',
                name:'<?php echo (!empty($result->company_id))?$result->company_id:''; ?>',
                address:'<?php echo (!empty($result->ind_address))?$result->ind_address:''; ?>',
            },
            caste:{
                low:'<?php echo (!empty($result->is_scst))?$result->is_scst:''; ?>',

            },
            adhaar:{
                number:'<?php echo (!empty($result->adharcard_no))?$result->adharcard_no:''; ?>',
            },
            bank:{
                name:'<?php echo (!empty($result->bnkName))?$result->bnkName:''; ?>',
                branch:'<?php echo (!empty($result->branch))?$result->branch:''; ?>',
                ifsc:'<?php echo (!empty($result->acc_no))?$result->acc_no:''; ?>',
                account:'<?php echo (!empty($result->ifsc))?$result->ifsc:''; ?>',
            }

        },
        methods:{
            markcard(){
                this.file = this.$refs.file.files[0];
                
            },
            castecertificate(){
                this.file1 = this.$refs.file1.files[0];
                
            },
            adhaarXerox(){
                this.file2 = this.$refs.file2.files[0];
                
            },
            bankPassbook(){
                this.file3 = this.$refs.file3.files[0];
                
            },
           formSubmit(e){
                e.preventDefault();
                this.loader=true;
                const formData = new FormData();
                formData.append('sname', this.student.name);
                formData.append('sphone', this.student.phone);
                formData.append('sfather', this.student.father);
                formData.append('smother', this.student.mother);
                formData.append('saddress', this.student.address);
                formData.append('ipclass', this.institute.pclass);
                formData.append('ipin', this.institute.pin);                
                formData.append('iname', this.institute.name);
                formData.append('italluk', this.institute.talluk);
                formData.append('idistrict', this.institute.district);
                formData.append('pclass', this.previous.class);
                formData.append('pmarks', this.previous.marks);
                formData.append('pcard', this.previous.card);
                formData.append('incard', this.industry.working);
                formData.append('inpname', this.industry.pname);
                formData.append('insalary', this.industry.salary);
                formData.append('inrelation', this.industry.relation);
                formData.append('inpin', this.industry.pin);
                formData.append('intalluk', this.industry.talluk);
                formData.append('indistrict', this.industry.district);
                formData.append('inname', this.industry.name);
                formData.append('inaddress', this.industry.address);
                formData.append('clow', this.caste.low);
                formData.append('cfile', this.file1);
                formData.append('anumber', this.adhaar.number);
                formData.append('axerox', this.file2);
                formData.append('bname', this.bank.name);
                formData.append('branch', this.bank.branch);
                formData.append('bifsc', this.bank.ifsc);
                formData.append('baccount', this.bank.account);
                formData.append('bpassbook', this.file3);                          
                formData.append('uniq', this.uniq);                          
                formData.append('terms', this.terms);                          
                formData.append('aid', this.aid);                          
                axios.post('<?php echo base_url() ?>student/submit-application', formData,
                { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(response => {
                    this.loader=false;
                    if(response.data == '1'){
                        M.toast({html: 'Your application has been submitted successfully, <br> you\'ll get notify once its get approved.', classes: 'green', displayLength : 5000 });
                        window.location.href = "<?php echo base_url('student/application-detail') ?>";
                    }else{
                        M.toast({html: 'Something went wrong!, please try again Later', classes: 'red', displayLength : 5000 });
                    }
                })
                .catch(error => {
                    this.loader=false;
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