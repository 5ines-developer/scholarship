<?php
$this->ci =& get_instance();
$this->load->model('m_stdapplication');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialize.min.css">
    <link  rel="stylesheet" href="<?php echo base_url() ?>assets/css/material-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@desislavsd/vue-select/dist/vue-select.css">

</head>
<body>
<div id="app">
    <?php $this->load->view('includes/header'); ?>

    <!-- Banner -->
    <section class="application-banner">
        <div class="parallax-container">
            <div class="parallax"><img src="<?php echo base_url() ?>assets/img/banner1.jpg"></div>
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
                                                <input id="mobile" type="number"  maxlength="10"  placeholder="ವಿದ್ಯಾರ್ಥಿ/ಪೋಷಕರ ಮೊಬೈಲ್ ಸಂಖ್ಯೆ" class="validate" v-model="student.phone" required="">
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

                                            
                                            <div class="input-field col s12 m5">
                                                    <input type="hidden" name="in_district" :value="institute.district.districtId"> <v-select  v-model="institute.district"  as="district::districtId" placeholder="Select District" @input="tallukget" tagging :from="districtSelect" />
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <div>
                                                    <input type="hidden" name="in_talluk" :value="institute.talluk.tallukId">       
                                                    <v-select  v-model="institute.talluk"  as="talluk::tallukId" placeholder="Select Taluk" @input="schoolget" tagging :from="tallukSelect" :disabled='disabledtal'/>
                                                </div>
                                                <br><span class="red-text">{{intalError}}</span>
                                            </div>

                                            <div class="row">

                                            <div class="input-field col s12 m5">
                                                <div>
                                                    <input type="hidden" name="in_school" :value="institute.name.sId">       
                                                    <v-select  v-model="institute.name"  as="sName::sId" placeholder="Select Present Institution"  tagging :from="schoolSelect" :disabled='disabledscl'/>
                                                </div>
                                                <br><span class="red-text">{{inpresentError}}</span>
                                            </div>
                                            
                                            
                                            <div class="input-field col s12 m5">
                                                <input id="pspin" type="number" maxlength="6" placeholder="ಪಿನ್ ಕೋಡ್" class="validate" name="ins_pin" required="" v-model="institute.pin">
                                                <label for="pspin"> <span class="black-text">Pin Code</span>   </label>
                                            </div>
                                            </div>
                                            <div class="row">
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
                                                        <v-select  v-model="institute.course"  as="course::id" placeholder="Select Your Course" @input="classGet"  tagging :from="courseSelect" :disabled='disabledcrs'/>
                                                    </div>
                                                    <br><span class="red-text">{{courseError}}</span>
                                                </div>
                                            </div>

                                            <div class="input-field col s12 m5" v-bind:class="{ hide: crse }">
                                                <div>
                                                    <input type="hidden" name="in_sem" :value="institute.pclass.id" >       
                                                    <v-select  v-model="institute.pclass"  as="clss::id" placeholder="Select Your Present Class"tagging :from="classSelect" :disabled='disabledcls'/>
                                                </div>
                                                <br><span class="red-text">{{classError}}</span>
                                            </div>

                                        </div>
                                        <!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title mb20">
                                                <p>Does the student belong to the Scheduled Castes / Scheduled Tribes? If so Xerox copy of the cast certificate obtained from the Tahsildar To be Attached.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಪರಿಶಿಷ್ಠ ಜಾತಿ/ಪರಿಶಿಷ್ಠ ಪಂಗಡಗಳಿಗೆ ಸೇರಿದವರೇ ? ಹಾಗಿದ್ದರೆ ತಹಶೀಲ್ದಾರರಿಂದ ಪಡೆದ ಜಾತಿ ಪ್ರಮಾಣ ಪತ್ರದ ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸಬೇಕು.</p>
                                                <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->cast_certificate.'">Caste Certificate</a>
                                                    </p>':''; ?>                                                 
                                            </div>

                                            <div class="input-field col s12">
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio" @change="casteCheck()" value="0" checked v-model="caste.low"/>
                                                        <span>No (ಇಲ್ಲ)</span>
                                                    </label>
                                                </div>
                                                <div class="col s6 m3 l2">
                                                    <label>
                                                        <input class="with-gap" name="std_cast" type="radio"   @change="casteCheck()" value="1" v-model="caste.low"/>
                                                        <span>Yes (ಹೌದು)</span>
                                                    </label>
                                                </div>
                                            </div><br>

                                            <div class="file-field input-field col s12 m10 " v-bind:class="{ hide: tribes }">

                                                <div class="input-field col s6 ">
                                                    <p class="app-item-content"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                        <a target="_blank" :href="castpdf">Caste Certificate</a>
                                                    </p>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="input-field col s6 ">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="std_castfile" ref="file1"  @change="castecertificate()" >
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="Upload cast certificate">
                                                    </div>
                                                    <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note: </span> <span class="black-text">File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="http://jpeg-optimizer.com/" target="_blank">click here to reduce the image size</a></span> </p>
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
                                                            <input class="with-gap" name="std_cat1" type="radio" value="sc" v-model="trcategory"/>
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
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಹಿಂದಿನ ಸಾಲಿನಲ್ಲಿ ತೇರ್ಗಡೆಯಾದ ತರಗತಿ ಮತ್ತು ಪರೀಕ್ಷಯಲ್ಲಿ ಪಡೆದಿರುವ ಅಂಕಗಳನ್ನು ನಮೂದಿಸುವುದು. </p>
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
                                                    <p class="app-item-content"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                        <a target="_blank" :href="mrcard">Marks card</a>
                                                    </p>
                                                </p>

                                                <div class="file-field input-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="pv_mrcard" ref="file" @change="markcard()">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                    
                                                    <p class="helper-text" data-error="wrong" data-success="right"><span class="black-text">Note :</span> <span class="black-text"> File Should be in pdf / jpg / png format. Size should be not more than 512KB. <a href="http://jpeg-optimizer.com/" target="_blank">click here to reduce the image size</a>  </span></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- End Box -->
                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Enter Student Aadhar Card Number and Attach the Xerox copy.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿಯು ಆಧಾರ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ  (ಜೆರಾಕ್ಸ್ ಪ್ರತಿಯನ್ನು ಲಗತ್ತಿಸುವುದು). </p>
                                            </div>

                                            <!-- student aadhar -->

                                            <div class="row m0">
                                                <div class="input-field col s12 m5">
                                                    <p class="app-item-content"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                        <a target="_blank" :href="adhrpdf">Aadhar Card</a>
                                                    </p>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="input-field col s12 m5">
                                                    <input id="adhar_no" type="text" placeholder="ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" v-model="adhaar.number" @change="cardNumberSpace" ref="creditCardNumber" :maxlength="max">
                                                    <label for="adhar_no"> <span class="black-text">Enter Your Aadhar Card Number</span>   </label>
                                                    <span class="red-text">{{ adhError }}</span>
                                                </div>
                                                <div class="file-field input-field col s12 m6">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="adhar"  ref="file2" @change="adhaarXerox">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="Upload Your Adhar Card">
                                                    </div>
                                                    <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: </span> <span class="black-text">File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="http://jpeg-optimizer.com/" target="_blank">click here to reduce the image size</a></span></span>
                                                </div> 
                                            </div>

                                            <!-- student aadhar -->

                                            <!-- father aadhar -->
                                            <div class="row m0">
                                            <div class="input-field col s12 m5">
                                                <p class="app-item-content" :class="{ hide :fdrader }"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                    <a target="_blank" :href="fadhrpdf">Fathers Aadhar Card</a>
                                                </p>

                                                <p class="app-item-content" :class="{ hide :fatherdeathfile }"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                    <a target="_blank" :href="fadhrpdffile">Fathers Death certifiacte</a>
                                                </p>

                                            </div>
                                            <div class="clearfix"></div>
                                           <div class="input-field col s12 m5">
                                                <input id="adhar_nof" type="text" placeholder="ನಿಮ್ಮ ತಂದೆಯ  ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" v-model="adhaar.fnumber" @change="cardNumberSpacef" ref="creditCardNumberf" :maxlength="max">
                                                <label for="adhar_nof"> <span class="black-text">Enter Your Father Aadhar Card Number</span>   </label>
                                                <p>
                                                          <label class="active">
                                                            <input type="checkbox" name="not_applicable" v-model="not_applicable1" value="1" @change="not_applicable('father')" />
                                                            <span>Not Applicable</span>
                                                          </label>
                                                        </p>
                                                <span class="red-text">{{adhErrorf}}</span>
                                            </div>

                                            <div class="file-field input-field col s12 m6" v-bind:class="{ hide: fdrader }">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2f" @change="adhaarXeroxf" accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Father Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>

                                            <div class="file-field input-field col s12 m6" v-bind:class="{ hide: fatherdeath }">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="death"  ref="file4d" @change="deathXeroxf" accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Father Death Certificate if father expired">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>

                                        </div>

                                        <div class="row m0">
                                            <div class="input-field col s12 m5">
                                                <p class="app-item-content" :class="{ hide :mdrader }"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                    <a target="_blank" :href="madhrpdf">Mothers Aadhar Card</a>
                                                </p>

                                                <p class="app-item-content" :class="{ hide :motherdeathfile }"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt="">
                                                    <a target="_blank" :href="motherpdffile">Mothers Death certifiacte</a>
                                                </p>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="input-field col s12 m5">
                                                <input id="adhar_no" type="text" placeholder="ನಿಮ್ಮ ತಾಯಿಯ ಆಧಾರ್ ಕಾರ್ಡ್ ಸಂಖ್ಯೆ" class="validate" required="" v-model="adhaar.numberm" @change="cardNumberSpacem" ref="creditCardNumberm" :maxlength="max">
                                                <label for="adhar_no"> <span class="black-text">Enter Your Mother Aadhar Card Number</span></label>
                                                <p>
                                                  <label class="active">
                                                    <input type="checkbox" name="not_applicable" v-model="not_applicable2" value="1" @change="not_applicable('mother')"/>
                                                    <span>Not Applicable</span>
                                                  </label>
                                                </p>
                                                <span class="red-text">{{adhErrorm}}</span>
                                            </div>
                                            <div class="file-field input-field col s12 m6" v-bind:class="{ hide: mdrader }">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="adhar"  ref="file2m" @change="adhaarXeroxm" accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Mother Adhar Card">
                                                </div>
                                                <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                            </div>
                                           


                                            <div class="file-field input-field col s12 m6"   v-bind:class="{ hide: motherdeath }">
                                                    <div class="btn">
                                                            <span>File</span>
                                                            <input type="file" name="death"  ref="file5d" @change="deathXeroxm" accept=".png,.jpg,.jpeg,.svg,.pdf">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text" placeholder="Upload Mother Death Certificate if mother expired">
                                                        </div>
                                                        <span class="helper-text" data-error="wrong"  data-success="right"><span class="black-text">Note: File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="https://image.online-convert.com/convert-to-jpg" target="_blank">click here to reduce the image size</a></span></span>
                                                </div>
                                             </div>

                                            <!-- mother aadhar -->
                                        </div>
                                        
                                        <!-- End Box-->


                                        <div class="borderd-box ">
                                            <div class="col s12 box-title ">
                                                <p>Student Bank Details.</p>
                                                <p>ವಿದ್ಯಾರ್ಥಿ ಬ್ಯಾಂಕ್ ವಿವರಗಳು. </p>
                                            </div>

                                            <div class="input-field col s12 m5 l5">

                                                <input type="hidden" name="in_grad" :value="bank.type.id">       
                                                <v-select  v-model="bank.type"  as="title::id" placeholder="Select Your graduation" @input="courseGet"  tagging :from="[{title: 'Parent', id: 1}, {title: 'Student', id: 2}]" />

                                                <!-- <select id="in_talluk"  required="" v-model="bank.type" class="browser-default-">
                                                    <option value="" disabled selected>ಖಾತೆದಾರರು</option>
                                                    <option value="1">Parent</option>
                                                    <option value="2">Student</option>
                                                </select>
                                                <label for="in_talluk">Account Holder</label> -->
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
                                                <input id="bn_acc" type="text" placeholder="ಖಾತೆ ಸಂಖ್ಯೆಯನ್ನು ಉಳಿಸಲಾಗುತ್ತಿದೆ" class="validate" name="bn_acc" required="" v-model="bank.account">
                                                <label for="bn_acc"> <span class="black-text">Saving Account Number</span></label>
                                            </div>
                                            <div class="input-field col s12 m5">
                                                <p class="app-item-content"><img src="<?php echo base_url() ?>assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" :href="bankpdf">Bank Passbook</a>
                                                </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="file-field input-field col s12 m6">
                                            <?php echo (!empty($result->cast_certificate))?'
                                                    <p class="app-item-content"><img src="'.base_url().'assets/image/pdf.svg" width="10px" class="pdf-icon" alt=""> 
                                                    <a target="_blank" href="'.base_url().$result->passbook.'">Bank Passbook</a>
                                                    </p>':''; ?>
                                                <p >ನಿಮ್ಮ ಪಾಸ್‌ಬುಕ್ ಮುಂದಿನ ಪುಟವನ್ನು ಅಪ್‌ಲೋಡ್ ಮಾಡಿ</p>


                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="bn_passbk"  ref="file3" @change="bankPassbook">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text" placeholder="Upload Your Passbook Front page">
                                                </div>
                                                <span class="black-text helper-text" data-error="wrong"  data-success="right">File Should be in pdf / jpg / png format. Size should be not more than 512KB <a href="http://jpeg-optimizer.com/" target="_blank">click here to reduce the image size</a></span><br><br>
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
                                                <input id="id_msal" type="text" placeholder="ಮಾಸಿಕ ವೇತನ" class="validate" name="id_msal" required="" @change="salaryCheck()" v-model="industry.salary">
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
                                            <div class="input-field col s12 m5">
                                                <div>
                                                <input type="hidden" name="id_district" :value="industry.district.districtId"> <v-select  v-model="industry.district"  as="district::districtId" placeholder="Select District" @input="tallukgets" tagging :from="districtSelect" />
                                                </div><br><span class="red-text">{{inddistError}}</span>
                                            </div>

                                            <div class="input-field col s12 m5">
                                                <div>
                                                <input type="hidden" name="id_talluk" :value="industry.talluk.tallukId"> <v-select  v-model="industry.talluk"  as="talluk::tallukId" placeholder="Select Taluk" tagging :from="tallukSelects" />
                                                </div><br>
                                                    <span class="red-text">{{indtalError}}</span>
                                            </div>

                                            <div class="input-field col s12 m12">
                                                <input type="hidden" name="id_name" :value="industry.name.iId"> 
                                                <v-select  v-model="industry.name"  as="iName::iId" placeholder="Parent Industry Name" tagging :from="industrySelects" />
                                            </div>
                                        </div>

                                        <!-- End Box-->

                                        <input type="hidden" name="uniq" value="<?php echo random_string('alnum',16); ?>" v-model="uniq"/>
                                        <input type="hidden" name="aid" v-model="aid" />

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
                low:'',
                number:'',

            },
            adhaar:{
                number:'',
            },
            bank:{
                name:'',
                branch:'',
                ifsc:'',
                account:'',
                type:'',
                holder:'',
                id:'',
            },
            tribes:true,
            markError:'',
            salError:'',
            scaste: true,
            genral:true,
            max: 16,
            trcategory:'sc',
            gncategory:'general',
            mrcard:'',
            castpdf:'',
            adhrpdf:'',
            bankpdf:'',
            adhError:'',
            adhError:'',
            adhErrorf:'',
            adhErrorm:'',
            fadhrpdf:'',
            madhrpdf:'',
            not_applicable1:'',
            not_applicable2:'',
            motherrequire:true,
            fatherrequire:true,
            mdrader:false,
            fdrader:false,
            fatherdeath:true,
            motherdeath:true,
            fatherdeathfile:false,
            motherdeathfile:false,
            fadhrpdffile:false,
            motherpdffile:false,
            intalError:'',
            inpresentError:'',
            gradError:'',
            courseError:'',
            classError:'',
            inddistError:'',
            indtalError:'',
            disabled1:false,
            disabledtal:false,
            disabledscl:false,
            disabledcrs:false,
            disabledcls:false,
        },
        methods:{

            not_applicable(not_apply){



                
                if (not_apply !='' && not_apply=='mother' && this.not_applicable2 ==true) {
                    this.not_applicable2 =true;
                    this.not_applicable1 =false; 
                    this.mdrader = true;
                    this.motherdeath = false;
                    this.fdrader = false;
                    this.fatherdeath = true;
                    this.motherrequire = false;
                    this.fatherrequire = true;
                    this.adhErrorm = '';
                    this.motherdeathfile = false;
                    this.fatherdeathfile = true;
                    this.adhErrorm = '';
                    this.adhaar.numberm='';
                    

                }else if(not_apply !='' && not_apply=='father' && this.not_applicable1 ==true){
                    this.not_applicable1 =true;
                    this.not_applicable2 =false;
                    this.fdrader = true;
                    this.fatherdeath = false;
                    this.mdrader = false;
                    this.motherdeath = true;
                    this.fatherrequire = false;
                    this.motherrequire = true;
                    this.adhErrorf = '';
                    this.fatherdeathfile = false;
                    this.motherdeathfile = true;
                    this.adhErrorf = '';
                    this.adhaar.fnumber='';
                    
                }else{

                    this.fdrader = false;
                    this.mdrader = false;
                    this.motherrequire = false;
                    this.fatherrequire = false;
                    this.fatherdeath = true;
                    this.motherdeath = true;
                    this.fatherdeathfile = true;
                    this.motherdeathfile = true;

                }

            },

            cardNumberSpace(){
                var cardNumber = this.$refs.creditCardNumber.value;
                // var result = cardNumber.replace(/^(.{4})(.{4})(.{4})(.{4})$/, "$1 $2 $3 $4");
                // this.adhaar.number = result;

                nud = this.adhaar.number;
                fad = this.adhaar.fnumber;
                mad = this.adhaar.numberm;

                this.adhError = '';
                if (nud ==fad || nud == mad) {
                    this.adhError = 'Aadhar Card number must be Unique.';
                }


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
            cardNumberSpacef(){
                var cardNumber = this.$refs.creditCardNumberf.value;
                this.adhErrorf = '';

                nud = this.adhaar.number;
                fad = this.adhaar.fnumber;
                mad = this.adhaar.numberm;
                if (fad ==nud || fad == mad) {
                    this.adhErrorf = 'Aadhar Card number must be Unique.';
                }

                if (cardNumber.length <16) {
                    if (this.not_applicable1 != true) {
                        this.adhErrorf = 'Aadhar Card number must be 16 digits.';
                    }else{
                        this.adhErrorf = '';
                    }
                    
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

                nud = this.adhaar.number;
                fad = this.adhaar.fnumber;
                mad = this.adhaar.numberm;

                if (mad ==nud || mad == fad) {
                    this.adhErrorm = 'Aadhar Card number must be Unique.';
                }

                if (cardNumber.length <16) {
                    if (this.not_applicable2 != true) {
                        this.adhErrorm = 'Aadhar Card number must be 16 digits.';
                    }else{
                        this.adhErrorm = '';
                    }

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
            deathXeroxf(){
                this.file4d = this.$refs.file4d.files[0];

            },deathXeroxm(){
                this.file5d = this.$refs.file5d.files[0];
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
                if((this.caste.low =='') && (this.previous.marks < 50))
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
                if ((this.markError == '') && (this.salError=='')){
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
                    formData.append('bname', this.bank.name);
                    formData.append('bname', this.bank.name);
                    formData.append('branch', this.bank.branch);
                    formData.append('bifsc', this.bank.ifsc);
                    formData.append('baccount', this.bank.account);
                    formData.append('bpassbook', this.file3);
                    formData.append('btype', this.bank.type);
                    formData.append('bholder', this.bank.holder);
                    formData.append('uniq', this.uniq);                          
                    formData.append('aid', this.aid);

                    formData.append('not_applicable1', this.not_applicable1);
                    formData.append('not_applicable2', this.not_applicable2);
                    formData.append('death', this.file4d);
                    formData.append('death1', this.file5d);

                    formData.append('<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>');

                    axios.post('<?php echo base_url() ?>student/submit-application', formData,
                    { headers: { 'Content-Type': 'multipart/form-data' } })
                    .then(response => {

                        console.log(response)


                        this.loader=false;
                        if(response.data == 'error'){
                            M.toast({html: 'You are not eligible to apply for this scholarship', classes: 'red', displayLength : 5000 });
                        }else if(response.data == '1'){
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
                    self.loader=true;
                    self.institute.talluk='';
                    self.institute.name='';
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/tallukget?id='+self.institute.district.districtId)
                    .then(function (response) {
                        self.loader=false;
                        self.disabledtal=false;
                        self.tallukSelect = response.data;
                    })
                    .catch(function (error) {
                        self.loader=false;
                        self.errormsg = error.response.data.error;
                    })
                },
                tallukgets(){
                    var self= this;
                    self.loader=true;
                    self.industry.talluk = '';
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/tallukget?id='+self.industry.district.districtId)
                    .then(function (response) {
                        self.loader=false;
                        self.disabled1=false;
                        self.tallukSelects = response.data;
                    })
                    .catch(function (error) {
                        self.loader=false;
                        self.errormsg = error.response.data.error;
                    })
                },
                schoolget(type){
                    var self= this; 

                    self.loader=true;
                    self.institute.name='';

                    const formData = new FormData();
                    formData.append('id', self.institute.talluk.tallukId);
                    axios.get('<?php echo base_url() ?>std_application/schoolget?id='+self.institute.talluk.tallukId)
                    .then(function (response) {  
                        self.loader=false; 
                        self.disabledscl = false;
                        self.schoolSelect = response.data;
                    })
                    .catch(function (error) {
                        self.loader=false;
                        self.errormsg = error.response.data.error;
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
                        self.errormsg = error.response.data.error;
                    })
                },
                courseGet(){
                    var self= this; 
                    self.loader=true;
                    self.institute.course ='';
                    self.institute.pclass ='';
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/courseGet?id='+self.institute.grad.id)
                    .then(function (response) { 
                        self.loader=false; 
                         self.disabledcrs=false;

                        self.courseSelect = response.data;
                        if (self.institute.grad.id == 1) {
                            self.crse = true;
                        }else{
                            self.crse = false;
                        }
                    })
                    .catch(function (error) {
                        self.loader=false;
                        self.errormsg = error.response.data.error;
                    })
                },
                classGet(){
                    var self= this; 
                    self.loader=true;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/classGet?id='+self.institute.course.id)
                    .then(function (response) {
                        self.loader=false;
                        self.disabledcls=false;

                        if (self.institute.grad.id != 1) {
                            self.classSelect = response.data;
                        }
                    })
                    .catch(function (error) {
                        self.loader=false;
                        self.errormsg = error.response.data.error;
                    })
                },
                getdata(){
                    var self= this;
                    const formData = new FormData();
                    axios.get('<?php echo base_url() ?>std_application/appliGet')
                    .then(function (response) {

                        console.log(response);

                        if (response.data.notappli =='mother') {
                            self.not_applicable2 =true;
                            self.not_applicable1 =false;
                            self.mdrader = true;
                            self.motherdeath = false;
                            self.fdrader = false;
                            self.fatherdeath = true;
                            self.motherrequire = false;
                            self.fatherrequire = true;
                            self.adhErrorm = '';
                            self.fatherdeathfile = true;

                            if (response.data.deathcertificate !=null && response.data.notappli == 'mother') {
                                self.motherdeathfile = false;
                                self.motherpdffile   = "<?php echo base_url() ?>"+response.data.deathcertificate;
                            }else{
                                self.motherpdffile = "#";
                            }


                        }else if(response.data.notappli =='father'){
                            self.not_applicable1 =true;
                            self.not_applicable2 =false;
                            self.fdrader = true;
                            self.fatherdeath = false;
                            self.mdrader = false;
                            self.motherdeath = true;
                            self.fatherrequire = false;
                            self.motherrequire = true;
                            self.adhErrorf = '';
                            self.motherdeathfile = true;

                            if (response.data.deathcertificate !=null && response.data.notappli == 'father') {
                                self.fatherdeathfile = false;
                                self.fadhrpdffile   = "<?php echo base_url() ?>"+response.data.deathcertificate;
                            }else{
                                self.fadhrpdffile = "#";
                            }
                        }else{
                            self.not_applicable1 =false;
                            self.not_applicable2 =false;
                            self.fdrader = false;
                            self.mdrader = false;
                            self.fatherdeath = true;
                            self.motherdeath = true;
                            self.fatherrequire = false;
                            self.motherrequire = false;
                            self.motherdeathfile = true;
                            self.fatherdeathfile = true;

                        }

                        self.aid =  response.data.aId;
                        //basic details
                        self.student.name    = response.data.name;
                        self.student.phone   = response.data.parent_phone;
                        self.student.father  = response.data.father_name;
                        self.student.mother  = response.data.mothor_name;
                        self.student.address = response.data.saddress;
                        self.student.gend    = response.data.gender;
                        //insttitute details
                        self.institute.name     = '<?php echo (!empty($scholls->school_address))?str_replace(array("\n", "\r"),'',$scholls->school_address):''; ?>';
                        self.institute.talluk   = '<?php echo (!empty($scholls->talluk))?$scholls->talluk:''; ?>';
                        self.institute.district = '<?php echo (!empty($scholls->districtname))?str_replace(array("\n", "\r"),'',$scholls->districtname):''; ?>';
                        if(response.data.course !=''){
                            if (response.data.cLass !='' && response.data.cLass != null) {
                                self.crse = false;
                                self.institute.pclass.id   = response.data.class;
                                self.institute.pclass   = response.data.cLass;
                            }else{
                                self.crse = true;
                            }
                        }else{
                            self.crse = true;
                            // self.institute.pclass.id   = response.data.class;
                        }
                        self.institute.pin      = response.data.ins_pin;
                        self.institute.grad     = response.data.gradutions;
                        self.institute.course   = response.data.corse;
                        self.institute.district.districtId  = response.data.ins_district;
                        self.institute.talluk.tallukId      = response.data.ins_talluk;
                        self.institute.name.sId             = response.data.school_id;
                        self.institute.grad.id              = response.data.graduation;
                        self.institute.course.id            = response.data.course;
                        // self.institute.pclass.id            = response.data.cLass;
                        //caste details
                        if(response.data.is_scst == "1"){
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
                        self.trcategory   = response.data.category;
                        self.gncategory   = response.data.category;


                        if (response.data.cast_certificate !=null) {
                            self.castpdf   = "<?php echo base_url() ?>"+response.data.cast_certificate;
                        }else{
                            self.castpdf = "#";
                        }
                        //previous year class details
                        self.previous.class     = response.data.prv_class;
                        self.previous.marks     = response.data.prv_marks;
                        if (response.data.prv_markcard !=null) {
                            self.mrcard  = "<?php echo base_url() ?>"+response.data.prv_markcard;
                        }else{
                            self.mrcard = "#";
                        }

                        //adhar card
                        self.adhaar.number      = response.data.adharcard_no;
                        if (response.data.adharcard_file !=null) {
                            self.adhrpdf  = "<?php echo base_url() ?>"+response.data.adharcard_file;
                        }else{
                            self.adhrpdf = "#";
                        }

                        self.adhaar.numberm      = response.data.m_adhar;
                        if (response.data.m_adharfile !=null && response.data.notappli != 'mother') {
                            self.madhrpdf  = "<?php echo base_url() ?>"+response.data.m_adharfile;
                        }else{
                            self.madhrpdf = "#";
                        }

                        self.adhaar.fnumber      = response.data.f_adhar;
                        if (response.data.f_adharfile !=null && response.data.notappli != 'father') {
                            self.fadhrpdf  = "<?php echo base_url() ?>"+response.data.f_adharfile;
                        }else{
                            self.fadhrpdf = "#";
                        }


                        //bank details
                        self.bank.name          = response.data.name;
                        self.bank.branch        = response.data.branch;
                        self.bank.ifsc          = response.data.ifsc;
                        self.bank.account       = response.data.acc_no;

                        if(response.data.type == '1'){
                            self.bank.type = 'Parent';
                        }else{
                            self.bank.type = 'Student';
                        }
                        // self.bank.type          = response.data.type;

                        self.bank.holder        = response.data.holder;
                        if (response.data.passbook !=null) {
                            self.bankpdf  = "<?php echo base_url() ?>"+response.data.passbook;
                        }else{
                            self.bankpdf = "#";
                        }
                        //industry details
                        self.industry.working   = response.data.who_working;
                        self.industry.pname     = response.data.indpname;
                        self.industry.salary    = response.data.msalary;
                        self.industry.relation  = response.data.relationship;
                        self.industry.pin       = response.data.indpincode;
                        self.industry.talluk    = response.data.talqName;
                        self.industry.district  = response.data.dstctName;
                        self.industry.name      = response.data.indName;
                        industry.talluk.tallukId            = response.data.indtalluk;
                        industry.name.iId                   = response.data.company_id;
                        self.industry.district.districtId   = response.data.company_id;
                    })
                    .catch(function (error) {
                        // this.errormsg = error.response.data.error;
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