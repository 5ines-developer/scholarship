<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left">
                            <ul>
                                <li><a href=" ">Hr List</a></li>
                                <li><a href="<?php echo base_url('application-request') ?>" class="<?php echo($this->uri->segment(1) == 'application-request') ? 'active' :'' ?>">Scholarship Request List</a></li>
                                <li><a href="<?php echo base_url('application-approved') ?>" class="<?php echo($this->uri->segment(1) == 'application-approved') ? 'active' :'' ?>">Scholarship Approved List</a></li>
                                <li><a href="<?php echo base_url('application-rejected') ?>" class="<?php echo($this->uri->segment(1) == 'application-rejected') ? 'active' :'' ?>">Scholarship Reject List</a></li>
                                <li><a href="<?php echo base_url() ?>dashboard"  class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>">Account Settings</a></li>
                            </ul>
                        </div>
                    </div>
<div v-if="loader" class="loading">Loading&#8230;</div>