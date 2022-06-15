<?php 
require '../includes/funciones.php';
incluirTemplate('header');
?>  
    <main class="container contenido-centrado"> 
        <h3 class="title-page">Crear nueva ficha</h3>
        <form class="formulario espaciado-abajo" action="#">
            <fieldset>
                <legend>Información general</legend>
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" required>
                        <option value="" disabled selected>--Seleccione--</option>
                        <option value="computador">Computador</option>
                        <option value="portatil">Portátil</option>
                        <option value="tablet">Tablet</option>
                </select>
                <label for="descripcion">Marca/modelo</label>
                <input type="text" id="descripcion" placeholder="Lenovo E470, Hp 440p, etc." maxlength="30" required>
                <label for="observaciones">Observaciones</label>
                <input type="text" id="observaciones" placeholder="Perifericos, defectos, etc" maxlength="60" required>
            </fieldset>
            <fieldset>
                <legend>Caracteristicas</legend>
                <div class="features">
                    <label for="so">Sistema</label>
                    <input type="text" id="so" placeholder="Ej: Windows 8.1 Pro" maxlength="20" required>
                    <label for="chip">Procesador</label>
                    <input type="text" id="chip" placeholder="Ej: Intel Core i5" maxlength="20" required>
                    <label for="ram">RAM</label>
                    <input type="number" placeholder="GB" id="ram" min="1" max= "99" required>
                    <label for="disco">Disco</label>
                    <input type="number" placeholder="GB" id="disco" min="1" max= "9999" required>
                </div>
            </fieldset>
            <fieldset>
                <legend>Adjuntos</legend>
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg">
                <label for="ficha">Ficha</label>
                <input type="file" id="ficha"accept=".pdf">
            </fieldset>
        </form>
        <a class="button-green espaciado-abajo" href="fichas/ficha1.pdf">Crear</a>
        <a class="button-red" href="index.php">Cancelar</a>
    </main>

<?php incluirTemplate('footer');?>  