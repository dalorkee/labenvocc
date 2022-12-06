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

	public static function getOrderWithCount(array $relations = [], $year='0000') {
		$order = Order::withCount(relations: $relations)->whereYear('created_at', $year);
		if (!$order) {
			throw new InvalidOrderException(message: 'ไม่พบข้อมูล Order');
		}
		return $order;
	}

	public static function getOrderWithRelations(int $id) {
		// $str = '"' . implode ('", "', $relations) . '"';
		$order = Order::whereId($id)->with('orderSamples', 'parameters')->get();
		if (!$order) {
			throw new InvalidOrderException(message: 'ไม่พบข้อมูล Order');
		}
		return $order;
	}

	public static function create() {
		$order = new Order();
		if (!$order) {
			throw new InvalidOrderException(message: 'สร้าง Order Model ไม่ได้');
		}
		return $order;
	}
}
