<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verification extends CI_Controller
{

public function userExpired()
    {
        $this->load->load('Verification_model');
        $users = $this->Verification_model->getUnverifiedUsers();
        foreach ($users as $user) {
            $this->Verification_model->expireUsers($user->id);
        }
    }

}