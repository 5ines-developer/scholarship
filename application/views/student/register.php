<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Stacked form</h2>
      <form action="<?php echo base_url()?>student/submit-register" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="fname">First Name:</label>
          <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" required="">
          <span class="error"><?php echo form_error('fname'); ?></span>
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" required="">
          <span class="error"><?php echo form_error('lname'); ?></span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="">
          <span class="error"><?php echo form_error('email'); ?></span>
        </div>
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="number" class="form-control" id="phone" placeholder="Enter phone" name="phone" required="">
          <span class="error"><?php echo form_error('phone'); ?></span>
        </div>
        <div class="form-group">
          <label for="pswd">Password:</label>
          <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required="">
          <span class="error"><?php echo form_error('pswd'); ?></span>
        </div>
        <div class="form-group">
          <label for="cpwd">Confirm Password:</label>
          <input type="password" class="form-control" id="cpwd" placeholder="Confirm the password" name="cpwd" required="">
          <span class="error"><?php echo form_error('cpwd'); ?></span>
        </div>
        <div class="form-group form-check">
          <label for="school">School:</label>
          <select class="form-control" id="school" name="school" required="">
            <?php
            if (!empty($school)) {
              foreach ($school as $schl => $schls) {
                echo '<option value="'.$schls->sId.'">'.$schls->sName.'</option>';
              }
            }
            ?>
          </select>
          <span class="error"><?php echo form_error('school'); ?></span>
        </div>
        <div class="form-group form-check">
          <label for="company">Company:</label>
          <select class="form-control" id="company" name="company" required="">
            <?php
            if (!empty($industry)) {
              foreach ($industry as $ind => $indus) {
                echo '<option value="'.$indus->iId.'">'.$indus->iName.'</option>';
              }
            }
            ?>
          </select>
          <span class="error"><?php echo form_error('company'); ?></span>
        </div>
        <div class="form-valdation-error">
          <?php echo ($this->session->flashdata('error'))? '<span class="error">'.$this->session->flashdata('error').'</span>' : '' ?>

          <?php echo ($this->session->flashdata('success'))? '<span class="success">'.$this->session->flashdata('success').'</span>' : '' ?>
          
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>