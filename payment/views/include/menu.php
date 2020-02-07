<div class="col s12 m3 hide-on-med-and-down">
                        <div class="menu-left">
                            <ul>
                                <li><a href="<?php echo base_url('payment-list')?>">Payment List</a></li>
                                <li><a href="<?php echo base_url('make-payment') ?>">Make Payment</a></li>
                                <li><a href="<?php echo base_url() ?>dashboard"  class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>">Account Settings</a></li>
                            </ul>
                        </div>
                    </div>
<div v-if="loader" class="loading">Loading&#8230;</div>