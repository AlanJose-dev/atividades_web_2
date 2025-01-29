<?php

namespace App\Enums;

enum UserRolesEnum: string
{
    case ADMIN = 'admin';

    case LIBRARIAN = 'librarian';

    case CLIENT = 'client';
}
