<?php

namespace App\Http;


class Flash
{
    public function info($level,$title, $message)
    {
        session()->flash('flash_message', [
            'level' => $level,
            'title' => $title,
            'message' => $message

        ]);
    }

}