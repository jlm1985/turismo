<?php
class form_cambiar_clave extends tecnibooks_ei_formulario
{
	//-----------------------------------------------------------------------------------
	//---- JAVASCRIPT -------------------------------------------------------------------
	//-----------------------------------------------------------------------------------

	function extender_objeto_js()
	{
		echo "
		//---- Validacion de EFs -----------------------------------
		
		{$this->objeto_js}.evt__confirma_nueva__validar = function()
		{
			var repetido = this.ef('confirma_nueva');
            var orig = this.ef('clave_nueva');
            if (repetido.tiene_estado() && repetido.get_estado() != orig.get_estado()) {
                repetido.set_error('Las claves no coinciden');
                return false;
            }
            return true;
		}
		";
	}

}

?>
