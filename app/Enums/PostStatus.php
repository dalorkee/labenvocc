<?php

namespace App\Enums;

enum PostStatus: string
{
	case preparing = 'เตรียมจัดส่ง';
	case in_transit = 'กำลังเดินทาง';
	case received = 'ถึงผู้รับ';
	case unknown = 'ไมทราบ';
}
