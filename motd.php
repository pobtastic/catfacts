<?php
/**
 * @file
 * Trolling script to gather a random cat-fact for the
 * "Message-of-the-day" system action.
 */

define('CATFACTURI', 'http://catfacts-api.appspot.com/api/facts');
define('CATFACTMETHOD', 'echo');

if (is_connected()) {
  if ($fetch = file_get_contents(CATFACTURI)) {
    $data = json_decode($fetch);
    if (!empty($data->success) && $data->success == 'true') {
      action_data($data->facts[0], CATFACTMETHOD);
    }
  }
}

/**
 * Outputs the fact.
 */
function action_data($fact, $type = NULL) {
  switch ($type) {
    case 'say':
      exec('say ' . escapeshellarg($fact));
      break;
    default:
      echo $fact . PHP_EOL;
      break;
  }
}

/**
 * Test whether we're connected to the interwebs by opening a connection to google
 * which we can assume is more available than the Cat Facts feed.
 */
function is_connected() {
  $connected = @fsockopen('www.google.com', 80);
  if ($connected) {
    fclose($connected);
    return TRUE;
  }
  return FALSE;
}
