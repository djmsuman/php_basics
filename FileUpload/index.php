
<?php

if (isset($_POST["upload"])) {
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory.basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

    // Check if image file is an actual image or fake image
    if(isset($_POST["upload"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>File Upload Form</title>
        <style>
            input, button {
                border: 1px solid #000;
                display: block;
            }
            label {
                margin: 5px 0;
                display: block;
            }
            button {
                margin-top: 10px;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <label>Select image to upload:</label>
            <input type="file" name="image" />
            <button type="submit" name="upload">Upload</button>
        </form>
    </body>
</html>
