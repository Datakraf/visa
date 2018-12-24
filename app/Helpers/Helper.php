<?php

use Carbon\Carbon;

function setDateObject($value)
{
    return Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
}

function getDiffDays($df, $dt)
{
    return Carbon::parse($df)->diffInDays(Carbon::parse($dt));
}

function getEventTotalDays($travel)
{
    $df = setDateObject($travel->event_start_date);
    $dt = setDateObject($travel->event_end_date);
    return getDiffDays($df, $dt);
}

function getTravelTotalDays($travel)
{
    $df = setDateObject($travel->travel_start_date);
    $dt = setDateObject($travel->travel_end_date);
    return getDiffDays($df, $dt);
}