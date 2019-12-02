<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left">
                            <ul>
                                <li><a href="<?php echo base_url('student/application')?>" <?php if($this->uri->segment(2)=='application'){ echo 'active'; } ?>>Apply Scholarship</a></li>
                                <li><a href="">Scholarship Status</a></li>
                                <li><a href="">Apllication Detail</a></li>
                                <li><a class="active" href="<?php echo base_url('student/profile')?>" <?php if($this->uri->segment(2)=='profile'){ echo 'active'; } ?>>Account Settings</a></li>
                            </ul>
                        </div>
                    </div> 