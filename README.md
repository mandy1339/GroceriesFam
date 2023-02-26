# Summary
Web app built with php and database driven. Its purpose is to allow any member of our family to add groceries to a shared list. While shopping at the store you check the boxes of the items we already got. At the end of the shopping session the user will mark order complete and it will archive the current shopping list. 



# Specific Use Cases
	• User can login
		○ Login will last 15 days or so via cookie to avoid frequent signing in
	• User can logout
	• User can type the items to add to current shopping list to add new items to it.
	• There will be autocomplete hint suggestion based on items bought most frequently.
	• User can see the full list of current grocery list.
	• Users can see history of previous grocery orders.
	• Users can see most popular items.
	• When users check box on current grocery list it will move it towards the bottom of the list
	• Users can click finalize order and it will archive the current grocery list and open a new empty one
	• Users can delete items from the currently open grocery list.
		○ There will be a warning before deleting items? Ask mom what she wants.




# Tables
	• USERS (UserID, username, password)
	• GROCERYITEM (ItemID, ItemDescription, IsInCart, IsInShoppingList, DateCreated)
	- ORDER (OrderID, OrderDate, Store)
	- ORDERITEM (OrderID, ItemID, Qty)

![image](https://user-images.githubusercontent.com/23123145/221418951-1099a55f-b2ca-43b6-8ec6-f782c5110f57.png)


GROCERYITEM	
ItemID	INT
ItemDescription	VARCHAR(250)
IsInCart	BOOLEAN
IsInShoppingList	BOOLEAN
DateCreated	DATETIME

USERS	
UserID	INT
UserName	VARCHAR(100)
Password	VARCHAR(250)



# IMPLEMENTATION DESIGN
GROCERYITEM DateBought will be updated when the shopping list is finalized
GROCERYITEM IsInCart is updated to true when the checkbox is put on the item when in the store
GROCERYITEM IsInCart is updated to false when the order is finalized
GROCERYITEM TimesBought will be incremented for every item in the card when the order is finalized
GROCERYITEM isInCart is updated to false when the order is finalized
Public_html folder will contain all the public code

