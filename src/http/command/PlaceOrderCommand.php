<?php

namespace Eventsourcing;

use Eventsourcing\Http\CheckoutService;
use Slim\Http\Request;

class PlaceOrderCommand {
	
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
	
	public function execute() {
		$this->checkoutService->placeOrder();
	}
}