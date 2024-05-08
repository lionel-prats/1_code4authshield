<?php echo $this->extend("Layouts/web"); ?>

<?php echo $this->section("contenido"); ?>
    <h3><?php echo $title; ?></h3>
    <p><?php echo $content; ?></p>
<?php echo $this->endSection(); ?>
