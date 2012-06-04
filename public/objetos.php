<?php

// CREAR UNA CLASE
class miClase
{
	// Propiedades
	public $mipropiedad='esto variable';
	
	// Metodos
	public function miMetodo()
	{
		echo "hola mundo";
		return NULL;
	}	
}

$miObjeto = new miClase();
$miObjeto -> miMetodo();
echo "<br/>";
echo $miObjeto -> mipropiedad;
echo "<br/>";
$miObjeto -> mipropiedad = "otra cosa";
echo $miObjeto -> mipropiedad;
echo "<br/>";

$miObjeto2 = new miClase();
echo $miObjeto2 -> mipropiedad;

echo "<hr/>";

class A
{
	function foo()
	{
		if (isset($this)) {
			echo '$this is defined (';
			echo get_class($this);
			echo ")\n";
		} else {
			echo "\$this is not defined.\n";
		}
	}
}
$objeto1 = new A;
$objeto1 -> foo();

echo "<hr/>";

class SimpleClass
{
	// invalid member declarations:
// 	public $var1 = 'hello '.'world';
// 	public $var2 = <<<EOD
// hello world
// EOD;
// 	public $var3 = 1+2;
// 	public $var4 = self::myStaticMethod();
// 	public $var5 = $myVar;
	
	// valid member declarations:
	
// 	define ('myConstant', 'mivalor'); // Esto no sepuede hacer
	
	public $pi = 3.1418;
	public $var6 = myConstant;
// 	public $var7 = self::pi;
	public $var8 = array(true, false);
	
	function displayVar2()
	{
		echo "Simple class\n";
		return;		
	}
	
	
}

$objeto2 = new SimpleClass();
echo $objeto2 -> pi;
echo "<br/>";
// echo $object2 -> var7;


class ExtendClass extends SimpleClass
{
	// Redefine the parent method
	function displayVar()
	{
		echo "Extending class\n";
		parent::displayVar2();
	}
}
$extended = new ExtendClass();
$extended->displayVar();
$extended->displayVar2();


echo "<hr/>";
echo "<hr/>";
echo "<hr/>";



class MyDestructableClass {
	function __construct() {
		print "In constructor\n";
		$this->name = "MyDestructableClass";
	}
	function __destruct() {
		print "Destroying " . $this->name . "\n";
	}
}
$obj = new MyDestructableClass();



echo "<hr/>";
echo "<hr/>";
echo "<hr/>";


class MyClass
{
	public $public = 'Public';
	protected $protected = 'Protected';
	private $private = 'Private';
	function printHello()
	{
		echo $this->public;
		echo $this->protected;
		echo $this->private;
	}
}

 
$obj11 = new MyClass();
// echo $obj->private;
$obj11->printHello();



echo "<hr/>";
echo "<hr/>";
echo "<hr/>";





class BaseClass {
	public function test() {
		echo "BaseClass::test() called\n";
	}
	final public function moreTesting() {
		echo "BaseClass::moreTesting() called\n";
	}
}
class ChildClass extends BaseClass {
	public function moreTesting() {
		echo "ChildClass::moreTesting() called\n";
	}
}

?>


