<?php

namespace App\Dto\Base;

use App\Dto\Dto;

class ResponseDto extends Dto
{
    protected int $success;
    protected int $status_code;
    protected string $message;
    protected ?array $data = null;
}
