<?php

namespace App\Traits;

trait ColorTrait {

	public function colorClass(): array {
		return [
			'white' => 'bg-white border-primary text-primary',
			'blue' => 'bg-primary border-primary text-white',
			'purple' => 'bg-info border-info text-white',
			'green' => 'bg-success border-success text-white',
			'orange' => 'bg-warning text-dark border-warning',
			'red' => 'bg-danger border-danger text-white',
		];
	}
}
