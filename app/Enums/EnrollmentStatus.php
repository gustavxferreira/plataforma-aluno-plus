<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended'; 
}
