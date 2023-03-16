<?php

namespace App\Services;

use App\Models\{Order,OrderSample,OrderSampleParameter};
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\OrderSampleNotFoundException;
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

	public static function getOrderWithCount(array $relations = [], $order_year=null, $order_status=['pending','progress', 'completed']) {
		$order_year = (is_null($order_year)) ? date('Y') : $order_year;
		$order = Order::withCount(relations: $relations)->whereYear('created_at', $order_year)->whereIn('order_status', $order_status);
		if (!$order) {
			throw new InvalidOrderException(message: 'ไม่พบข้อมูล Order');
		}
		return $order;
	}

	public static function getOrderWithRelations(int $id) {
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

	public static function findOrderSample(int $id) {
		$orderSample = OrderSample::find($id);
		if (!$orderSample) {
			throw new OrderSampleNotFoundException(message: 'ไม่พบข้อมูล Order sample: ' . $id);
		}
		return $orderSample;
	}
}
