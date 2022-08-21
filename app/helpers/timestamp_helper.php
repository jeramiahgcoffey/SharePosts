<?php
function timestamp($datetime)
{
  return DateTime::createFromFormat(
    'Y-m-d H:i:s',
    $datetime
  )
    ->format('m/d/Y h:i A');
}
