<?php echo $this->extend("Layouts/web"); ?>
<?php echo $this->section("contenido"); ?>
    <?php foreach($usuarios as $u): ?>
        <div class="card bg-light my-4">
            <div class="card-header">
                <?php echo $u->username; ?>
            </div>
            <div class="card-body">...</div>
            <div class="card-footer">
                <a href="#" class="btn btn-primary">Grupos y permisos</a>
            </div>
        </div>
    <?php endforeach ?>
<?php echo $this->endSection(); ?>