<?php
#zigg:ignore
#zigg:slug        = `download`
#zigg:parent      = `stork`

$id = $_GET['id'];

$downloadsFolder = $_SERVER['DOCUMENT_ROOT'] . '/../product-downloads/';

$path = $downloadsFolder . $id . '.zip';

if (!file_exists($path)) {
  return false;
}

header('Content-disposition: attachment; filename=stork.zip');
header('Content-type: ' . $file->file_type);
header('Content-length: ' . filesize($path));

if ($this->useXSendfile) {
  header('X-Sendfile: ' . $path);
}

// Fallback to default PHP readfile functionality when X-Sendfile does nothing
readfile($path);

exit;

?>
