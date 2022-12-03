<?php

/**
 *
 * @param string $name Nombre del campo
 * @param array $opciones Opciones que tiene el select
 * 			clave array=valor option
 * 			valor array=texto option
 * @param string $valorDefecto Valor seleccionado
 * @return string
 */
function CreaSelect($name, $opciones, $valorDefecto = '')
{
	$html = "\n" . '<select class="form-select-sm" name="' . $name . '">';
	foreach ($opciones as $value => $text) {
		if ($value == $valorDefecto)
			$select = 'selected="selected"';
		else
			$select = "";
		$html .= "<option value=\"$value\" $select>$text</option>";
	}
	$html .= "\n</select><br>";

	return $html;
}
