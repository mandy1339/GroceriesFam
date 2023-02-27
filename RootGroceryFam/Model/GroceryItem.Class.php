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
        echo <<<HTML
        <div>
            <input type="checkbox" name="checkbox-$item_id" class="ShoppingItemTextBox">
            <span class="ShoppingItemTextSpan">$this->ItemDescription</span>    
            <form class="FloatRight VerticalAligntTop">
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
}
?>
