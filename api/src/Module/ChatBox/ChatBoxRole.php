<?php

namespace App\Module\ChatBox;

enum ChatBoxRole: string
{
    case Admin = 'Administrator';
    case Guest = 'Guest';
}
