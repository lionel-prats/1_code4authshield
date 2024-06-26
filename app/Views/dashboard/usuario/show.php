<?php echo $this->extend("Layouts/web"); ?>

<!-- protejo el bloque JS, que permite modificar permisos del usuario del detalle, de forma que solo pueda acceder a esta funcionalidad un usuario logueado con con los permisos adecuados -->
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

            <h4>Grupos (AuthGroups->groups)</h4>
            <?php 
                // atributo $groups de /app/config/AuthGroups.php (v184) 
                foreach($groups as $group => $data_group): 
                    // ddl($group);
            ?>
                <?php //echo "$group = " . $data_group["title"] . " (". $data_group["description"] . ")" . "<br>"; ?>
                <button 
                    class="btn-grupo btn btn-primary btn-sm me-2 <?php echo $usuario->inGroup($group) ?  "border-5 border-danger":""; ?>"
                    data-grupo="<?php echo $group; ?>"
                ><?php echo $data_group["title"]; ?>
                </button>
            <?php endforeach ?>

            <h4 class="mt-5">Permisos (AuthGroups->permissions)</h4>
            <?php 
                // ddl($permissions);
                $old_group = "";
                // $permissions = atributo $permissions de /app/config/AuthGroups.php (v184) 
                foreach($permissions as $permission => $data_permission): 
            ?>
                    <?php //echo "$permission = $data_permission<br>"; ?>
                    <?php if($old_group != explode(".", $permission)[0]): ?>
                        <?php $old_group = explode(".", $permission)[0] ?>
                        <h5><?php echo $old_group; ?></h5>
                    <?php endif ?>
                    <div class="d-flex mb-2 ms-4">
                        <button 
                            class="btn-permiso btn btn-success btn-sm me-2 <?php echo $usuario->can($permission)?"border-5 border-danger":""; ?>"
                            data-permiso="<?php echo $permission; ?>"
                        ><?php echo $permission; ?>
                            <!-- el metodo $usuario->can($permissions[$key]) (AuthGroups.php) valida el permiso pasado como argumento esta asociado a alguno de los grupos asociados al usuario (AuthGroups.php->$groups) (v186) -->
                            <span class="text-danger fw-bold">
                                <?php echo $usuario->can($permission)?"HABILITADO":""; ?>
                            </span>
                        </button>
                    </div>
            <?php endforeach ?>

            <h4 class="mt-5">Matrix (AuthGroups->matrix) (v190)</h4>
            <?php $old_group = ""; ?>
            <?php foreach($matrix as $group_name => $group_permissions): ?>
                <h5><?php echo $group_name; ?></h5>
                <?php foreach($group_permissions as $permission): ?>
                    <span class="btn btn-outline-danger"><?php echo $permission; ?></span>
                <?php endforeach ?>
            <?php endforeach ?>

            <h4 class="mt-5">Sincronizar (v191)</h4>
            <div class="bg-info p-3 rounded">
                <?php foreach($permissions as $permission => $description): ?>
                <div class="form-check">
                    <input 
                        class="form-check-input permisos-sincronizar" type="checkbox" 
                        value="<?php echo $permission; ?>" 
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                        <?php echo "$permission ($description)"; ?>
                    </label>
                </div>
                <?php endforeach ?>
                <button class="btn btn-warning mt-3" id="btn-sync">Actualizar permisos</button>
            </div>

        </div>
    </div>
    <?php if(auth()->user()->can('users.*')): ?>
        <script>
            function getCheckedValues() {
                const checkedPermisos = document.querySelectorAll('.permisos-sincronizar:checked');
                const arrayCheckedPermisos = Array.from(checkedPermisos).map(checkbox => checkbox.value);
                // return arrayCheckedPermisos.join(',');
                return arrayCheckedPermisos;
            }

            // bloque para asignar/remover permisos individuales al usuario del detalle 
            // vista http://localhost:8080/dashboard/usuario/$id_usuario_ver_detalle
            // INSERT/DELETE en auth_permissions_users
            document.querySelectorAll(".btn-permiso").forEach((btn) =>{ // v187
                btn.addEventListener("click", () =>{

                    // FormData() es una clase que tenemos en JS para manejar la data de un formulario mediante JS (v187)
                    let formData = new FormData(); 
                    formData.append("permiso", btn.getAttribute("data-permiso"));
                    
                    fetch("/dashboard/usuario/<?php echo $usuario->id?>/manejar-permisos", {
                        method: "POST",
                        body: formData,
                    }) .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        if(res == 0) {
                            btn.classList.remove("border-5", "border-danger");
                            btn.querySelector("span").innerText = "";
                        } else {
                            btn.classList.add("border-5", "border-danger")
                            btn.querySelector("span").innerText = "HABILITADO";
                        }
                    })
                })
            })
            // fin bloque
            
            // bloque para sumar o quitar de un grupo al usuario del detalle 
            // vista http://localhost:8080/dashboard/usuario/$id_usuario_ver_detalle
            // INSERT/DELETE en auth_groups_users
            document.querySelectorAll(".btn-grupo").forEach((btn) =>{ // v189
                btn.addEventListener("click", () =>{
                    let formData = new FormData(); 
                    formData.append("grupo", btn.getAttribute("data-grupo"));
                    
                    fetch("/dashboard/usuario/<?php echo $usuario->id?>/manejar-grupos", {
                        method: "POST",
                        body: formData,
                    }) .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        btn.classList.toggle("border-5");
                        btn.classList.toggle("border-danger");
                    })
                })
            })
            // fin bloque
            
            document.getElementById("btn-sync").addEventListener("click", () =>{ // v191
                let formData = new FormData(); 
                formData.append("permisos", getCheckedValues());
                fetch("/dashboard/usuario/<?php echo $usuario->id?>/sincronizar-permisos", {
                    method: "POST",
                    body: formData,
                }) .then(res => res.json())
                .then(res => {
                    console.log(res);
                })
            })
        </script>
    <?php endif ?>
    
<?php echo $this->endSection(); ?>