<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkCollection;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::all();
        return Response::success('Links list', ['links' => new LinkCollection($links)]);
//        return Response::success('Links list', ['links' => LinkResource::collection($links)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request)
    {
        $link = new Link($request->validated());
        $link->save();
        $link->refresh();
        return Response::success('Link created', ['link' => new LinkResource($link)]);
    }

    public function redirect(Link $link)
    {
        $today = now()->format('Y-m-d');

        if($link->expire_at < $today)
            abort(422, 'Your Code is Expired!');

        $link->usage_count++;
        $link->save();
        return redirect()->away($link->target_url);
    }
}
