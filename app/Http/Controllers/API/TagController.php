<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Response;


class TagController extends BaseController
{
    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    /**
     * TagController constructor.
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response|object
     *  Get tag api
     * Method Get
     */
    public function getAllTag()
    {
        $tags = $this->tagRepository->getAllTag();
           return $this->response($tags)->setStatusCode(Response::HTTP_OK );
    }
}
