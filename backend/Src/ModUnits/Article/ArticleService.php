<?php

namespace Src\ModUnits\Article;

use App\Models\Article;
use Src\Bases\BaseService;

class ArticleService extends BaseService
{
    public function __construct()
    {
    }

    public function store(Dto\ArticleUpdateRequestDto $data): Article
    {
        //Article::create($)
    }
}
