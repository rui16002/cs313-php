CREATE TABLE Customers (
    CustomerID serial NOT NULL PRIMARY KEY,
    LastName varchar(50) NOT NULL,
    FirstName varchar(50) NOT NULL,
    Email varchar(50),
    Phone int CHECK (Phone > 0)
);

INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES 
('Rubolino', 'Barbara', 'brubolino@email.net', 698441827),
('Cabezas', 'Agustin', 'acabezas@email.net', 698441828),
('Ferrero', 'Tiziano', 'tferrero@email.net', 698441829),
('King', 'Julien', 'jking@email.net', 698441830),
('Bell', 'Nizza', 'nbell@email.net', 698441831);

CREATE TABLE ItemTypes (
    ItemTypeID serial NOT NULL PRIMARY KEY,
    Type varchar(50)
);

INSERT INTO ItemTypes (Type) VALUES 
('Entrada'),
('Plato principal'),
('Bebida'),
('Postre');

CREATE TABLE Menuitems (
    ItemID serial NOT NULL PRIMARY KEY,
    ItemTypeID int NOT NULL CHECK (ItemTypeID > 0),
    Name varchar(50) NOT NULL,
    Description varchar(255),
    Price float NOT NULL CHECK (Price > 0),
    Available boolean NOT NULL,
    FOREIGN KEY (ItemTypeID) REFERENCES ItemTypes(ItemTypeID)
);

/*Entrada*/
INSERT INTO Menuitems (ItemTypeID, Name, Description, Price, Available) VALUES 
(1, 'Papas bravas', 'Papas asadas en rodajas con salsa brava', 1.8, true),
(1, 'Nachos', 'Nachos con queso fundido', 1.8, true),
(1, 'Papas a caballo', 'Papas fritas con huevo frito a caballo', 1.8, true),
/*Plato principal*/
(2, 'Hamburguesas', 'Hamburguesas con tomate, huevo, lechuga, jamon y cebolla caramelizada', 1.8, true),
(2, 'Asado', 'Carne de ternera asada con chimichurri', 1.8, true),
(2, 'Pizza a la parrilla', 'Pizza cacera 4 quesos a la parrilla', 1.8, true),
/*Bebida*/
(3, 'Coca Cola', '', 1.8, true),
(3, 'Sprite', '', 1.6, true),
(3, 'Fanta', '', 1.6, true),
(3, 'Jugo de Naranja', 'Jugo natural de naranja exprimida', 1.6, true),
/*Postre*/
(4, 'Flan', 'Flan de huevo cacero', 1.8, true),
(4, 'Helado', 'Helado 3 sabores', 1.8, true),
(4, 'Ensalada de frutas', 'Frutas varias frescas en trozos', 1.8, true);

CREATE TABLE Orders (
    OrderID serial NOT NULL PRIMARY KEY,
    CustomerID int NOT NULL CHECK (CustomerID > 0),
    OrderDate date NOT NULL DEFAULT CURRENT_DATE, 
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
);

INSERT INTO Orders (CustomerID) VALUES (1),(3),(5);

CREATE TABLE Orderlist (
    OrderID int NOT NULL CHECK (OrderID > 0),
    ItemID int NOT NULL CHECK (ItemID > 0),
    CONSTRAINT PK_OrderListID PRIMARY KEY (OrderID, ItemID),
    FOREIGN KEY (ItemID) REFERENCES Menuitems(ItemID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

INSERT INTO Orderlist (OrderID, ItemID) VALUES 
(1, 1),
(1, 4),
(1, 7),
(2, 2),
(2, 5),
(2, 8),
(3, 3),
(3, 6),
(3, 9),
(3, 12);

