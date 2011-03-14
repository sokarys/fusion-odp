<?php
$zip = new ZipArchive;
if ($zip->open('test.zip') === TRUE) {
    $zip->extractTo('/mon/dossier/destination/');
    $zip->close();
    echo 'ok';
} else {
    echo 'échec';
}
?>

<?php
$zip = new ZipArchive;
if ($zip->open('test.zip') === TRUE) {
    $zip->addFile('/chemin/vers/index.txt', 'newname.txt');
    $zip->close();
    echo 'ok';
} else {
    echo 'échec';
}
?>

