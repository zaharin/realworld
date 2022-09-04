<?php

namespace Src\ModUnits\Article;

use OpenApi\Attributes as OA;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Src\Bases\BaseController;
use Src\ModUnits\Article\Requests\ArticleCreateRequest;
use Src\Shared\Dto\Responses\WrapResponseDto;

#[OA\Tag(name: 'article', description: 'Article')]
#[Prefix('articles')]
#[Middleware('auth:api')]
class ArticleController extends BaseController
{
    #[Post('')]
    public function store(ArticleCreateRequest $request, ArticleService $service)
    {
        $article = $service->store($request->data());

        return WrapResponseDto::make('article', $article);
    }
}
