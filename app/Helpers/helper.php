<?php


namespace App\Helpers;

use App\Entry;
use Illuminate\Support\Carbon;

class helper
{
    static public function getNow() {
        return Carbon::now()->timezone('Europe/Copenhagen');
    }

    static public function getOpenEntry(int $projectId) : ?Entry
    {
        return Entry::whereNull('end')
            ->where('project_id', '=', $projectId)
            ->first();
    }
}
