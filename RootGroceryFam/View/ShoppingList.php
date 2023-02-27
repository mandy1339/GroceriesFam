<?php
require_once('../Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');
require_once(BASEDIR . '/View/Styling/StyleManager.php');
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
$StyleGPT1 = StyleManager::IncludeGTPStyle01();
$StyleGPT2 = StyleManager::IncludeGTPStyle02();
$StyleMyClass01 = StyleManager::IncludeMyStyle01();
?>

<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Grocery Fam</title>    
    <?php echo $StyleGPT1 ?>
    <?php echo $StyleGPT2 ?>   
    <?php echo $StyleMyClass01 ?>
</head>
<!-- <body class="ScaleX1p5"> -->
<body class="ScaleX2">
    


<?php
# User is logged in so we can show this page
# add links to other pages
Navigation::get_navigation_header();
echo "<h1>Shopping List</h1>";
?>

<form action="" method="post">
    <input type="text" placeholder="Add Item To List">
    <input type="submit" value="Add">
</form>
<hr>


<?php 
# Load Shopping List Items From DB
# Shopping List Items are items with IsInList set to true, they may or may not be in the shopping cart.
# the items in a shopping cart must also be on the list and have the IsInCart set to true
$listItems = GroceryItem::getShoppingListItems();
foreach ($listItems as $item) {
    $item->displayAsHTMLChecklistItem();
}
# Display them on a list
?>


<br>
<form action="<?php Navigation::get_site_name()?>/Controller/ShoppingListController.php">
    <input type="hidden" name="hidden_process_order">
    <input type="submit" value="Process Order">
</form>





</body>
</html>


