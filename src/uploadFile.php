<?php

class uploadFile
{
    const MB = 1048576;

    function upload(array $infoFiles)
    {
        $infoFiles = current($infoFiles);
        $allowedExtensions = ['jpg', 'png', 'gif'];

        foreach ($infoFiles['name'] as $f => $name) {
            $errors = [];

            if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $allowedExtensions)) {
                $errors['type'] = "Le type de $name n'est pas valide";
            }

            if ($infoFiles['size'][$f] > self::MB) {
                $errors['size'] = "$name est trop lourd ";
            }

            if (count($errors) == 0) {
                $oldName = $name;
                $name = "image" . uniqid() . "." . pathinfo($name, PATHINFO_EXTENSION);
                move_uploaded_file($infoFiles['tmp_name'][$f], 'upload/' . $name);
                echo "Upload de $oldName upload réussi ! </br>";
            } else {
                foreach ($errors as $error) {
                    echo $error . '</br>';
                }
            }
        }
    }
}
