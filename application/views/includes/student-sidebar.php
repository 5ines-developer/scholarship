<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left std-side">
                            <ul>
                                <li><a class="<?php if($this->uri->segment(2) == 'applicationl'){ echo 'active'; } ?>" href="<?php echo base_url('student/application')?>" <?php if($this->uri->segment(2)=='application'){ echo 'active'; } ?>>Apply Scholarship</a></li>
                                <li><a class="<?php if($this->uri->segment(2) == 'application-status'){ echo 'active'; } ?>" href="">Scholarship Status</a></li>
                                <li><a class="<?php if($this->uri->segment(2) == 'application-detail'){ echo 'active'; } ?>" href="<?php echo base_url('student/application-detail') ?>">Apllication Detail</a></li>
                                <li><a class="<?php if($this->uri->segment(2) == 'profile'){ echo 'active'; } ?>" href="<?php echo base_url('student/profile')?>" <?php if($this->uri->segment(2)=='profile'){ echo 'active'; } ?>>Account Settings</a></li>
                            </ul>
                        </div>
                    </div> 
<div v-if="loader" class="loading">Loading&#8230;</div>