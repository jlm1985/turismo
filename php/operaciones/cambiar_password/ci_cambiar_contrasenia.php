<?php
class ci_cambiar_contrasenia extends turismo_ci
{
    //-----------------------------------------------------------------------------------
    //---- formulario -------------------------------------------------------------------
    //-----------------------------------------------------------------------------------

    function evt__formulario__modificacion($datos) {
        $usuario = toba::usuario()->get_id();
        if (!(toba_usuario_basico::autenticar($usuario, $datos['clave_actual']))) {
            throw new toba_error("La clave actual ingresada no es la correcta.");
            return;
        }
        $algoritmo = 'bcrypt';
        $encriptada = encriptar_con_sal($datos['clave_nueva'], $algoritmo);
        $sql = "
                UPDATE
                        apex_usuario
                SET
                        clave = '$encriptada',
                        autentificacion = '$algoritmo'
                WHERE
                        usuario = '$usuario';
            ";
        toba_instancia::instancia()->get_db()->ejecutar($sql);
        $this->pantalla()->set_descripcion('La clave fue actualizada correctamente.<br>');
        $this->informar_msg('La clave fue actualizada correctamente', 'info');
        echo toba_js::ejecutar($this->salir());
    }

    function salir() {
        return "
                var prefijo = toba_prefijo_vinculo.substr(0, toba_prefijo_vinculo.indexOf('?'));
                var vinculo = prefijo + '?fs=1';
                if (top) {
                    top.location.href = vinculo;
                } else {
                    location.href = vinculo;
                }
            ";
    }
}

?>
