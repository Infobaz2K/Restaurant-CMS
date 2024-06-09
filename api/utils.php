<?php

function handleFileUpload($fileInputName, $targetDir) {
    $target_file = null;

    if ($_FILES[$fileInputName]["size"] > 0) {

        $file_extension = strtolower(pathinfo($_FILES[$fileInputName]["name"], PATHINFO_EXTENSION));

        if (in_array($file_extension, array("jpg", "jpeg", "png"))) {

            $target_file = $targetDir . basename($_FILES[$fileInputName]["name"]);
            move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file);

        }
    }

    return $target_file;
}

?>
