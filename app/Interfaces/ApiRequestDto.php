<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ApiRequestDto
{
    public static function fromApiRequest(Request $request): self;
}
