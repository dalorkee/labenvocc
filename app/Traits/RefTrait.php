<?php
namespace App\Traits;

trait RefTrait {
	public function agencyType(): array {
		return ['state_agency' => 'หน่วยงานภาครัฐ', 'state_enterprise' => 'หน่วยงานรัฐวิสาหกิจ', 'private_agency' => 'หน่วยงานเอกชน'];
	}

	public function titleName(): array {
		return [1 => 'ด.ช', 2 => 'ด.ญ', 3 => 'นาย', 4 => 'นาง', 5 => 'นางสาว'];
	}
}
?>