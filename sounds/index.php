<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$channel = strtolower($_GET['channel']);
$channel = runChannelChecks($channel);

$rawsoundfiles = glob($channel . "/*.{mp3,webm}", GLOB_BRACE);
$i = 0;
foreach ($rawsoundfiles as $soundfile) {
    $soundfile_exp = explode(".", $soundfile);

    $soundfiles[$i]['num'] = $i;
    $soundfiles[$i]['filename'] = $soundfile;
    //$soundfiles[$i]['hash'] = hash_file('sha256', $soundfile);
    $soundfiles[$i]['key'] = str_replace($channel . "/", "", $soundfile_exp[0]);
    $soundfiles[$i]['filetype'] = $soundfile_exp[1];
    $i++;
}

echo json_encode($soundfiles);

/*
Functions
*/
function runChannelChecks($channel) {
    if (!is_dir("./" . $channel))
        return "default-global";

    if (!isset($channel) || $channel == "")
        return "default-global";

    return $channel;
}
