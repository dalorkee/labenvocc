<?php

namespace App\Enums;

enum CustomerType: string {
	case GOVERNMENT = 'หน่วยงานราชการ';
	case PERSONAL = 'หน่วยงานเอกชน';
	case PRIVATE = 'บุคคลทั่วไป';
}
