<?php

declare(strict_types=1);

namespace App\Repository\Api;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PageableInterface
{
    public const DEFAULT_PAGE = 1;

    public const DEFAULT_PER_PAGE = 6;

    public const DEFAULT_SORT = 'created_at';

    public const DEFAULT_DIRECTION = 'desc';


}
