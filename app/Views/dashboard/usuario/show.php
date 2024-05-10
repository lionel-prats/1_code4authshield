<?php echo $this->extend("Layouts/web"); ?>

<?php echo $this->section("contenido"); ?>
        <div class="card bg-light my-4">
            <div class="card-header">
                <?php echo $usuario->username; ?>
            </div>
            <div class="card-body">
                <h4>Grupos</h4>
                <?php 
                    // array con los grupos de un usuario (v182) 
                    foreach($usuario->getGroups() as $g): 
                ?>
                    <?php echo $g; /* $g = auth_groups_user.group */ ?>
                <?php endforeach ?>
                <h4>Permisos</h4>
                <?php 
                    // array con los permisos de un usuario (v182) 
                    foreach($usuario->getPermissions() as $p): 
                ?>
                    <?php echo $p; /* $p = auth_permissions_user.permission */ ?>
                <?php endforeach ?>
            </div>
        </div>
<?php echo $this->endSection(); ?>