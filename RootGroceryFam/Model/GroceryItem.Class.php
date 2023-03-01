<?php 
require_once(BASEDIR .'/Data/GroceryItemDataService.Class.php');

class GroceryItem {
    private $ItemID;
    private $ItemDescription;
    private $IsInCart;
    private $IsInShoppingList;
    private $DateCreated;

    public function __construct($ItemID, $ItemDescription, $IsInCart, $IsInShoppingList, $DateCreated) {
        $this->ItemID = $ItemID;
        $this->ItemDescription = $ItemDescription;
        $this->IsInCart = $IsInCart;
        $this->IsInShoppingList = $IsInShoppingList;
        $this->DateCreated = $DateCreated;
    }

    public function getItemID() {
        return $this->ItemID;
    }
    public function getItemDescription() {
        return $this->ItemDescription;
    }
    public function getIsInCart() {
        return $this->IsInCart;
    }
    public function getIsInShoppingList() {
        return $this->IsInShoppingList;
    }
    public function getDateCreated() {
        return $this->DateCreated;
    }

    public function displayAsHTMLChecklistItem() {
        $item_id = $this->ItemID;
        $site_name = Navigation::get_site_name();
        $checked = $this->getIsInCart() == true ? "checked" : "";
        echo <<<HTML
        <div class="CheckListDiv">
            <form action="$site_name/Controller/ShoppingListController.php" method="post" id="form-$item_id">
                <input type="hidden" name="hidden_check_uncheck_item" value="$item_id">            
                <input type="checkbox" $checked name="checkbox_groceryitem" value="$item_id" class="ShoppingItemCheckBox" onclick="OnClickCheckBox(this)">
            </form>
            <span class="ShoppingItemTextSpan" style="text-align: left;float: left; margin-right: auto;">$this->ItemDescription</span>                
            <form action="$site_name/Controller/ShoppingListController.php" method="post" class="CancelButtonDiv" style="text-align: right;float: right; margin-left: auto;">
                <input type="hidden" name="hidden_delete_item" value="$this->ItemID">
                <input type="submit" name="delete_button-$item_id" value="X" >
            </form>            
        </div>
HTML;
    }

    public static function getShoppingListItems() {        
        return GroceryItemDataService::GroceryItemDataService_GetShoppingListItems();
    }

    public static function getShoppingCartItems() {
        return GroceryItemDataService::GroceryItemDataService_GetShoppingCartItems();
    }

    public static function getShoppingItemsThatStartWith($pre) {
        return GroceryItemDataService::GroceryItemDataService_GetItemsThatStartWith($pre);
    }

    public static function isItemDescriptionExist($item_desc) {
        return GroceryItemDataService::GroceryItemDataService_isItemDescriptionExist($item_desc);
    }
    
    # Mark the item as being in the shoppinglist
    public static function putItemWithDescriptionInList($item_desc) {
        GroceryItemDataService::GroceryItemDataService_putItemWithDescriptionInList($item_desc);
    }

    public static function insertNewItemToDatabase($item_desc) {
        GroceryItemDataService::GroceryItemDataService_insertNewItemToDatabase($item_desc);
    }
    
    public static function removeItemFromShoppingList($item_id) {
        GroceryItemDataService::GroceryItemDataService_removeItemFromShoppingList($item_id);
    }

    public static function putItemWithIDInCart($item_id) {
        GroceryItemDataService::GroceryItemDataService_putItemWithIDInCart($item_id);
    }

    public static function removeItemWithIDFromCart($item_id) {
        GroceryItemDataService::GroceryItemDataService_removeItemWithIDFromCart($item_id);
    }

    public static function processGroceryOrder($store_name) {
        GroceryItemDataService::GroceryItemDataService_processGroceryOrder($store_name);
    }
}
?>
