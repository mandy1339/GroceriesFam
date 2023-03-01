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

    public static function GroceryItemDataService_IsItemDescriptionExist($item_desc) 
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            SELECT 
                COUNT(*) AS Total
            FROM
                GROCERYITEM
            WHERE
                ItemDescription = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_desc);
        $stmt->execute();
        $resultSet = $stmt->get_result();        
        $row = $resultSet->fetch_assoc();
        $isExist = ($row['Total'] == 0) ? false : true;
        $conn->close();
        return $isExist;
    }


# Mark the item as being in the shoppinglist
    public static function GroceryItemDataService_PutItemWithDescriptionInList($item_desc)
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            UPDATE
                GROCERYITEM
            SET
                IsInShoppingList = TRUE
            WHERE
                ItemDescription = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_desc);
        $stmt->execute();
        $conn->close();
    }

    public static function GroceryItemDataService_InsertNewItemToDatabase($item_desc)
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            CALL sp_InsertNewGroceryItem (@inserted_id, ?)
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_desc);
        $stmt->execute();
        $stmt->close();        
        $result = $conn->query("SELECT @inserted_id AS inserted_id"); // extract the id of the inserted item in case it's needed in the future
        $inserted_id = ($result->fetch_assoc())['inserted_id'];
        $conn->close();
        return $inserted_id;
    }

    public static function GroceryItemDataService_removeItemFromShoppingList($item_id)
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            UPDATE
                GROCERYITEM
            SET
                IsInShoppingList = FALSE,
                IsInCart = FALSE
            WHERE
                ItemID = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_id);
        $stmt->execute();
        $conn->close();
    }

    public static function GroceryItemDataService_putItemWithIDInCart($item_id) 
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            UPDATE
                GROCERYITEM
            SET
                IsInShoppingList = TRUE,
                IsInCart = TRUE
            WHERE
                ItemID = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_id);
        $stmt->execute();
        $conn->close();
    }


    public static function GroceryItemDataService_removeItemWithIDFromCart($item_id) 
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            UPDATE
                GROCERYITEM
            SET
                IsInShoppingList = TRUE,
                IsInCart = FALSE
            WHERE
                ItemID = ?
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $item_id);
        $stmt->execute();
        $conn->close();
    }


    public static function GroceryItemDataService_processGroceryOrder($store_name)
    {
        $conn = DatabaseUtil::get_db_connection();
        $query = <<<SQL
            CALL sp_ProcessGroceryOrder (?)
SQL;
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $store_name);
        $stmt->execute();
        $stmt->close();        
        $conn->close();
    }
}

?>