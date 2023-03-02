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

# HANDLE CHECK/UNCHECK BOX -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -   -
else if (isset($_POST['hidden_check_uncheck_item'])){
    $item_id = $_POST['hidden_check_uncheck_item'];
    $is_checked = isset($_POST['checkbox_groceryitem']) ? true : false;
    
    if($is_checked) {
        GroceryItem::putItemWithIDInCart($item_id);
    }
    else {
        GroceryItem::removeItemWithIDFromCart($item_id);
    }

    header("location: " . Navigation::get_site_name() . '/View/ShoppingList.php');
    exit;
}

# HANDLE AUTOCOMPLETE SUGGESTION SEARCHES 
else if (isset($_POST["keyword"]) && ($_POST["keyword"] != "")) { 
    $keyword = DatabaseUtil::sanitize_data_from_form($_POST['keyword']);
    $itemList = GroceryItem::getShoppingItemsThatStartWith($keyword);        
    echo "<ul id=\"grocery-list\">";
    foreach ($itemList as $item) 
    {
        $itemDescription = $item->getItemDescription();
        echo <<<HTML
        <li
            onClick="selectGroceryItem('$itemDescription')">
            $itemDescription
        </li>
HTML;
    }
    echo "</ul>";
}

?>
