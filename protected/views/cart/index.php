
<!-- BT -->
<?php
session_start();
echo "session start";
//$_SESSION['cartid'] = '';
if (!isset($_SESSION['cartid'])) {
	$cartid = com_create_guid();
	$cartid = trim($cartid, '{}');
	$_SESSION['cartid'] = $cartid;
} 
?>
<?php
if ($_GET['albid'] == '' && $_GET['aid'] == '') {
	$this->breadcrumbs = array(
		'View Cart'
	);
	$carttotal = 0;
?>
<h2>Your Cart</h2>
<?php 
echo $this->renderPartial('_form_view',array('myCarts'=>myCarts));
} 

if ($_GET['aid'] != '' && $_GET['albid'] != '') {
	$this->breadcrumbs = array(
		'Carts'=>array('index'),
		'Create Cart'
	);
}
?>

<h1>Adding to your Cart</h1>
<?php echo $this->renderPartial('_form_Create',array('myCarts'=>myCarts)); ?>
<!-- BT -->