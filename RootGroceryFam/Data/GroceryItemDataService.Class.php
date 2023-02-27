<?php 
require_once(BASEDIR . '/Model/GroceryItem.Class.php');
require_once(BASEDIR . '/Data/DatabaseUtil.Class.php');
class GroceryItemDataService {
    public static function GroceryItemDataService_GetShoppingListItems() 
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            SELECT 
                * 
            FROM
                GROCERYITEM
            WHERE
                IsInShoppingList = TRUE
            ORDER BY 
                IsInCart ASC, ItemID DESC
SQL;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $shoppingListItems = array();
        while ($row = $resultSet->fetch_assoc()) {
            array_push($shoppingListItems, 
                new GroceryItem($row['ItemID'], 
                        $row['ItemDescription'], 
                        $row['IsInCart'], 
                        $row['IsInShoppingList'], 
                        $row['DateCreated']));
        }
        $conn->close();
        return $shoppingListItems;
    }

    public static function GroceryItemDataService_GetShoppingCartItems() 
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            SELECT 
                * 
            FROM
                GROCERYITEM
            WHERE
                IsInShoppingList = TRUE 
                AND IsInCart = TRUE
SQL;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $shoppingListItems = array();
        while ($row = $resultSet->fetch_assoc()) {
            array_push($shoppingListItems, 
                new GroceryItem($row['ItemID'], 
                        $row['ItemDescription'], 
                        $row['IsInCart'], 
                        $row['IsInShoppingList'], 
                        $row['DateCreated']));
        }
        $conn->close();
        return $shoppingListItems;
    }

    public static function GroceryItemDataService_GetItemsThatStartWith($pre)
    {
        $conn = DatabaseUtil::get_db_connection();
        # TODO: Improve query to order by items that have been purchased the most times
        $query = <<<SQL
            SELECT 
                * 
            FROM
                GROCERYITEM
            WHERE
                ItemDescription LIKE '$pre%'
SQL;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $resultSet = $stmt->get_result();

        $shoppingListItems = array();
        while ($row = $resultSet->fetch_assoc()) {
            array_push($shoppingListItems, 
                new GroceryItem($row['ItemID'], 
                        $row['ItemDescription'], 
                        $row['IsInCart'], 
                        $row['IsInShoppingList'], 
                        $row['DateCreated']));
        }
        $conn->close();
        return $shoppingListItems;
    }
}
?>