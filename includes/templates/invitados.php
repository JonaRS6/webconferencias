<?php

    try {
        require_once('includes/functions/bd_connection.php');
        $sql = "SELECT * FROM invitados";
        $resultado = $conn->query($sql);
    } catch (\Exception $_e) {
        echo $e->getMessage();
    }
    ?>
    <ul class="guest__container">
        <?php while ($invitados = $resultado->fetch_assoc()) { ?>
            <li class="guest__card">
                <div class="guest__card__img">
                    <img src="img/invitados/<?php echo $invitados['url_imagen']?>" alt="invitado">
                </div>
                <a  class="invitado-info" href="#invitado<?php echo $invitados['id_invitado'];?>">
                    <h3><?php echo $invitados['nombre_invitado']." ".$invitados['apellido_invitado']?></h3>
                </a>
            </li>
            <div style="display: none;">
                <div  class="invitado-info" id="invitado<?php echo $invitados['id_invitado'];?>">
                    <h2><?php echo $invitados['nombre_invitado']." ".$invitados['apellido_invitado'];?></h2>
                    <img src="img/<?php echo $invitados['url_imagen']?>" alt="invitado">
                    <p><?php echo $invitados['descripcion'];?></p>
                </div>
            </div>
        <?php } ?>
    </ul>
    <?php
    $conn->close();
    ?>