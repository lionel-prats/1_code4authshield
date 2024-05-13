<?php echo $this->extend("Layouts/web"); ?>

<?php echo $this->section("contenido"); ?>
    <?php foreach($usuarios as $u): ?>
        <div class="card bg-light my-4">
            <div class="card-header">
                <?php echo $u->username; ?>
            </div>
            <div class="card-body">...</div>
            <div class="card-footer">
                <a 
                    class="btn btn-primary me-4"
                    href="<?php echo route_to("usuario.show", $u->id); ?>" 
                >Grupos y permisos</a>
                <a 
                    class="btn btn-success me-4 fw-bold"
                    target="_blank"
                    href="<?php echo route_to("usuario.gestionar_grupos", $u->id); ?>" 
                >Gestiar grupos (v186)</a>
                <a 
                    class="btn btn-warning me-4 fw-bold"
                    target="_blank"
                    href="<?php echo route_to("usuario.gestionar_permisos", $u->id); ?>" 
                >Gestiar permisos (v186)</a>
            </div>
        </div>
    <?php endforeach ?>
<?php echo $this->endSection(); ?>