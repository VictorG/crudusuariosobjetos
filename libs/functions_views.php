<?php
/*
 * string function render(string $content, filePath $layout)
 * 
 * Renderiza el contenido de content en layout 
 * y devuelve como html.
 */

class views 
{
	public function render($content, $layout)
	{
	    ob_start();
	        include ($layout); 
	        $html = ob_get_contents();
	    ob_end_clean();
	    return $html;
	}
	
	public function view($viewVar, $view)
	{
	    ob_start();
	        include ($view); 
	        $html = ob_get_contents();
	    ob_end_clean();
	    return $html;
	}
	
	public function debug($data, $label)
	{
	    echo "<pre>".$label.": ";
	    print_r($data);
	    echo "</pre>";   
	}
}
?>

