<?php
/**
 * Esta clase fue y será generada automáticamente. NO EDITAR A MANO.
 * @ignore
 */
class turismo_autoload 
{
	static function existe_clase($nombre)
	{
		return isset(self::$clases[$nombre]);
	}

	static function cargar($nombre)
	{
		if (self::existe_clase($nombre)) { 
			 require_once(dirname(__FILE__) .'/'. self::$clases[$nombre]); 
		}
	}

	static protected $clases = array(
		'turismo_ci' => 'extension_toba/componentes/turismo_ci.php',
		'turismo_cn' => 'extension_toba/componentes/turismo_cn.php',
		'turismo_datos_relacion' => 'extension_toba/componentes/turismo_datos_relacion.php',
		'turismo_datos_tabla' => 'extension_toba/componentes/turismo_datos_tabla.php',
		'turismo_ei_arbol' => 'extension_toba/componentes/turismo_ei_arbol.php',
		'turismo_ei_archivos' => 'extension_toba/componentes/turismo_ei_archivos.php',
		'turismo_ei_calendario' => 'extension_toba/componentes/turismo_ei_calendario.php',
		'turismo_ei_codigo' => 'extension_toba/componentes/turismo_ei_codigo.php',
		'turismo_ei_cuadro' => 'extension_toba/componentes/turismo_ei_cuadro.php',
		'turismo_ei_esquema' => 'extension_toba/componentes/turismo_ei_esquema.php',
		'turismo_ei_filtro' => 'extension_toba/componentes/turismo_ei_filtro.php',
		'turismo_ei_firma' => 'extension_toba/componentes/turismo_ei_firma.php',
		'turismo_ei_formulario' => 'extension_toba/componentes/turismo_ei_formulario.php',
		'turismo_ei_formulario_ml' => 'extension_toba/componentes/turismo_ei_formulario_ml.php',
		'turismo_ei_grafico' => 'extension_toba/componentes/turismo_ei_grafico.php',
		'turismo_ei_mapa' => 'extension_toba/componentes/turismo_ei_mapa.php',
		'turismo_servicio_web' => 'extension_toba/componentes/turismo_servicio_web.php',
		'turismo_comando' => 'extension_toba/turismo_comando.php',
		'turismo_modelo' => 'extension_toba/turismo_modelo.php',
	);
}
?>