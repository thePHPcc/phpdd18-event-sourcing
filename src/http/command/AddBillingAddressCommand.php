<?php

namespace Eventsourcing;

use Eventsourcing\Http\CheckoutService;
use Slim\Http\Request;

class AddBillingAddressCommand {
	
	/**
	 * @var CheckoutService
	 */
	private $checkoutService;
	
	/**
	 * @author Benedikt Schaller
	 * @param CheckoutService $checkoutService
	 */
	public function __construct(CheckoutService $checkoutService) {
		$this->checkoutService = $checkoutService;
	}
	
	public function execute(Request $request)
	{
		$name = $request->getParam('firstName') . ' ' . $request->getParam('lastName');
		$email = $request->getParam('email');
		$zip = $request->getParam('zip');
		$city = $request->getParam('city');
		$country = $request->getParam('country');
		$street = $request->getParam('address');
		$billingAddress = new BillingAddress($name, $email, $street, $zip, $city, $country);
		$this->checkoutService->setBillingAddress($billingAddress);
	}
}