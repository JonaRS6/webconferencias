<?php include_once 'includes/templates/header.php' ?>
<section class="section container">
    <h2 class="text-center">Registro de usuarios</h2>
    <div class="tittle-decorator">
        <i class="fas fa-ellipsis-h"></i>
    </div>
    <form action="pagar.php" id="registro" class="registro" method="post">
        <div id="datos_usuario" class="registro caja clearfix">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
            </div>
            <div class="campo">
                <label for="apellido">Apellido: </label>
                <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>
            </div>
            <div class="campo">
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" placeholder="Tu email" required>
            </div>
            <div id="error"></div>
        </div>
        <div class="paquetes" id="paquetes">
            <h3>Elige el número de boletos</h3>
            <ul class="prices">
                <li class="price__card">
                    <h4>Un día</h4>
                    <p><span>$30</span></p>
                    <p>Bocadillos gratis</p>
                    <p>Todas las conferencias</p>
                    <p>Todos los talleres</p>
                    <div class="orden">
                        <label for="pase_dia">Boletos deseados: </label>

                        <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                        <input type="hidden" value="30" name="boletos[un_dia][precio]">
                    </div>
                </li>
                <li class="price__card">
                    <h4>Todos los días</h4>
                    <p><span>$50</span></p>
                    <p>Bocadillos gratis</p>
                    <p>Todas las conferencias</p>
                    <p>Todos los talleres</p>
                    <div class="orden">
                        <label for="pase_completo">Boletos deseados: </label>

                        <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                        <input type="hidden" value="50" name="boletos[completo][precio]">
                    </div>
                </li>
                <li class="price__card">
                    <h4>Dos días</h4>
                    <p><span>$45</span></p>
                    <p>Bocadillos gratis</p>
                    <p>Todas las conferencias</p>
                    <p>Todos los talleres</p>
                    <div class="orden">
                        <label for="pase_dosdias">Boletos deseados: </label>

                        <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[dos_dias][cantidad]" placeholder="0">
                        <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                    </div>
                </li>
            </ul>
        </div>
        <div id="eventos" class="eventos clearfix">
            <h3>Elige tus talleres</h3>
            <div class="caja">
                <?php
                include_once 'includes/functions/bd_connection.php';

                $sql = "SELECT eventos.*, categoria_evento.cat_evento FROM eventos INNER JOIN categoria_evento ON eventos.id_cat_evento = categoria_evento.id_categoria ORDER BY hora_evento;";
                $response = $conn->query($sql);
                $eventos_dias = array();
                while ($eventos = $response->fetch_assoc()) {
                    $fecha = $eventos['fecha_evento'];
                    setlocale(LC_ALL, 'es');
                    $dia_semana = strftime("%A", strtotime($fecha));

                    $categoria = $eventos['cat_evento'];

                    $dia = array(
                        'nombre_evento' => $eventos['nombre_evento'],
                        'hora' => $eventos['hora_evento'],
                        'clave' => $eventos['clave']
                    );
                    $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                }
               

                foreach ($eventos_dias as $dia => $eventos) {
                ?>
                    <div id='<?php echo str_replace('á','a',utf8_encode($dia)) ?>' class="contenido-dia clearfix">
                        <h4><?php echo utf8_encode($dia) ?></h4>
                        <?php
                        foreach($eventos['eventos'] as $tipo => $evento_dia) {
                        ?>
                            <div>
                                <p><?php echo $tipo ?>:</p>
                                <?php
                                foreach ($evento_dia as $evento)  {
                                ?>
                                    <label><input type="checkbox" name="registro[]" id="<?php echo $evento['clave'] ?>" value="<?php echo $evento['clave'] ?>"><time><?php echo $evento['hora'] ?></time> <?php echo $evento['nombre_evento'] ?></label>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!--#viernes-->
                <?php
                }
                ?>
            </div>
            <!--.caja-->
        </div>
        <!--#eventos-->
        <div class="resumen clearfix" id="resumen">
            <h3>Pago y extras</h3>
            <div class="caja clearfix">
                <div class="extras">
                    <div class="orden">
                        <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% dto.)</small></label>
                        <input type="number" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                        <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                    </div>
                    <div class="orden">
                        <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript)</small></label>
                        <input type="number" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                        <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                    </div>
                    <div class="orden">
                        <label for="regalo">Seleccione un regalo </label>
                        <select name="regalo" id="regalo" required>
                            <option value="">--Seleccione un regalo--</option>
                            <option value="2">Etiquetas</option>
                            <option value="1">Pulsera</option>
                            <option value="3">Plumas</option>
                        </select>
                    </div>
                    <input type="button" id="calcular" class="btn btn-primary" value="Calcular">
                </div>
                <div class="total">
                    <p>Resumen: </p>
                    <div id="lista-productos">

                    </div>
                    <p>Total: </p>
                    <div id="suma-total">

                    </div>
                    <input type="hidden" id="total_pedido" name="total_pedido">
                    <input type="submit" id="btnRegistro" name="submit" class="btn btn-primary" value="Pagar">
                </div>
            </div>
        </div>
    </form>
</section>
<?php include_once 'includes/templates/footer.php' ?>