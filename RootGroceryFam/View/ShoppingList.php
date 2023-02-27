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

<body class="ScaleX2"> 
<?php
# add links to other pages
Navigation::get_navigation_header();
echo "<h1>Shopping List</h1>";
?>

<!-- ADD NEW ITEM TEXT FORM - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<form action="<?php echo Navigation::get_site_name() ?>/Controller/ShoppingListController.php" method="post">
    <input type="hidden" name="hidden_add_item" value="hidden_add_item">
    <input type="text" name="item_description" placeholder="Add Item To List" class="ShoppingListSearchBox">
    <input type="submit" value="Add" class="FloatRight">
</form>
<hr>


<!-- CHECKLIST SECTION - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<?php 
# Load Shopping List Items From DB
# shopping List Items are items with IsInList set to true, they may or may not be in the shopping cart.
# the items in a shopping cart must also be on the list and have the IsInCart set to true
# Display them on a list
$listItems = GroceryItem::getShoppingListItems();
foreach ($listItems as $item) {
    $item->displayAsHTMLChecklistItem();
}

?>

<!-- PROCESS ORDER SECTION - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<br>
<form action="<?php Navigation::get_site_name()?>/Controller/ShoppingListController.php">
    <input type="hidden" name="hidden_process_order">
    <input type="submit" value="Process Order">
</form>


</body>
</html>


