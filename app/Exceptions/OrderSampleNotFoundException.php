<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;


class OrderSampleNotFoundException extends Exception
{
	public function report() {
		Log::debug('Order sample not found');
	}
}
