<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;

class TimerService
{

    public function getUserTotalDuration($user_id, $date_from = null, $date_to = null, $project_id = null)
    {
        if ($project_id) {
        $project = Project::find($project_id);
            $query = $project->timers();
        } else {
            $query = User::find($user_id)->timers();
        }

        if ($date_from) {
            $query->where('task_timers.created_at', '>=', $date_from);
        }

        if ($date_to) {
            $query->where('task_timers.created_at', '<=', $date_to);
        }


        $timers = $query->get();



      $duration = 0;
      if($timers)
      {
          foreach ($timers as $timer){
              if($timer->state == 'started'){
                  $timeElapsed = $timer->started_at->diffInSeconds(now()) + $timer->current_duration;
              }else{
                  $timeElapsed = $timer->current_duration;
              }
            $duration += $timeElapsed;
          }


          $hours = floor($duration / 3600);
          $minutes = floor(($duration % 3600) / 60);
          $seconds = $duration % 60;
          return ['h'=>$hours, 'm'=>$minutes, 's'=>$seconds];
      }
      return null;
    }

    public function isUserHasActiveTimer($user_id) : bool
    {
       return User::find($user_id)->timers()->where('state', '=', 'started')->get()->count() > 0;
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
