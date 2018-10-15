CREATE TABLE Customers (
    CustomerID serial NOT NULL PRIMARY KEY,
    LastName varchar(50) NOT NULL,
    FirstName varchar(50) NOT NULL,
    Email varchar(50),
    Phone int CHECK (Phone > 0)
);

INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES ('Rubolino', 'Barbara', 'brubolino@email.net', 698441827);
INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES ('Cabezas', 'Agustin', 'acabezas@email.net', 698441828);
INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES ('Ferrero', 'Tiziano', 'tferrero@email.net', 698441829);
INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES ('King', 'Julien', 'jking@email.net', 698441830);
INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES ('Bell', 'Nizza', 'nbell@email.net', 698441831);

CREATE TABLE MenuitemTypes (
    MenuitemTypeID serial NOT NULL PRIMARY KEY,
    Type varchar(50)
);

INSERT INTO MenuitemTypes (Type) VALUES ('Entrada');
INSERT INTO MenuitemTypes (Type) VALUES ('Plato principal');
INSERT INTO MenuitemTypes (Type) VALUES ('Bebida');
INSERT INTO MenuitemTypes (Type) VALUES ('Postre');

CREATE TABLE Menuitems (
    MenuitemID serial NOT NULL PRIMARY KEY,
    Type int NOT NULL CHECK (Type > 0),
    Name varchar(50) NOT NULL,
    Description varchar(255),
    Price float NOT NULL CHECK (Price > 0),
    Available boolean NOT NULL,
    FOREIGN KEY (Type) REFERENCES MenuitemTypes(MenuitemTypeID)
);

/*Entrada*/
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (1, 'Papas bravas', 'Papas asadas en rodajas con salsa brava', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (1, 'Nachos', 'Nachos con queso fundido', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (1, 'Papas a caballo', 'Papas fritas con huevo frito a caballo', 1.8, true);
/*Plato principal*/
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (2, 'Hamburguesas', 'Hamburguesas con tomate, huevo, lechuga, jamon y cebolla caramelizada', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (2, 'Asado', 'Carne de ternera asada con chimichurri', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (2, 'Pizza a la parrilla', 'Pizza cacera 4 quesos a la parrilla', 1.8, true);
/*Bebida*/
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (3, 'Coca Cola', '', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (3, 'Sprite', '', 1.6, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (3, 'Fanta', '', 1.6, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (3, 'Jugo de Naranja', 'Jugo natural de naranja exprimida', 1.6, true);
/*Postre*/
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (4, 'Flan', 'Flan de huevo cacero', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (4, 'Helado', 'Helado 3 sabores', 1.8, true);
INSERT INTO Menuitems (Type, Name, Description, Price, Available) VALUES (4, 'Ensalada de frutas', 'Frutas varias frescas en trozos', 1.8, true);

CREATE TABLE Orders (
    OrderID serial NOT NULL PRIMARY KEY,
    OrderDate date NOT NULL DEFAULT CURRENT_DATE,
    MenuitemID int NOT NULL CHECK (MenuitemID > 0),
    FOREIGN KEY (MenuitemID) REFERENCES Menuitems(MenuitemID)
);

INSERT INTO Orders (MenuitemID) VALUES (1);
INSERT INTO Orders (MenuitemID) VALUES (3);
INSERT INTO Orders (MenuitemID) VALUES (5);
INSERT INTO Orders (MenuitemID) VALUES (7);

CREATE TABLE Orderlists (
    CustomerID int NOT NULL CHECK (CustomerID > 0),
    OrderID int NOT NULL CHECK (OrderID > 0),
    CONSTRAINT PK_OrderListID PRIMARY KEY (CustomerID, OrderID),   
    FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);

INSERT INTO Orderlists (CustomerID, OrderID) VALUES (1, 1);