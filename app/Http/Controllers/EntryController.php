<?php

namespace App\Http\Controllers;

use App\Entry;
use App\Helpers\helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EntryController extends Controller
{
    public function start(Request $request)
    {
        $projectId = $request->get('projectId');
        $openEntry = helper::getOpenEntry($projectId);

        if ($openEntry != null) {
            return response()->json([
                'status' => 'error',
                'message' => 'There is already an open entry on this project.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entry = Entry::create([
            'start' => helper::getNow(),
            'project_id' => $projectId
        ]);
        $entry->save();

        return response()->json(['status' => 'success']);
    }

    public function stop(Request $request)
    {
        $projectId = $request->get('projectId');
        $openEntry = helper::getOpenEntry($projectId);

        if ($openEntry == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'There is no open entry on this project.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $openEntry->end = helper::getNow();
        $openEntry->save();

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $entry = Entry::find($request->get('id'));
        $entry->delete();

        return response()->json(['status' => 'success']);
    }
}
