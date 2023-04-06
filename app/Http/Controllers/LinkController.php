<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkCollection;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    public function __construct(protected LinkService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = $this->service->getLinks();
        return Response::success('Links list', ['links' => new LinkCollection($links)]);
//        return Response::success('Links list', ['links' => LinkResource::collection($links)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request)
    {
        $link = $this->service->storeLink($request->validated());
        return Response::success('Link created', ['link' => new LinkResource($link)]);
    }

    public function redirect(Link $link)
    {
        if($this->service->isExpired($link))
            abort(422, 'Your link is Expired!');

        $this->service->handleUsage($link);

        return redirect()->away($link->target_url);
    }
}
