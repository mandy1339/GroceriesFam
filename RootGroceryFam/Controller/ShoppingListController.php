<?php 

require_once ('../Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');

# HANDLE ADD ITEM -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
if(isset($_POST['hidden_add_item'])) {
    $item_desc = DatabaseUtil::sanitize_data_from_form($_POST['item_description']);
    # If item description doesn't exist in db yet, insert new item
    if (!GroceryItem::isItemDescriptionExist($item_desc))
    {
        GroceryItem::insertNewItemToDatabase($item_desc);
    }    
    # Mark the item as being in the shoppinglist
    GroceryItem::putItemWithDescriptionInList($item_desc);

    $debugvar1 = "location " . Navigation::get_site_name() . '/View/ShoppingList.php';
    header("location: " . Navigation::get_site_name() . '/View/ShoppingList.php');
    exit;
}

# HANDLE DELETE ITEM -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
else if (isset($_POST['hidden_delete_item'])) {
    # Get the ID of the item to remove
    $item_id = DatabaseUtil::sanitize_data_from_form($_POST['hidden_delete_item']);
    # Remove item from the shopping list by setting its IsInShoppingList value to FALSE
    GroceryItem::removeItemFromShoppingList($item_id);

    header("location: " . Navigation::get_site_name() . '/View/ShoppingList.php');
    exit;
}

# HANDLE PROCESS FORM -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
else if (isset($_POST['hidden_process_order'])) {
    
    header("location: " . Navigation::get_site_name() . '/View/ShoppingList.php');
    exit;
}
?>