<?php   
require '../modelo/conexion.php';
$sqlrol = "SELECT idRol, nombre FROM rol";
$roles = $conexion->query($sqlrol);
?>
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog"
                        aria-labelledby="editarModallLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="editarModalLabel">Editar usuario</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="actualizar.php" method="post">
                                    <input type="hidden" id="id" name="id">
                                        <div class="mb-3">
                                            <label for="usuario" class="form-label">Usuario:</label>
                                            <input autofocus type="text" name="usuario" id="usuario"
                                                class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="contrasenia" class="form-label">Contraseña:</label>
                                            <input type="text" name="contrasenia" id="contrasenia" class="form-control"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="rol">Rol:</label>
                                            <select name="rol" id="rol" class="form-select">
                                                <option value="">selecion..</option>
                                                <?php while ($row_roles = $roles->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row_roles["idRol"] ?>">
                                                        <?= $row_roles["nombre"] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="">
                                            <button type="submit" class="btn btn-primary" name="submit_tabla2"><i
                                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>