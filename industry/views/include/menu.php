<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left">
                            <ul>
                                <li><a href=" ">Hr List</a></li>
                                <li><a href=" ">Scholarship Request List</a></li>
                                <li><a href=" ">Scholarship Approval List</a></li>
                                <li><a href=" ">Scholarship Reject List</a></li>
                                <li><a href="<?php echo base_url() ?>dashboard"  class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>">Account Settings</a></li>
                                <li><a href="<?php echo base_url() ?>change-password"  class="<?php echo($this->uri->segment(1) == 'change-password') ? 'active' :'' ?>">Change Password</a></li>
                            </ul>
                        </div>
                    </div>
<div v-if="loader" class="loading">Loading&#8230;</div>