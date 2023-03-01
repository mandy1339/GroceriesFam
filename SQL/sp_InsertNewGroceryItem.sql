DELIMITER $$
CREATE PROCEDURE sp_InsertNewGroceryItem
(
	OUT InsertedID INT,
	IN Param_ItemDescription VARCHAR(250)    
)
BEGIN
	INSERT INTO GROCERYITEM (ItemDescription, IsInCart, IsInShoppingList) VALUES
    (Param_ItemDescription, FALSE, TRUE);
    
    SELECT LAST_INSERT_ID() INTO InsertedID;
END$$
DELIMITER ;