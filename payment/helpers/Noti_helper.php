<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // protected $ci;
    
    
    if(!function_exists('pay_reminder')) {
        function pay_reminder($regId='') {
            $ci = get_instance();
            $ci->load->model('m_payments');
            $reminder =  $ci->m_payments->pay_reminder($regId);
            return $reminder;
        }
    }

     if(!function_exists('pay_reminders')) {
        function pay_reminders($regId='') {
            $ci = get_instance();
            $ci->load->model('m_payments');
            $reminder =  $ci->m_payments->pay_reminders($regId);
            return $reminder;
        }
    }