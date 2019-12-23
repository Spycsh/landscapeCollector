<?php
    function upload($file, $filePath) {
        $error = $file['error'];
        switch ($error) {
            case 0:
                $fileName = $file['name'];
                $fileTemp = $file['tmp_name'];
                $destination = $filePath . "/" . $fileName;
                move_uploaded_file($fileTemp, $destination);
                return "upload successfully";
            case 1:
                return "exceed upload_max_filesize";
            case 2:
                return "exceed form MAX_FILE_SIZE";
            case 3:
                return "enclose part upload";
            case 4:
                return "Not upload";
        }
    }
?>