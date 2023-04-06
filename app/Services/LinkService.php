<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Database\Eloquent\Collection;

class LinkService
{
    public function getLinks(): Collection
    {
        return Link::query()->latest()->get();
    }

    public function storeLink($data): Link
    {
        $link = new Link($data);
        $link->save();
        $link->refresh();
        return $link;
    }

    public function isExpired($link): bool
    {
        $today = now()->format('Y-m-d');
        return $link->expire_at < $today;
    }

    public function handleUsage($link): void
    {
        $link->usage_count++;
        $link->save();
    }
}
