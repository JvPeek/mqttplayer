<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

$channel = strtolower($_GET['channel']);
$channel = runChannelChecks($channel);

$soundstring = "";
$rawsoundfiles = glob("sounds/" . $channel . "/*.{mp3,webm}", GLOB_BRACE);
foreach ($rawsoundfiles as $soundfile) {
    $soundfile_exp = explode(".", $soundfile);
    $soundstring .= "!" . str_replace("sounds/" . $channel . "/", "", $soundfile_exp[0]) . ", ";
}

echo substr($soundstring, 0, -2);

/*
Functions
*/
function runChannelChecks($channel) {
    if (!isset($channel) || $channel == "")
        return "default-global";

    if (!is_dir("sounds/" . $channel))
        return "default-global";

    return $channel;
}
