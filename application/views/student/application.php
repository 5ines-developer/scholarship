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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@desislavsd/vue-select/dist/vue-select.css">

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
                                <form ref="form" @submit.prevent="formSubmit" action="#" method="post" enctype="multipart/form-data" id="s_apply"> 

                                    
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
                                                <input id="mobile" type="number"  maxlength="10"  placeholder="ವಿದ್ಯಾರ್ಥಿ/ಪೋಷಕರ ಮೊಬೈಲ್ ಸಂಖ್ಯೆ" class="validate" v-model="student.phone" @change="phonenum()" required="">
                                                <label for="mobile"> <span class="black-text">Mobile Number</span>  </label>
                                                <span class="red-text">{{phnError}}</span>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="fname" type="text" placeholder="ತಂದೆ ಹೆಸರು" class="validate" name="s_father" required="" v-model="student.father" >
                                                <label for="fname"> <span class="black-text">Father Name</span>   </label>
                                            </div>
                
                                            <div class="input-field col s12 m5">
                                                <input id="mname" type="text" placeholder="ತಾಯಿ ಹೆಸರು" name="s_mother" class="validate" required="" v-model="student.mother">
                                                <label for="mname"> <span class="black-text">Mother Name</span></label>
                                            </div>

                                            <div class="input-field col s12">
                                                <p><span class="black-text">Gender</span></p>
                                                <div class="col s6 m3 l3">
                                                    <label>
                                                        <input class="with-gap" name="std_gender"  type="radio" value="male" v-model="student.gend" />
                                                        <span>Male (ಪುರುಷ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l3">
                                                    <label>
                                                        <input class="with-gap" name="std_gender" type="radio"  value="female"  v-model="student.gend" />
                                                        <span>Female (ಹೆಣ್ಣು)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l3">
                                                    <label>
                                                        <input class="with-gap" name="std_gender" type="radio"  value="other"  v-model="student.gend" />
                                                        <span>Other (ಇತರ)</span>
                                                    </label>
                                                </div>
                                            </div>
                                                <div class="input-field col s12 mt10">
                                                    <textarea id="address" class="materialize-textarea" name="s_address"  placeholder="ಪೂರ್ಣ ಅಂಚೆ ವಿಳಾಸ (ಪಿನ್ ಕೋಡ್ ಸಹಿತ)" required="" v-model="student.address"></textarea>
                                                      <label for="address"><span class="black-text">Address</span></label>
                                                </div>
                                        </div> 
                                        <!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Present Institution Details</p>
                                                <p>ಪ್ರಸ್ತುತ ಸಂಸ್ಥೆಯ ವಿವರಗಳು</p>
                                            </div>
                                            <p class="box-title "></p>

                                            <div class="row m0">
                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="in_district" :value="institute.district.districtId"> 
                                                        <v-select  v-model="institute.district"  as="district::districtId" placeholder="Select District" @input="tallukget" tagging :from="districtSelect" />
                                                    </div>
                                                    <br><span class="red-text">{{inDistError}}</span>
                                                </div>

                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="in_talluk" :value="institute.talluk.tallukId">       
                                                        <v-select  v-model="institute.talluk"  as="talluk::tallukId" placeholder="Select Taluk" @input="schoolget" tagging :from="tallukSelect" />
                                                    </div>
                                                    <br><span class="red-text">{{intalError}}</span>
                                                </div>
                                            </div>

                                            <div class="row m0">
                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="in_school" :value="institute.name.sId">       
                                                        <v-select  v-model="institute.name"  as="sName::sId" placeholder="Select Present Institution"  tagging :from="schoolSelect" />
                                                    </div>
                                                    <br><span class="red-text">{{inpresentError}}</span>
                                                </div>
                                                <div class="input-field col s12 m5">
                                                    <input id="pspin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="ins_pin" required="" v-model="institute.pin">
                                                    <label for="pspin"> <span class="black-text">Pin Code</span>   </label>
                                                </div>
                                            </div>

                                            <div class="row m0">
                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="in_grad" :value="institute.grad.id">       
                                                        <v-select  v-model="institute.grad"  as="title::id" placeholder="Select Your graduation" @input="courseGet"  tagging :from="gardSelect" />
                                                    </div>
                                                    <br><span class="red-text">{{gradError}}</span>
                                                </div>

                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="in_course" :value="institute.course.id">       
                                                        <v-select  v-model="institute.course"  as="course::id" placeholder="Select Your Course" @input="classGet"  tagging :from="courseSelect" />
                                                    </div>
                                                    <br><span class="red-text">{{courseError}}</span>
                                                </div>
                                            </div>

                                            <div class="input-field col s12 m5" v-bind:class="{ hide: crse }">
                                                <input type="hidden" name="in_sem" :value="institute.pclass.id" >       
                                                <v-select  v-model="institute.pclass"  as="clss::id" placeholder="Select Your Present Class"tagging :from="classSelect" />
                                            <span class="red-text">{{classError}}</span>
                                            </div>

                                        </div>
                                        <!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title mb20">
                                                <p>Does the student belong to the Scheduled Castes / Scheduled Tribes? If so Xerox copy of the caste certificate obtained from the Tahsildar To be Attached</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಪರಿಶಿಷ್ಠ ಜಾತಿ/ಪರಿಶಿಷ್ಠ ಪಂಗಡಗಳಿಗೆ ಸೇರಿದವರೇ ? ಹಾಗಿದ್ದರೆ ತಹಶೀಲ್ದಾರರಿಂದ ಪಡೆದ ಜಾತಿ ಪ್ರಮಾಣ ಪತ್ರದ ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸಬೇಕು</p>
                                                <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->cast_certificate.'">Caste Certificate</a>
                                                    </p>':''; ?>                                                 
                                            </div>

                                            <div class="input-field col s12">
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio" @change="casteCheck()" value="0"  v-model="caste.low"/>
                                                        <span>No (ಇಲ್ಲ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio"   @change="casteCheck()" value="1" checked v-model="caste.low"/>
                                                        <span>Yes (ಹೌದು)</span>
                                                    </label>
                                                </div>
                                            </div><br>

                                            <div class="file-field input-field col s12 m10 " v-bind:class="{ hide: tribes }">
                                                <div class="input-field col s6 ">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="std_castfile" ref="file1"  @change="castecertificate()" accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="Upload cast certificate"  >
                                                    </div>
                                                    <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span> </p>
                                                </div>

                                                <div class="input-field col s6 ">
                                                    <input id="cast_number" type="text"  placeholder="ಜಾತಿ ಸರ್ಟಿಫಿಕೇಟ್  ನಂಬರ್" class="validate" v-model="caste.number" >
                                                    <label for="cast_number"> <span class="black-text">Caste certificate number</span>   </label>
                                                </div>
                                            </div>


                                                <div class="input-field col s12 m10" v-bind:class="{ hide: scaste }">
                                                    <p><span class="black-text">Select your category</span></p>
                                                    <div class="col s6 m3 l3">
                                                        <label>
                                                            <input class="with-gap" name="std_cat1" type="radio" value="sc" checked v-model="trcategory"/>
                                                            <span>SC (ಪರಿಶಿಷ್ಠ ಜಾತಿ)</span>
                                                        </label>
                                                    </div>
                                                    <div class="col s6 m3 l3">
                                                        <label>
                                                            <input class="with-gap" name="std_cat1" type="radio" value="st" v-model="trcategory"/>
                                                            <span>ST (ಪರಿಶಿಷ್ಠ ಪಂಗಡ)</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="input-field col s12 m10" v-bind:class="{ hide: genral }">
                                                    <p><span class="black-text">Select your category</span></p>
                                                    <div class="col s6 m3 l4">
                                                        <label>
                                                            <input class="with-gap" name="std_cat" type="radio" value="general" checked v-model="gncategory"/>
                                                            <span>General (ಸಾಮಾನ್ಯ ವರ್ಗ)</span>
                                                        </label>
                                                    </div>
                                                    <div class="col s6 m3 l4">
                                                        <label>
                                                            <input class="with-gap" name="std_cat" type="radio" value="obc" v-model="gncategory"/>
                                                            <span>OBC (ಅಲ್ಪಸಂಖ್ಯಾತರು)</span>
                                                        </label>
                                                    </div>
                                                </div>
                                             
                                        </div>
                                        <!-- End Box-->

                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Your Previous year Class and Marks</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಹಿಂದಿನ ಸಾಲಿನಲ್ಲಿ ತೇರ್ಗಡೆಯಾದ ತರಗತಿ ಮತ್ತು ಪರೀಕ್ಷಯಲ್ಲಿ ಪಡೆದಿರುವ ಅಂಕಗಳನ್ನು ನಮೂದಿಸುವುದು </p>
                                            </div>
                                            

                                            <div class="col s12 m5">
                                                <div class="input-field col s12 ">
                                                    <input id="pv_class" type="text"  placeholder="ಹಿಂದಿನ ತರಗತಿ ಹೆಸರು" class="validate" required="" v-model="previous.class" >
                                                    <label for="pv_class"> <span class="black-text">Previous Standard</span>   </label>
                                                </div>

                                                <div class="input-field col s12 ">
                                                    <input id="pv_marks" type="number" @change="markCheck()" placeholder="ಶೇಕಡಾವಾರು ಅಂಕಗಳು" class="validate" required="" v-model="previous.marks">
                                                    <label for="pv_marks"> <span class="black-text">Marks in Percentage</span>   </label>
                                                    <span class="helper-text red-text">{{markError}}</span>
                                                </div>
                                            </div>

                                            <div class="col s12 m6">
                                                <p  class="mb5">Attach Your Marks Card Copy</p>
                                                <p class="mb20">(ಅಂಕಪಟ್ಟಿಯ  ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು) 

                                                <?php echo (!empty($result->prv_markcard))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->prv_markcard.'">Marks card</a>
                                                    </p>':''; ?>
                                                </p>

                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="pv_mrcard" ref="file" @change="markcard()" <?php echo (!empty($result->prv_markcard))?'':"required"; ?> accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" >
                                                    </div>
                                                    
                                                    <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note : File Should be in pdf / jpg / png format. Size should be not more than 512KB. <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a>  </span></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- End Box -->
                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Student Aadhar Card Number and Attach the Xerox copy</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಆಧಾರ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ  (ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು)</p>
                                                <?php echo (!empty($result->adharcard_file))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->adharcard_file.'">Aadhar Card</a>
                                                    </p>':''; ?>
                                            </div>
                                            

                                            <div class="input-field col s12 m5">
                                                <input id="adhar_no" type="text" placeholder="ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" v-model="adhaar.number" @change="cardNumberSpace" ref="creditCardNumber" :maxlength="max">
                                                <label for="adhar_no"> <span class="black-text">Enter Your Aadhar Card Number</span>   </label>
                                                <span class="red-text">{{adhError}}</span>
                                            </div>


                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2" @change="adhaarXerox" <?php echo (!empty($result->adharcard_file))?'':"required"; ?> accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>


                                            <div class="input-field col s12 m5">
                                                <input id="adhar_nof" type="text" placeholder="ನಿಮ್ಮ ತಂದೆಯ  ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" :required="fatherrequire" v-model="adhaar.fnumber" @keyup="cardNumberSpacef" ref="creditCardNumberf" :maxlength="max">
                                                <label for="adhar_nof"> <span class="black-text">Enter Your Father Aadhar Card Number</span>   </label>
                                                <p>
                                                  <label>
                                                    <input type="checkbox" name="not_applicable" v-model="not_applicable1" value="1" @change="not_applicable('father')" />
                                                    <span>Not Applicable</span>
                                                  </label>
                                                </p>
                                                <span class="red-text">{{adhErrorf}}</span>
                                            </div>


                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2f" @change="adhaarXeroxf" <?php echo (!empty($result->adharcard_file))?'':"required"; ?> accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>


                                            <div class="input-field col s12 m5">
                                                <input id="adhar_no" type="text" placeholder="ನಿಮ್ಮ ತಾಯಿಯ ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" :required="motherrequire" v-model="adhaar.numberm" @keyup="cardNumberSpacem" ref="creditCardNumberm" :maxlength="max">
                                                <label for="adhar_no"> <span class="black-text">Enter Your Mother Aadhar Card Number</span>   </label>
                                                <p>
                                                  <label>
                                                    <input type="checkbox" name="not_applicable" v-model="not_applicable2" value="1" @change="not_applicable('mother')"/>
                                                    <span>Not Applicable</span>
                                                  </label>
                                                </p>
                                                <span class="red-text">{{adhErrorm}}</span>
                                            </div>


                                            <div class="file-field input-field col s12 m6">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2m" @change="adhaarXeroxm" <?php echo (!empty($result->adharcard_file))?'':"required"; ?> accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>

                                            
                                        </div>
                                        
                                        <!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Student Bank Details</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿ ಬ್ಯಾಂಕ್ ವಿವರಗಳು</p>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <select id="in_talluk"  required="" v-model="bank.type">
                                                    <option value="">ಖಾತೆದಾರರು</option>
                                                    <option value="1">Parent</option>
                                                    <option value="2">Student</option>
                                                </select>
                                                <label for="in_talluk">Account Holder</label>
                                                <span class="red-text">{{actypeError}}</span>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="bn_holdr" type="text" placeholder="ಖಾತೆದಾರರ ಹೆಸರು" class="validate" name="bn_branch" required=""  v-model="bank.holder">
                                                <label for="bn_holdr"> <span class="black-text">Account Holder Name</span>   </label>
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
                                                <input id="bn_acc" type="text" placeholder="ಖಾತೆ ಸಂಖ್ಯೆಯನ್ನು ಉಳಿಸಲಾಗುತ್ತಿದೆ" class="validate" name="bn_acc" required="" v-model="bank.account" @change="accnochange()">
                                                <label for="bn_acc"> <span class="black-text">Saving Account Number</span></label>
                                                <span class="red-text">{{accError}}</span>
                                            </div>

                                            <div class="file-field input-field col s12 m6">
                                            <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->passbook.'">Bank Passbook</a>
                                                    </p>':''; ?>
                                                <p >ನಿಮ್ಮ ಪಾಸ್‌ಬುಕ್ ಮುಂದಿನ ಪುಟವನ್ನು ಅಪ್‌ಲೋಡ್ ಮಾಡಿ</p>                                                
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="bn_passbk"  ref="file3" @change="bankPassbook" <?php echo (!empty($result->passbook))?'':"required"; ?> accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Passbook Front page" >
                                                </div>
                                                <span class="black-text helper-text" data-error="wrong"  data-success="right">File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span><br><br>
                                            </div>
                                            
                                        </div>
                                        <!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Industry Details</p>
                                                <p>ಉದ್ಯಮದ ವಿವರಗಳು</p>
                                            </div>
                                            <div class="mt10">
                                                <div class="input-field col s12 m5 l10">
                                                    <p>ಉದ್ಯೋಗಧಾರರು  ಯಾರು</p>
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
                                                </div>
                                            </div>
                                            <div class="clearfix mb20"></div>
                                            
                                            
                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_pname" type="text" placeholder="ಪೋಷಕ / ರಕ್ಷಕರ ಹೆಸರು" class="validate" v-model="industry.pname"  required="" >
                                                <label for="id_pname"> <span class="black-text">Parent / Guardian Name</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_msal" type="number" placeholder="ಮಾಸಿಕ ವೇತನ" class="validate" name="id_msal" required="" @change="salaryCheck()" v-model="industry.salary">
                                                <label for="id_msal"> <span class="black-text">Monthly Salary</span>   </label>
                                                <span class="helper-text red-text">{{salError}}</span>
                                            </div>

                                            <div class="input-field col s12 m5 l5">
                                                <input id="id_rel" type="text" placeholder="ವಿದ್ಯಾರ್ಥಿ ಮತ್ತು ಪೋಷಕರ ನಡುವಿನ ಸಂಬಂಧ" class="validate" v-model="industry.relation" required="" >
                                                <label for="id_rel"> <span class="black-text">Relation between Student & Parent</span>   </label>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <input id="id_pin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="id_pin" required="" v-model="industry.pin" >
                                                <label for="id_pin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>
                                            <div class="row m0">
                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="id_district" :value="industry.district.districtId">       
                                                        <v-select  v-model="industry.district"  as="district::districtId" placeholder="Select District" @input="tallukgets" tagging :from="districtSelect" />
                                                    </div><br>
                                                    <span class="red-text">{{inddistError}}</span>
                                                </div>

                                                <div class="input-field col s12 m5">
                                                    <div>
                                                        <input type="hidden" name="id_talluk" :value="industry.talluk.tallukId"> <v-select  v-model="industry.talluk"  as="talluk::tallukId" placeholder="Select Taluk" tagging :from="tallukSelects" />
                                                    </div><br>
                                                    <span class="red-text">{{indtalError}}</span>
                                                </div>
                                            </div>

                                            <div class="input-field col s12 m12">
                                                <input type="hidden" name="id_name" :value="industry.name.iId"> 
                                                <v-select  v-model="industry.name"  as="iName::iId" placeholder="Parent Industry Name" tagging :from="industrySelects" />
                                            </div>
                                            <span class="red-text">{{indnameError}}</span>
                                        </div>
                                        
                                        <!-- End Box-->

                                        <input type="hidden" name="uniq" value="<?php echo random_string('alnum',16); ?>" v-model="uniq"/>
                                        <input type="hidden" name="aid" v-model="aid" />

                                        <button type="submit" class="waves-effect waves-light hoverable btn-theme btn">Apply</button>
                                        <button type="reset" class="waves-effect waves-light hoverable btn-theme btn">Reset</button>
                                    

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
    <div v-if="loader" class="loading">Loading&#8230;</div>
    
    <?php $this->load->view('includes/footer'); ?>
</div>


<!-- scripts -->
<script src="<?php echo base_url() ?>assets/js/vue.js"></script>
<script src="<?php echo base_url() ?>assets/js/materialize.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/script.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@desislavsd/vue-select"></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems);

        var instances = M.FormSelect.init(document.querySelectorAll('select'));
    });


    var app = new Vue({
        el: '#app',
        components: {
            vSelect: VueSelect.vSelect,
        },
        data: {
            districtSelect: [],
            tallukSelect: [],
            tallukSelects: [],
            schoolSelect:[], 
            industrySelects:[],   
            gardSelect:[],  
            courseSelect:[],    
            classSelect:[],    
            loader:false,  
            crse:false,  
            uniq:'',
            file:'',
            file1:'',
            file2:'',
            file3:'',
            aid:'',
            student: {
                name: '',
                phone: '',
                father: '',
                mother: '',
                address:'',
                gend:'male',

            },
            institute: {
                pclass:'',
                pin:'',
                name:'',
                talluk:'',
                district:'',
                grad:'',
                course:'',
                name:'',
            },
            previous:{
                class:'',
                marks:'',
            },
            industry:{
                working:'1',
                pname:'',
                salary:'',
                relation:'',
                pin:'',
                talluk:'',
                district:'',
                name:'',
            },
            caste:{
                low:'0',
                number:'',

            },
            adhaar:{
                number:'',
                fnumber:'',
                numberm:'',
            },
            bank:{
                name:'',
                branch:'',
                ifsc:'',
                account:'',
                type:'',
                holder:'',
            },
            tribes:true,
            markError:'',
            salError:'',
            scaste: true,
            genral:false,
            max: 16,
            trcategory:'sc',
            gncategory:'general',
            adhError:'',
            adhErrorf:'',
            adhErrorm:'',
            inDistError:'',
            intalError:'',
            inpresentError:'',
            gradError:'',
            courseError:'',
            classError:'',
            inddistError:'',
            indtalError:'',
            actypeError:'',
            indnameError:'',
            phnError:'',
            accError:'',
            not_applicable1:false,
            not_applicable2:false,
            motherrequire:true,
            fatherrequire:true,

        },
        methods:{
            not_applicable(not_apply){
                if (not_apply !='' && not_apply=='mother') {
                    this.not_applicable2 =true;
                    this.not_applicable1 =false;
                    this.motherrequire = false;
                    this.fatherrequire = true;
                }else if(not_apply !='' && not_apply=='father'){
                    this.not_applicable1 =true;
                    this.not_applicable2 =false;
                    this.fatherrequire = false;
                    this.motherrequire = true;
                }

            },
            cardNumberSpace(){
                var cardNumber = this.$refs.creditCardNumber.value;

                this.adhError = '';
                if (cardNumber.length != 16) {
                    this.adhError = 'Aadhar Card number must be 16 digits.';
                }else{

                    // var result = cardNumber.replace(/^(.{4})(.{4})(.{4})(.{4})$/, "$1 $2 $3 $4");
                    // this.adhaar.number = result;
                    var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/adharcheck?adhar='+cardNumber)
                    .then(function (response) {
                        if(response.data !=  '0'){
                            M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                            this.adhError = 'You are not eligible to apply for this scholarship';
                        }
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                }
            },
            phonenum(){
                this.phnError = '';
                var phone = this.student.phone;
                if (phone.length !=10) {
                    this.phnError = 'Phone Number Must be 10 digits!';
                }
            },
            accnochange(){
                this.accError ='';
                var account = this.bank.account;
                const formData = new FormData();
                axios.get('<?php echo base_url() ?>std_application/accnochange?acc='+account)
                .then(function (response) {
                    if(response.data ==  ''){
                        M.toast({html: 'Account Number Already exist!', classes: 'red', displayLength : 5000 });
                        this.accError = 'Account Number Already exist!';
                    }
                })
                .catch(function (error) {
                    this.errormsg = error.response.data.error;
                })

            

            },
            cardNumberSpacef(){
                var cardNumber = this.$refs.creditCardNumberf.value;

                this.adhErrorf = '';
                if (cardNumber.length <16) {
                    this.adhErrorf = 'Aadhar Card number must be 16 digits.';
                }else{

                    // var result = cardNumber.replace(/^(.{4})(.{4})(.{4})(.{4})$/, "$1 $2 $3 $4");
                    // this.adhaar.fnumber = result;
                    var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/adharcheckf?adharf='+cardNumber)
                    .then(function (response) {
                        if(response.data !=  '0'){
                            M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                            this.adhErrorf = 'You are not eligible to apply for this scholarship';
                        }
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                }
            },


             cardNumberSpacem(){
                var cardNumber = this.$refs.creditCardNumberm.value;

                this.adhErrorm = '';
                if (cardNumber.length <16) {
                    this.adhErrorm = 'Aadhar Card number must be 16 digits.';
                }else{

                    // var result = cardNumber.replace(/^(.{4})(.{4})(.{4})(.{4})$/, "$1 $2 $3 $4");
                    // this.adhaar.numberm = result;
                    var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/adharcheckm?adharm='+cardNumber)
                    .then(function (response) {
                        if(response.data !=  '0'){
                            M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                            this.adhErrorm = 'You are not eligible to apply for this scholarship';
                        }
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                }
            },

            markcard(){
                this.file = this.$refs.file.files[0];
                
            },
            salaryCheck(){
                this.salError = '';
                if((this.industry.salary > 15000))
                {
                    M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                    this.salError = 'You are not eligible to apply for this scholarship';
                }
            },          
            castecertificate(){
                this.file1 = this.$refs.file1.files[0];
                
            },
            adhaarXerox(){
                this.file2 = this.$refs.file2.files[0];
                
            },
            adhaarXeroxf(){
                this.file2f = this.$refs.file2f.files[0];
                
            },
            adhaarXeroxm(){
                this.file2m = this.$refs.file2m.files[0];
                
            },
            bankPassbook(){
                this.file3 = this.$refs.file3.files[0];
                
            },
            casteCheck(){
                if (this.caste.low =='1') {
                    this.tribes = false;
                    this.scaste = false;
                    this.genral = true;
                }else{
                    this.tribes = true;
                    this.scaste = true;
                    this.genral = false;
                }

            },markCheck(){
                this.markError = '';
                if((this.caste.low !='1') && (this.previous.marks < 50))
                {
                    M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                    this.markError = 'You are not eligible to apply for this scholarship';
                }else if((this.caste.low !='') && (this.previous.marks < 45)){
                    M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                    this.markError = 'You are not eligible to apply for this scholarship';
                }
            },
           formSubmit(e){
                e.preventDefault();

                this.inDistError    ='';
                this.intalError     ='';
                this.inpresentError ='';
                this.gradError      ='';
                this.courseError    ='';
                this.classError     ='';
                this.inddistError   ='';
                this.indtalError    ='';
                this.actypeError    ='';
                this.indnameError   ='';



                if((this.institute.district.districtId ==null) || (this.institute.district.districtId == 'undefined')){ 
                    this.inDistError = 'Please Select the District'; 
                }
                if((this.institute.talluk.tallukId ==null) || (this.institute.talluk.tallukId =='undefined')){ this.intalError = 'Please Select the Talluk';  } 
                if((this.institute.name.sId ==null) || (this.institute.name.sId =='undefined')){ this.inpresentError = 'Please Select your institution';  }
                if((this.institute.grad.id ==null) || (this.institute.grad.id =='undefined')){ this.gradError = 'Please Select your graduation';  }
                if((this.institute.course.id ==null) || (this.institute.course.id =='undefined')){ this.courseError = 'Please Select your course';  }
                if((this.institute.pclass.id ==null) || (this.institute.pclass.id =='undefined')){ this.classError = 'Please Select your Present class';  }
                if((this.bank.type =='') || (this.bank.type =='undefined')){ this.actypeError = 'Please Select the bank holder type';  }
                if((this.industry.talluk.tallukId ==null) || (this.industry.talluk.tallukId =='undefined')){ this.indtalError = 'Please Select the Talluk';  }
                if((this.industry.district.districtId ==null) || (this.industry.district.districtId =='undefined')){ this.inddistError = 'Please Select the District';  }
                if((this.industry.name.iId ==null) || (this.industry.name.iId =='undefined')){ this.indnameError = 'Please Select your industry';  }


                if ((this.markError == '') && (this.salError=='') && (this.adhError=='') && (this.inDistError=='') && (this.intalError=='') && (this.inpresentError=='') && (this.gradError=='') && (this.courseError=='') && (this.actypeError=='') && (this.indtalError=='') && (this.inddistError=='') && (this.indnameError=='') && (this.phnError=='') && (this.accError=='') ){
                    this.loader=true;
                    const formData = new FormData();
                    formData.append('sname', this.student.name);
                    formData.append('sphone', this.student.phone);
                    formData.append('sfather', this.student.father);
                    formData.append('smother', this.student.mother);
                    formData.append('saddress', this.student.address);
                    formData.append('gender', this.student.gend);

                    formData.append('ipclass', this.institute.pclass.id);
                    formData.append('ipin', this.institute.pin);                
                    formData.append('iname', this.institute.name.sId);
                    formData.append('italluk', this.institute.talluk.tallukId);
                    formData.append('idistrict', this.institute.district.districtId);
                    formData.append('igrad', this.institute.grad.id);
                    formData.append('icourse', this.institute.course.id);
                    formData.append('clow', this.caste.low);
                    formData.append('cfile', this.file1);
                    formData.append('cnumber', this.caste.number);
                    formData.append('tcat', this.trcategory);
                    formData.append('gcat', this.gncategory);
                    formData.append('pclass', this.previous.class);
                    formData.append('pmarks', this.previous.marks);
                    formData.append('pcard', this.file);
                    formData.append('incard', this.industry.working);
                    formData.append('inpname', this.industry.pname);
                    formData.append('insalary', this.industry.salary);
                    formData.append('inrelation', this.industry.relation);
                    formData.append('inpin', this.industry.pin);
                    formData.append('intalluk', this.industry.talluk.tallukId);
                    formData.append('indistrict', this.industry.district.districtId);
                    formData.append('inname', this.industry.name.iId);

                    formData.append('anumber', this.adhaar.number);
                    formData.append('axerox', this.file2);
                    formData.append('anumberm', this.adhaar.numberm);
                    formData.append('axeroxm', this.file2m);
                    formData.append('anumberf', this.adhaar.fnumber);
                    formData.append('axeroxf', this.file2f);


                    formData.append('bname', this.bank.name);
                    formData.append('branch', this.bank.branch);
                    formData.append('bifsc', this.bank.ifsc);
                    formData.append('baccount', this.bank.account);
                    formData.append('bpassbook', this.file3);
                    formData.append('btype', this.bank.type);
                    formData.append('bholder', this.bank.holder);
                                              
                    formData.append('uniq', this.uniq);                          
                    formData.append('aid', this.aid);

                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');


                    axios.post('<?php echo base_url() ?>student/submit-application', formData,
                    { headers: { 'Content-Type': 'multipart/form-data' } })
                    .then(response => {
                        this.loader=false;
                        if(response.data == 'error'){
                            M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                        }else if(response.data == '1'){
                            M.toast({html: 'Your application has been submitted successfully, <br> you\'ll get notify once its get approved.', classes: 'green', displayLength : 5000 });
                            window.location.href = "<?php echo base_url('student/application-detail') ?>";
                        }else if(response.data == ''){
                            M.toast({html: 'Something went wrong!, please try again Later', classes: 'red', displayLength : 5000 });
                        }else{
                            M.toast({html: response.data, classes: 'red', displayLength : 8000 });
                        }
                    })
                    .catch(error => {
                        this.loader=false;
                        if (error.response) {
                            this.errormsg = error.response.data.error;
                        }
                    })
                }else{
                    M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                }
           },
                getIndustry(){
                    var self= this;
                    axios.get('<?php echo base_url() ?>std_application/industryget')
                    .then(function (response) {
                        self.industrySelects = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                getDistrict(){
                    var self= this;
                    axios.get('<?php echo base_url() ?>std_application/district')
                    .then(function (response) {
                        self.districtSelect = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },  
                tallukget(){
                    var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/tallukget?id='+self.institute.district.districtId)
                    .then(function (response) {
                        self.tallukSelect = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                tallukgets(){
                     var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/tallukget?id='+self.industry.district.districtId)
                    .then(function (response) {
                        self.tallukSelects = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                schoolget(type){
                    var self= this; 
                    const formData = new FormData();
                    formData.append('id', self.institute.talluk.tallukId);
                    axios.get('<?php echo base_url() ?>std_application/schoolget?id='+self.institute.talluk.tallukId)
                    .then(function (response) {  
                        self.schoolSelect = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                garduation(){
                    var self= this; 
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/garduation')
                    .then(function (response) {  
                        self.gardSelect = response.data;
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                courseGet(){
                    var self= this; 
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/courseGet?id='+self.institute.grad.id)
                    .then(function (response) { 
                        self.courseSelect = response.data;
                        if (self.institute.grad.id == 1 || self.institute.grad.id == 6) {
                            self.crse = true;
                        }else{
                            self.crse = false;
                        }
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                classGet(){
                    var self= this; 
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/classGet?id='+self.institute.course.id)
                    .then(function (response) {
                        if (self.institute.grad.id != 1) {
                            self.classSelect = response.data;
                        }
                    })
                    .catch(function (error) {
                        this.errormsg = error.response.data.error;
                    })
                },
                getdata(){
                    var self= this;
                    const formData = new FormData();
                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');
                    axios.get('<?php echo base_url() ?>std_application/lastData')
                    .then(function (response) {
                        //basic details
                        self.student.name    = response.data.name;
                        self.student.phone   = response.data.parent_phone;
                        self.student.father  = response.data.father_name;
                        self.student.mother  = response.data.mothor_name;
                        self.student.address = response.data.saddress;
                        self.student.gend    = response.data.gender;

                        //caste details
                        if(response.data.is_scst == 1){
                            self.tribes = false;
                            self.scaste = false;
                            self.genral = true; 
                        }else{
                            self.tribes = true;
                            self.scaste = true;
                            self.genral = false;
                        }
                        self.caste.low          = response.data.is_scst;
                        self.caste.number       = response.data.cast_no;
                        self.caste.trcategory   = response.data.category;
                        self.caste.gncategory   = response.data.category;
                        if (response.data.cast_certificate !=null) {
                            self.castpdf   = "<?php echo base_url() ?>"+response.data.cast_certificate;
                        }else{
                            self.castpdf = "#";
                        }

                        //adhar card
                        self.adhaar.number      = response.data.adharcard_no;
                        if (response.data.adharcard_file !=null) {
                            self.file2  = "<?php echo base_url() ?>"+response.data.adharcard_file;
                        }else{
                            self.file2 = "#";
                        }

                        self.adhaar.numberm      = response.data.m_adhar;
                        self.adhaar.fnumber      = response.data.f_adhar;

                        //bank details
                        self.bank.name          = response.data.name;
                        self.bank.branch        = response.data.branch;
                        self.bank.ifsc          = response.data.ifsc;
                        self.bank.account       = response.data.acc_no;
                        self.bank.type          = response.data.type;
                        self.bank.holder        = response.data.holder;
                        if (response.data.passbook !=null) {
                            self.bankpdf  = "<?php echo base_url() ?>"+response.data.passbook;
                        }else{
                            self.bankpdf = "#";
                        }
                    })
                    .catch(function (error) {

                    })
                }
        },
        mounted:function(){
               this.getDistrict();
               this.getIndustry();
               this.garduation();
               this.getdata();
        }
    })
</script>
</body>
</html>