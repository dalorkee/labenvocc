<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;


class IsOrderConfirmed
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next) {
		if ($this->isOrderConfirmed(order_id: $request->order_id)) {
			return redirect()->route(route: 'customer.index');
		} else {
			return $next($request);
		}
	}

	private function isOrderConfirmed($order_id): bool {
		$order = Order::select('id')->whereId($order_id)->whereNotNull('order_confirmed')->count();
		if ($order > 0) {
			return true;
		} else {
			return false;
		}
	}
}
