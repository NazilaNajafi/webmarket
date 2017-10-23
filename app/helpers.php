<?php
function flash($level,$title,$message)
{
    $flash = app('App\Http\Flash');
    return $flash->info($level,$title,$message);
}