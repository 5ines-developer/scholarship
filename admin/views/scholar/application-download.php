<?php
$this->ci =& get_instance();
$this->load->model('m_scholar');
?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <meta charset="UTF-8">
      <meta name="description" content="Free Web tutorials">
      <meta name="keywords" content="HTML,CSS,XML,JavaScript">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="<?php echo $this->config->item('web_url') ?>assets/fonts/css/all.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('web_url') ?>assets/css/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('web_url') ?>assets/css/style.css">
      <!-- bar -->
      <style>
        /* .bordered tr{border: 1px solid gray; } 
        .brt{border-right: 1px solid gray; }
        .brb{ border-bottom: 1px solid gray; }
        .no-border-b{ border-bottom :  none !important; }
        .no-border-t{ border-top :  none !important; }
        .no-border-tb{ border-top :  none !important; border-bottom :  none !important; } */
        table tr td {font-size: 13px; font-weight: 600;}
        td, th {

    padding: 8px 5px; }


     </style>
   </head>
   <body>
    
      <!-- first layout -->
        <section class="sec-top">
            <div class="container-wrap">
                <div class="col l12 m12 s12">
                    <div class="row">
                        <div class="col m12 s12 l8 offset-l2">

                            <div class="card">
                                <div class="card-content">
                                    <div class="form-container">

                                      
      <table class="bordered">
        <tbody>
          <tr>
            <td colspan="3" style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: 1px solid gray;border-right:1px solid gray;" >ONLINE SCHOLARSHIP APPLICATION FORM</td>
          </tr>
           <tr style="border: 1px solid gray;">
              <td style="border:1px solid gray;" colspan="3"><img class="p-image" width="100px" src="<?php echo $this->config->item('web_url') ?>/assets/img/logo.png" alt=""><br>
              Karnataka Labour Welfare Board<br><br>
              ಸಂಘಟಿತ ಕಾರ್ಮಿಕರ ಮಕ್ಕಳಿಂಧ ಪ್ರೋತ್ಸಹ ಧನ ಸಹಾಯಕಾಗಿ ಅರ್ಜಿ
            </td>
          </tr> 

          <!-- student Details -->
          <tr>
            <th align="left" colspan="3" style="padding:25px;padding-left:15px;border:none;" >Student Personal Details</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Student Name : <?php echo (!empty($result->name))?$result->name:''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Father Name : <?php echo (!empty($result->father_name))?$result->father_name:''; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Mother Name : <?php echo (!empty($result->mothor_name))?$result->mothor_name:''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Mobile Number : <?php echo (!empty($result->parent_phone))?$result->parent_phone:''; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Gender : <?php echo (!empty($result->gender))?$result->gender:''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Graduation : <?php echo (!empty($result->gradutions))?$result->gradutions:''; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Present class/ Course : <?php echo (!empty($result->corse))?$result->corse:''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Present School Name : <?php echo $this->ci->m_scholar->schlName($result->school_id) ?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Present School Address : <?php echo $this->ci->m_scholar->schlAddress($result->school_id) ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Student Present Address : <?php echo (!empty($result->saddress))?$result->saddress:''; ?></td>
          </tr>

          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Submitted On: <?php echo (!empty($result->date))?date('d M, Y',strtotime($result->date)):''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Application Year: <?php echo (!empty($result->application_year))?$result->application_year:''; ?> </td>
          </tr>
          

          <!-- student Previous Year Class Details -->
          <tr>
            <th align="left" colspan="3" style="padding:25px;padding-left:15px;border:none;" >Previous Year Class and Marks</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Class Name : <?php echo (!empty($result->prv_class))?$result->prv_class:''; ?> </td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Marks : <?php echo (!empty($result->prv_marks))?$result->prv_marks:''; ?></td>
          </tr>
          <tr>
            <td colspan="3" align="left" style="border:1px solid gray;" >Marks card Copy: <?php echo (!empty($result->prv_markcard))?'Submitted':'Not Submitted'; ?> </td>
          </tr>
          <tr>
            <th align="left" colspan="3" style="padding:25px;border:none;padding-left:15px;" >Scheduled Caste / Scheduled Tribes? Certificate</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Scheduled Caste / Scheduled Tribes : <?php echo (!empty($result->is_scst))?'Yes':'No'; ?></td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Category : <?php echo (!empty($result->category))?$result->category:''; ?></td>
          </tr>
          <tr>
            <td colspan="3" align="left" style="border:1px solid gray;" >Caste Certificate File/ Number: <?php echo (!empty($result->is_scst))?'Submitted':'Not Submitted'; ?> </td>
          </tr>


          <!-- Industry Details -->
          <tr>
            <th align="left" colspan="3" style="padding:25px;border:none;padding-left:15px;" >Industry Detail</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Parent / Guardian Name  : <?php echo (!empty($result->pName))?$result->pName:'---'; ?></td>
            <td style="border-top: 1px solid gray;border-bottom: 1px solid gray;border-left: none;border-right: 1px solid gray;" align="left">Who is Working : <?php if(!empty($result->who_working)){if($result->who_working =='1'){ echo 'Father'; }elseif($result->who_working =='2'){ echo 'mother'; }else{ echo 'Parent'; }  }else{echo '---'; } ?></td> 
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Relationship between student & parent : <?php echo (!empty($result->relationship ))?$result->relationship:'---'; ?> </td>
            <td  align="left" style="border:1px solid gray;" >Monthly Salary : <?php echo (!empty($result->msalary ))?$result->msalary:'---'; ?> </td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Industry Name : <?php echo (!empty($result->indName ))?$result->indName:'---'; ?> </td>
            <td  align="left" style="border:1px solid gray;" >Taluk : <?php echo (!empty($result->talqName))?$result->talqName:'---'; ?> </td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >District : <?php echo (!empty($result->dstctName))?$result->dstctName:'---'; ?> </td>
            <td  align="left" style="border:1px solid gray;" >Pin Code : <?php echo (!empty($result->indPincode))?$result->indPincode:'---'; ?> </td>
          </tr>

           <!-- Aadhaar card Details -->
          <tr>
            <th align="left" colspan="3" style="padding:25px;border:none;padding-left:15px;" >Aadhaar card Details</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Aadhaar  : <?php echo (!empty($result->adharcard_no))?$result->adharcard_no:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >Aadhaar card File : <?php echo (!empty($result->adharcard_file))?'Submitted':'Not Submitted'; ?> </td>
          </tr>

          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Father's Aadhaar Number : <?php echo (!empty($result->f_adhar))?$result->f_adhar:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >Father's Aadhaar card File : <?php echo (!empty($result->f_adharfile))?'Submitted':'Not Submitted'; ?> </td>
          </tr>

          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Mother's Aadhaar  : <?php echo (!empty($result->m_adhar))?$result->m_adhar:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >Mother's Aadhaar card File : <?php echo (!empty($result->m_adharfile))?'Submitted':'Not Submitted'; ?> </td>
          </tr>



          <!-- Bank Details -->
          <tr>
            <th align="left" colspan="3" style="padding:25px;padding-left:15px;border:none;" >Bank Details</th>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Bank name  : <?php echo (!empty($result->bnkName))?$result->bnkName:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >Branch name  : <?php echo (!empty($result->branch))?$result->branch:'---'; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Account Type  : <?php echo (!empty($result->holder))?$result->holder:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >Account Holder name : <?php echo (!empty($result->holder))?$result->holder:'---'; ?> </td>
          </tr>
          <tr>
            <td colspan="2" align="left" style="border:1px solid gray;" >Account Number : <?php echo (!empty($result->acc_no))?$result->acc_no:'---'; ?></td>
            <td colspan="1" align="left" style="border:1px solid gray;" >IFSC Code No : <?php echo (!empty($result->ifsc))?$result->ifsc:'---'; ?> </td>
          </tr>
          <tr>
            <td colspan="3" align="left" style="border:1px solid gray;" >Passbook Front Page Copy : <?php echo (!empty($result->passbook))?'Submitted':'No Submitted'; ?></td>
          </tr>
        </tbody>        
      </table>
    


                                          </div>
                                    </div>
                                </div>
                            </div><!-- cad end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/jquery-3.3.1.min.js"></script> -->
        <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/materialize.min.js"></script>
        <!-- <script type="text/javascript" src="<?php echo $this->config->item('web_url') ?>assets/js/script.js"></script> -->
        <!-- <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script> -->


        
    </body>
</html>