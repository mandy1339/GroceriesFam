<?php 
require_once('../Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/View/Styling/StyleManager.php');
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');
$StyleGPT1 = StyleManager::IncludeGTPStyle01();
$StyleGPT2 = StyleManager::IncludeGTPStyle02();
$StyleMyClass01 = StyleManager::IncludeMyStyle01();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Process Order</title>
    <?php echo $StyleGPT1 ?>
    <?php echo $StyleGPT2 ?>   
    <?php echo $StyleMyClass01 ?>
</head>
<body class="ScaleX2">
<?php Navigation::get_navigation_header() ?>    

<h3>Enter The Name Of The Store</h3>
<form action="<?php echo Navigation::get_site_name() ?>/Controller/ProcessOrderController.php" method="post">
    <input type="hidden" name="hidden_process_order">
    <input type="text" name="textbox_name_of_store" placeholder="Enter Name Of Store">
    <input type="submit" value="Process">
</form>

</body>
</html>