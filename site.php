<?php
echo "<br>";
if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

if (strpos($entry, "html") !== false) {

  echo "<br><a target=_blank href=$entry > $entry </a><br>";

}
        }
    }

    closedir($handle);
}

?>
