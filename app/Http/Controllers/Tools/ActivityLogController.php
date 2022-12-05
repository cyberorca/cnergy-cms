<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $activity = Activity::with('causer')->orderBy("id", "desc")->latest();


        if ($request->get('inputName')) {
            $name = $request->get('inputName');
            $activity->whereHas('causer', function ($query) use ($name) {
              $query->where('name','like','%' .$name. '%' );
            });
        }

        if ($request->get('startDate') && $request->get('endDate')) {
            $startDate = Carbon::parse(($request->get('startDate')))
                ->toDateTimeString();

            $endDate = Carbon::parse($request->get('endDate'))
                ->toDateTimeString();
            $activity->whereBetween('created_at', [
                $startDate, $endDate
            ]);
        }

        if ($request->get('modelType')) {
            $activity->where('log_name', '=', $request->modelType);
        }

        if ($request->get('inputModelID')) {
            $activity->where('subject_id', '=', $request->inputModelID);
        }

        return view('tools.activity-log.index', [
            'activity' => $activity->paginate(10)->withQueryString(),
            'modelType' => ['news', 'photonews', 'videonews', 'category', 'static page', 'user', 'image', 'frontend setting', 'frontend menu']
        ]);
    }
}
