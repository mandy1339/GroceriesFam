

CREATE TABLE USERS (
	UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserName VARCHAR(100) NOT NULL,
    Password VARCHAR(250) NOT NULL
);

CREATE TABLE GROCERYITEM (
	ItemID INT PRIMARY KEY AUTO_INCREMENT,
    ItemDescription VARCHAR(250) NOT NULL,
    IsInCart BOOLEAN NOT NULL,
    IsInShoppingList BOOLEAN NOT NULL,
    DateCreated DATETIME NULL DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE GROCERYITEM ADD Qty SMALLINT NULL DEFAULT 1;
ALTER TABLE GROCERYITEM ADD UNIQUE INDEX IX_GROCERYITEM_DESC (ItemDescription(20));
ALTER TABLE GROCERYITEM ADD INDEX IX_GROCERYITEM_ISINLIST (IsInShoppingList);


CREATE TABLE GROCERYORDER (
	OrderID INT PRIMARY KEY AUTO_INCREMENT,
    Store VARCHAR(100) NULL,
    OrderDate DATETIME NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ORDERITEM (
	OrderID INT NOT NULL,
    ItemID INT NOT NULL,
    Qty SMALLINT NULL DEFAULT 1,
    PRIMARY KEY ORDERITEM_PK (OrderID, ItemID),
    CONSTRAINT FK_ORDERITEM_ORDER FOREIGN KEY (OrderID) REFERENCES GROCERYORDER (OrderID),
    CONSTRAINT FK_ORDERITEM_ITEM FOREIGN KEY (ItemID) REFERENCES GROCERYITEM (ItemID)
);