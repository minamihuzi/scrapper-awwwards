<?php
/**
 * Format class
 *
 * Help convert between various formats such as XML, JSON, CSV, etc.
 *
 * @author  	Phil Sturgeon
 * @license		http://philsturgeon.co.uk/code/dbad-license
 */
class Auth {
	public function Validate() {
		// Stupid stuff to emulate the "new static()" stuff in this libraries PHP 5.3 equivalent
		$CI = get_instance();
		if($CI->session->userdata('authkey') == "Confirmed")
			return true;
		return false;
	}

	public function getUserInfo() {
		$CI = get_instance();
		if($user = $CI->session->userdata('user')) 
			return $user;
		return null;
	}

	public function getUserId() {
		$CI = get_instance();
		if($user = $CI->session->userdata('user')) 
			return $user->id;
		return 0;
	}

	public function isAdmin() {
		$admin = $this->getUserInfo();
		if(!$admin || !$admin->is_admin) {
			return false;
		}
		return true;
	}
 }