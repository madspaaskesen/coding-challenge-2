<?php

namespace App\Http\Controllers;

use App\Helpers\helper;
use App\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function show(int $projectID)
    {
        $project = Project::with('entries')->find($projectID);
        $running = helper::getOpenEntry($projectID) != null;
        return view('projects.show', compact(['project', 'running']));
    }

    public function add(Request $request)
    {
        try {
            Project::create([
                'name' => $request->get('name')
            ]);
            return response()->json(['status' => 'success']);
        }
        catch(QueryException $queryException){
            return $this->queryException($queryException);
        }
    }

    public function update(Request $request)
    {
        try {
            $project = Project::find($request->get('id'));
            $project->name = $request->get('name');
            $project->save();
            return response()->json(['status' => 'success']);
        }
        catch(QueryException $queryException){
            return $this->queryException($queryException);
        }
    }

    public function delete(Request $request)
    {
        $project = Project::with('entries')->find($request->get('id'));
        foreach($project->entries as $entryKey => $entry) {
            $entry->delete();
        }
        $project->delete();
        return response()->json(['status' => 'success']);
    }

    private function queryException(QueryException $queryException) {
        $message = 'Unspecified sql query error';
        if (stripos($queryException->getMessage(), ' Duplicate entry ') !== false) {
            $message = 'Duplicate project names not allowed.';
        }
        else {
            $message .= ': ' . $queryException->getMessage();
        }
        return response()->json(['status' => 'error', 'message' => $message], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
