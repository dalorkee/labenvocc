<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;


class OrderNotFoundException extends Exception
{
	public function report() {
        //
	}
}
