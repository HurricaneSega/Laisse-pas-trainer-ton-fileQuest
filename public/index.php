<?php
require '../src/uploadFile.php';
include 'header.php';

$upload = new uploadFile();

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $upload->upload($_FILES);
}
?>

<div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3">
        <form action="" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="upload[]" multiple="multiple">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</div>

<div class="row">

    <?php
    $uploadedImagesDirectory = 'upload/';
    $images = scandir($uploadedImagesDirectory); // array

    foreach ($images as $image) :
        if ($image !== '.' && $image !== '..'): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail">
                    <?= '<img src="' . $uploadedImagesDirectory . $image . '" />' ?>
                    <figcaption class="caption">
                        <h3><?= preg_replace('/\\.[^.\\s]{3,4}$/', '', $image) ?></h3>
                        <p>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="delete" value="<?= $uploadedImagesDirectory . $image ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </p>
                    </figcaption>
                </figure>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

</div>

<?php
include 'footer.php';
?>
