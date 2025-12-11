<?php

class FileUpload {

    public static function uploadImage($file, $folder = "assets/courses/")
    {
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($ext), $allowed)) {
            return false;
        }

        $newName = time() . '_' . uniqid() . '.' . $ext;
        $path = $folder . $newName;
        move_uploaded_file($file['tmp_name'], $path);

        return $path;
    }

    public static function uploadMaterial($file, $folder = "assets/materials/")
    {
        $allowed = ['pdf', 'docx', 'pptx'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($ext), $allowed)) {
            return false;
        }

        $newName = time() . '_' . uniqid() . '.' . $ext;
        $path = $folder . $newName;
        move_uploaded_file($file['tmp_name'], $path);

        return $path;
    }
}
