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
                                <ul class="collapsible men-lft">
                                    <li class="rpt-m">
              <div class="collapsible-header"><i class="material-icons">report</i>Reports</div>

              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports" class="<?php echo($this->uri->segment(1) == 'reports' && (empty($this->input->get('item'))) ) ? 'active' :'' ?>">Total Scholarship Request</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=pending" class="<?php echo($this->input->get('item') == 'pending') ? 'active' :'' ?>">Total Pending Scholarship</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=approved" class="<?php echo($this->input->get('item') == 'approved') ? 'active' :'' ?>">Total Approved Scholarship</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>reports?item=rejected" class="<?php echo($this->input->get('item') == 'rejected') ? 'active' :'' ?>">Total Rejected Scholarship</a></span></div>
            </li>


                                </ul>
                            </ul>
                        </div>
                    </div>