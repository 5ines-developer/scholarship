<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url() ?>dashboard"  class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>">Dashboard</a>
                                </li>
                                <li>
                                <a href="<?php echo base_url() ?>applications?item=pending" class="<?php echo($this->input->get('item') == 'pending') ? 'active' :'' ?>">Pending Application</a>
                                </li>
                                <li>
                                <a href="<?php echo base_url() ?>applications?item=approved" class="<?php echo($this->input->get('item') == 'approved') ? 'active' :'' ?>">Approved Application</a>
                                </li>
                                <li>
                                <a href="<?php echo base_url() ?>applications?item=rejected" class="<?php echo($this->input->get('item') == 'rejected') ? 'active' :'' ?>">Rejected Application</a>
                                </li>
                            </ul>
                        </div>
                    </div>