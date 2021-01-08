<?php

namespace Objectiv\Plugins\Checkout\Action;

/**
 * Class AccountExistsAction
 *
 * @link checkoutwc.com
 * @since 1.0.0
 * @package Objectiv\Plugins\Checkout\Action
 * @author Brandon Tassone <brandontassone@gmail.com>
 */
class AccountExistsAction extends CFWAction {

	/**
	 * AccountExistsAction constructor.
	 *
	 * @param $id
	 * @param $no_privilege
	 * @param $action_prefix
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct( $id, $no_privilege, $action_prefix ) {
		parent::__construct( $id, $no_privilege, $action_prefix );
	}

	/**
	 * Checks whether the account exists on the website or not
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function action() {
		$email = $_POST['email'] ?? '';

		$this->out(
			array(
				'account_exists' => (boolean) apply_filters( 'cfw_email_exists', email_exists( $email ), $email ),
			)
		);
	}
}
