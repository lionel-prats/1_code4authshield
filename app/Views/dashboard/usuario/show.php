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
                    // registros asociados al usuario en auth_groups_users (v182) 
                    foreach($usuario->getGroups() as $g): 
                ?>
                    <?php echo $g; /* $g = auth_groups_user.group */ ?>
                <?php endforeach ?>
                <h4>Permisos</h4>
                <?php 
                    // array con los permisos de un usuario (v182) 
                    // registros asociados al usuario en auth_permissions_users (v182) 
                    foreach($usuario->getPermissions() as $p): 
                ?>
                    <?php echo $p; /* $p = auth_permissions_user.permission */ ?>
                <?php endforeach ?>
            </div>
            <div class="card-header border-top">
                Grupos y permisos disponibles
            </div>
            <div class="card-body">
                <h4>Grupos</h4>
                <?php 
                    // atributo $groups de /app/config/AuthGroups.php (v184) 
                    foreach($groups as $group => $data_group): 
                ?>
                    <?php //echo "$group = " . $data_group["title"] . " (". $data_group["description"] . ")" . "<br>"; ?>
                    <button class="btn btn-primary btn-sm me-2">
                        <?php echo $group; ?>
                    </button>
                <?php endforeach ?>
                <h4>Permisos</h4>
                <?php 
                    ddl($permissions);
                    $old_group = "";
                    // $permissions = atributo $permissions de /app/config/AuthGroups.php (v184) 
                    foreach($permissions as $permission => $data_permission): 
                ?>
                        <?php //echo "$permission = $data_permission<br>"; ?>
                        <?php if($old_group != explode(".", $permission)[0]): ?>
                            <?php $old_group = explode(".", $permission)[0] ?>
                            <h5><?php echo $old_group; ?></h5>
                        <?php endif ?>
                        <button 
                            class="btn-permiso btn btn-success btn-sm me-2"
                            data-permiso="<?php echo $permission; ?>"
                        ><?php echo $permission; ?>
                            <!-- el metodo $usuario->can($permissions[$key]) (AuthGroups.php) valida el permiso pasado como argumento esta asociado a alguno de los grupos asociados al usuario (AuthGroups.php->$groups) (v186) -->
                            
                            <?php if($usuario->can($permission)): ?>
                                <span class="text-danger fw-bold">HABILITADO</span>
                            <?php endif ?>
                        </button>
                <?php endforeach ?>
            </div>
        </div>
        <script>
            document.querySelectorAll(".btn-permiso").forEach((btn) =>{
                btn.addEventListener("click", () =>{

                    // FormData() es una clase que tenemos en JS para manejar la data de un formulario mediante JS (v187)
                    let formData = new FormData(); 
                    formData.append("permiso", btn.getAttribute("data-permiso"));
                    
                    fetch("/dashboard/usuario/<?php echo $usuario->id?>/manejar-permisos", {
                        method: "POST",
                        body: formData,
                    }) .then(res => res.json())
                    .then(res => console.log(res))
                })
            })
        </script>
<?php echo $this->endSection(); ?>