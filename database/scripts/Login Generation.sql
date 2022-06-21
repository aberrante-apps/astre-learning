-- ---------------------------------------------------------------------------------------------
-- Automated Script For Insertion of Pre-Made User Information Into the Database's Logins Table
-- ---------------------------------------------------------------------------------------------

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Alex', 'Nairn', 'alex.nairn@outlook.com', '7787003700', SHA1('Testing'), '720 Heaslip Place', true, true);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Matthew', 'Zerrath', 'matthewzerrath@hotmail.com', '2506861203',  SHA1('Testing'), '1234 Fake Street', true, true);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Cianna', 'Dawn', 'missciannadawn@gmail.com', '2504201033',  SHA1('Testing'), '1234 Fake Street', true, true);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Dierdre', 'Astre', 'dierdre@astremail.com', '2506861000',  SHA1('Testing'), '1234 Fake Street', true, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Alistair', 'Astre', 'alistair@astremail.com', '2506861001',  SHA1('Testing'), '1234 Fake Street', true, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Winston', 'Bellingham', 'winston.bellingham@gmail.com', '7781001000',  SHA1('Testing'), '1234 Fake Street', false, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Milton', 'McCustomer', 'milton.mccustomer@gmail.com', '7781001001',  SHA1('Testing'), '1234 Fake Street', false, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Mandy', 'Warhol', 'mandy.warhol@outlook.com', '7781001002',  SHA1('Testing'), '1234 Fake Street', false, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Agnes', 'Beveragino', 'agnes.beveragino@outlook.com', '7781001003',  SHA1('Testing'), '1234 Fake Street', false, false);

INSERT INTO Logins 
(first_name, last_name, email_address, phone_number, password, shipping_address, admin, data_permission)
VALUES
('Vincent', 'Adultman', 'vincent.adultman@icloud.com', '7781001004',  SHA1('Testing'), '1234 Fake Street', false, false);

SELECT * FROM Logins;
