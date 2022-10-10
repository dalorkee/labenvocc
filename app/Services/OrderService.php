<?php

namespace App\Services;

use App\Models\Order;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\InvalidOrderException;

class OrderService
{
	public static function get(int $id) {
		$order = Order::find($id);
		if (!$order) {
			throw new OrderNotFoundException(message: 'ไม่พบข้อมูล Order id: ' . $id);
		}
		return $order;
	}

	public static function getOrderWithCount(array $relations = []) {
		$orders = Order::withCount(relations: $relations);
		if (!$orders) {
			throw new InvalidOrderException(message: 'ไม่พบข้อมูล Orders');
		}
		return $orders;

	}
}
