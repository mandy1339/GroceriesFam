DELIMITER $$
CREATE PROCEDURE sp_ProcessGroceryOrder 
( 
	IN store_name VARCHAR(100) 
)
BEGIN
	-- Declare variables
	DECLARE new_order_id INT;     
    
    START TRANSACTION;
    -- Create new order record
    INSERT INTO GROCERYORDER (Store) VALUES (store_name);
	-- Fetch the id of new record
    SELECT LAST_INSERT_ID() INTO new_order_id; 
	-- Create cross reference records between order and item
    INSERT INTO ORDERITEM (OrderID, ItemID, Qty) 
	SELECT new_order_id, ItemID, Qty 
    FROM GROCERYITEM 
    WHERE IsInShoppingList = TRUE AND IsInCart = TRUE;
	-- Reset the items that were in the cart
    UPDATE GROCERYITEM SET IsInCart = FALSE, IsInShoppingList = FALSE, Qty = 1 WHERE IsInShoppingList = TRUE AND IsInCart = TRUE;    
    COMMIT;
END$$
DELIMITER ;