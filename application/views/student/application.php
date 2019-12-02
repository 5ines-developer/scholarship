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
                                <form action="<?php echo base_url('student/submit-application') ?>" method="post" enctype="multipart/form-data" id="s_apply">

                                    
                                    <!-- <div class="divider clearfix" tabindex="-1"></div> -->

                                        <div class="borderd-box">
                                            <div class="col s12 box-title ">
                                                <p>Student Details</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿ ವಿವರಗಳು</p>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="name" type="text" placeholder="ವಿದ್ಯಾರ್ಥಿ/ನಿಯ ಹೆಸರು (ಅಂಕಪಟ್ಟಿಯಲ್ಲಿರುವoತೆ)" class="validate" name="s_name" required="" >
                                                <label for="name"> <span class="black-text">Student name</span> </label>
                                            </div>
                                            
                                            <div class="input-field col s12 m5">
                                                <input id="mobile" type="number" placeholder="ವಿದ್ಯಾರ್ಥಿ/ಪೋಷಕರ ಮೊಬೈಲ್ ಸಂಖ್ಯೆ" class="validate" name="s_phone" required="" >
                                                <label for="mobile"> <span class="black-text">Mobile Number</span>  </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="fname" type="text" placeholder="ತಂದೆ ಹೆಸರು" class="validate" name="s_father" required="" >
                                                <label for="fname"> <span class="black-text">Father Name</span>   </label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="mname" type="text" placeholder="ತಾಯಿ ಹೆಸರು" name="s_mother" class="validate" required="" >
                                                <label for="mname"> <span class="black-text">Mother Name</span></label>
                                            </div>


                                            <div class="input-field col s12 m10">
                                              <textarea id="address" class="materialize-textarea" name="s_address"  placeholder="ಪೂರ್ಣ ಅಂಚೆ ವಿಳಾಸ (ಪಿನ್ ಕೋಡ್ ಸಹಿತ)" required="" ></textarea>
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
                                                <input id="pclass" type="text" placeholder="ಪ್ರಸ್ತುತ ತರಗತಿ" class="validate" name="pr_class">
                                                <label for="pclass"> <span class="black-text">Present Class</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="pr_insti" required="" >
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
                                                <input id="pspin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="ins_pin" required="" >
                                                <label for="pspin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>
                                            <div class="input-field col s12 m5 l5">
                                                <select name="in_talluk" id="in_talluk" required="" >
                                                    <option value="" selected>ತಾಲ್ಲೂಕು</option>
                                                    <?php if (!empty($talluk)) {
                                                        foreach ($talluk as $tal => $talk) { 
                                                          echo '<option value="'.$talk->tallukId.'">'.$talk->talluk.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="in_talluk">Taluk</label>
                                            </div>
                                            <div class="input-field col s12 m5 l5">
                                                <select name="in_district" id="in_district" required="" >
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
                                                    <input id="pv_class" type="number"  placeholder="ಹಿಂದಿನ ತರಗತಿ ಹೆಸರು" class="validate" name="pv_class" required="" >
                                                    <label for="pv_class"> <span class="black-text">Previous Class Name</span>   </label>
                                                </div>

                                                <div class="input-field col s12 ">
                                                    <input id="pv_marks" type="number"  placeholder="ಅಂಕಗಳು" class="validate" name="pv_marks" required="" >
                                                    <label for="pv_marks"> <span class="black-text">Marks</span>   </label>
                                                </div>
                                            </div>

                                            <div class="col s12 m6">
                                                <p  class="mb5">Attach Your Marks Card Copy</p>
                                                <p class="mb20">(ಅಂಕಪಟ್ಟಿಯ  ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು)</p>

                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="pv_mrcard">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" required="" >
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
                                                        <input class="with-gap" name="in_group" type="radio" checked="checked"  />
                                                        <span>Father (ತಂದೆ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 m4 l2">
                                                    <label>
                                                        <input class="with-gap" name="in_group" type="radio"  />
                                                        <span>Mother (ತಾಯಿ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s12 m4 l2">
                                                    <label>
                                                        <input class="with-gap" name="in_group" type="radio"  />
                                                        <span>Guardian (ರಕ್ಷಕ)</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="clearfix mb20"></div>
                                            
                                            
                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_pname" type="text" placeholder="ಪೋಷಕ / ರಕ್ಷಕರ ಹೆಸರು" class="validate" name="id_pname" required="" >
                                                <label for="id_pname"> <span class="black-text">Parent / Guardian Name</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_msal" type="text" placeholder="ಮಾಸಿಕ ವೇತನ" class="validate" name="id_msal" required="" >
                                                <label for="id_msal"> <span class="black-text">Monthly Salary</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_rel" type="text" placeholder="ವಿದ್ಯಾರ್ಥಿ ಮತ್ತು ಪೋಷಕರ ನಡುವಿನ ಸಂಬಂಧ" class="validate" name="id_rel" required="" >
                                                <label for="id_rel"> <span class="black-text">Relation between Student & Parent</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="id_pin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="id_pin" required="" >
                                                <label for="id_pin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_talluk" id="id_talluk" required="" >
                                                    <option value="" disabled selected>ತಾಲ್ಲೂಕು</option>
                                                    <?php if (!empty($talluk)) {
                                                        foreach ($talluk as $tal => $talk) { 
                                                          echo '<option value="'.$talk->tallukId.'">'.$talk->talluk.'</option>';
                                                     } } ?>
                                                </select>
                                                <label for="id_talluk">Talluk</label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_district" id="id_district" required="" >
                                                    <option value="" selected>ಜಿಲ್ಲೆ</option>
                                                    <?php if (!empty($district)) {
                                                        foreach ($district as $dist => $distct) { 
                                                          echo '<option value="'.$distct->districtId.'">'.$distct->district.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="id_district">District</label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select name="id_name" id="id_name" required="" >
                                                    <option value="" selected>ಪೋಷಕ ಉದ್ಯಮದ ಹೆಸರು</option>
                                                    <?php if (!empty($company)) {
                                                        foreach ($company as $comp => $compn) { 
                                                          echo '<option value="'.$compn->iId.'">'.$compn->iName.'</option>';
                                                     } } ?> 
                                                </select>
                                                <label for="id_name">Parent Industry Name</label>
                                            </div>
                                            <div class="input-field col s12 m7">
                                              <textarea id="id_add" class="materialize-textarea" placeholder="ಉದ್ಯಮದ ವಿಳಾಸ" name="id_add"></textarea>
                                              <label for="id_add"><span class="black-text">Industry Address</span></label>
                                            </div>
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title mb20">
                                                <p>Does the student belong to the Scheduled Castes / Scheduled Tribes? If so Xerox copy of the cast certificate obtained from the Tahsildar To be Attached.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಪರಿಶಿಷ್ಠ ಜಾತಿ/ಪರಿಶಿಷ್ಠ ಪಂಗಡಗಳಿಗೆ ಸೇರಿದವರೇ ? ಹಾಗಿದ್ದರೆ ತಹಶೀಲ್ದಾರರಿಂದ ಪಡೆದ ಜಾತಿ ಪ್ರಮಾಣ ಪತ್ರದ ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸಬೇಕು. </p>
                                            </div>

                                            <div class="col s12">
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio" checked />
                                                        <span>No (ಇಲ್ಲ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio"  />
                                                        <span>Yes (ಹೌದು)</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="std_castfile" >
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload cast certificate" required="" >
                                                </div>
                                                <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note: </span> <span class="red-text">File Should be in pdf / jpg / png format. Size should be not more than 512KB </span> </p>
                                            </div>
                                            
                                        </div><!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Student Aadhar Card Number and Attach the Xerox copy.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಆಧಾರ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ  (ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು). </p>
                                            </div>
                                            

                                            <div class="input-field col s12 m5">
                                                <input id="adhar_no" type="number" placeholder="ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" name="adhar_no">
                                                <label for="adhar_no"> <span class="black-text">Enter Your Aadhar Card Number</span>   </label>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar" >
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card" required="" >
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
                                                <input id="bn_name" type="text" placeholder="ಬ್ಯಾಂಕ್ ಹೆಸರು" class="validate" name="bn_name" required="">
                                                <label for="bn_name"> <span class="black-text">Bank Name</span> </label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="bn_branch" type="text" placeholder="ಶಾಖೆಯ ಹೆಸರು" class="validate" name="bn_branch" required="" >
                                                <label for="bn_branch"> <span class="black-text">Branch Name</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="bn_ifsc" type="text" placeholder="ಐಎಫ್‌ಎಸ್‌ಸಿ ಸಂಖ್ಯೆ" class="validate" name="bn_ifsc" required="" >
                                                <label for="bn_ifsc"> <span class="black-text">IFSC No.</span></label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="bn_acc" type="text" placeholder="ಖಾತೆ ಸಂಖ್ಯೆಯನ್ನು ಉಳಿಸಲಾಗುತ್ತಿದೆ" class="validate" name="bn_acc" required="" >
                                                <label for="bn_acc"> <span class="black-text">Saving Account Number</span></label>
                                            </div>

                                            <div class="file-field input-field col s12 m6">
                                                <p >ನಿಮ್ಮ ಪಾಸ್‌ಬುಕ್ ಮುಂದಿನ ಪುಟವನ್ನು ಅಪ್‌ಲೋಡ್ ಮಾಡಿ</p>
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="bn_passbk" >
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Passbook Front page" required="" >
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right">File Should be in pdf / jpg / png format. Size should be not more than 512KB </span>
                                            </div>
                                                    <input type="hidden" name="uniq" value="<?php echo random_string('alnum',16); ?>" />


                                            <p class="col s12 mb20 mt10">
                                                <label>
                                                    <input type="checkbox" name="terms" required="" />
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

<script>
   document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems);
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