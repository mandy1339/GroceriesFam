<?php
require_once('../Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');
require_once(BASEDIR . '/View/Styling/StyleManager.php');
require_once(BASEDIR . '/View/Javascript/JavascriptManager.php');
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
$StyleGPT1 = StyleManager::IncludeGTPStyle01();
$StyleGPT2 = StyleManager::IncludeGTPStyle02();
$StyleMyClass01 = StyleManager::IncludeMyStyle01();
$jqueryScript = JavascriptManager::includeJQueryScript();
$onClickGroceryCheckBoxScript = JavascriptManager::includeOnClickGroceryItemCheckBoxScript();
$groceryAutoCompleteScript = JavascriptManager::includeGroceryItemAutocompleteScript();
?>

<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Grocery Fam</title>    
    <?= $StyleGPT1 ?>
    <?= $StyleGPT2 ?>   
    <?= $StyleMyClass01 ?>
    <?= $jqueryScript ?>
    <?= $onClickGroceryCheckBoxScript ?>
    <?= $groceryAutoCompleteScript ?>
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
    <input type="text" name="item_description" id="item_description_box" placeholder="Add Item To List" class="ShoppingListSearchBox">
    <input type="submit" value="Add" class="FloatRight">
</form>
<div id="suggestion-grocery-item-list"></div>
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
<form action="<?php echo Navigation::get_site_name()?>/View/ProcessOrder.php" method="post">
    <input type="hidden" name="hidden_process_order">
    <input type="submit" value="Process Order">
</form>


</body>
</html>


