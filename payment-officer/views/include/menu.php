<div class="col s12 m3 hide-on-med-and-down">
    <div class="menu-left men-hgh">
    <ul class="men-ul">
        <li><a href="<?php echo base_url() ?>dashboard" class="<?php echo($this->uri->segment(1) == 'dashboard') ? 'active' :'' ?>"><i class="material-icons"> dashboard </i>Dashboard</a></li>

        <ul class="collapsible men-lft">

            <li class="cpay-m">
              <div class="collapsible-header"><i class="material-icons">card_membership</i>Contribution Payment</div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>industry-payment" class="<?php echo (($this->uri->segment(1) == 'industry-payment')) ? 'active' :'' ?>">Industry Contribution</a></span></div>
              <div class="collapsible-body"><span><a href="<?php echo base_url() ?>pending-payment" class="<?php echo (($this->uri->segment(1) == 'pending-payment')) ? 'active' :'' ?>">Contribution Pending</a></span></div>
            </li>


        </ul>

    </ul>
</div>
</div>