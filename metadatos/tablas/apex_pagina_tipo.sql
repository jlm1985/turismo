
------------------------------------------------------------
-- apex_pagina_tipo
------------------------------------------------------------
INSERT INTO apex_pagina_tipo (proyecto, pagina_tipo, descripcion, clase_nombre, clase_archivo, include_arriba, include_abajo, exclusivo_toba, contexto, punto_montaje) VALUES (
	'turismo', --proyecto
	'tp_login', --pagina_tipo
	'Pagina de Login', --descripcion
	'tp_login', --clase_nombre
	'extension_toba/tipos_pagina/tp_login.php', --clase_archivo
	NULL, --include_arriba
	NULL, --include_abajo
	NULL, --exclusivo_toba
	NULL, --contexto
	'14000001'  --punto_montaje
);
INSERT INTO apex_pagina_tipo (proyecto, pagina_tipo, descripcion, clase_nombre, clase_archivo, include_arriba, include_abajo, exclusivo_toba, contexto, punto_montaje) VALUES (
	'turismo', --proyecto
	'tp_normal', --pagina_tipo
	'Página Normal de Turismo', --descripcion
	'tp_normal', --clase_nombre
	'extension_toba/tipos_pagina/tp_nomal.php', --clase_archivo
	NULL, --include_arriba
	NULL, --include_abajo
	NULL, --exclusivo_toba
	NULL, --contexto
	'14000001'  --punto_montaje
);
