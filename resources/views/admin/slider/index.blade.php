<?php
echo $message . '<br/>';

$linkIndex = route('slider');
$linkForm = route('slider/form', ['id' => 123]);
$linkStatus = route('slider/change-status', ['id' => 123, 'status' => 'inactive']);

echo $linkIndex . '<br/>';
echo $linkForm . '<br/>';
echo $linkStatus . '<br/>';
echo $controllerName . '<br/>';
