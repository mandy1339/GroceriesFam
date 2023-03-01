<?php 
require_once ('../Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');


if(isset($_POST['hidden_process_order'])) {
    $storeName = strip_tags($_POST['textbox_name_of_store']);
    GroceryItem::processGroceryOrder($storeName);

    header("location: " . Navigation::get_site_name() . '/View/ShoppingList.php');
    exit;
}

?>