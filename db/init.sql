CREATE DATABASE IF NOT EXISTS tourdb;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON *.* TO 'user'@'%';
FLUSH PRIVILEGES;


use tourdb;

create table user(
id int AUTO_INCREMENT PRIMARY KEY,
username varchar(45),
user_role varchar(45),
email varchar(45),
password varchar(45) 
);

create table providers(
id int AUTO_INCREMENT PRIMARY KEY,
name varchar(45),
telephone int,
email varchar(45),
rating varchar(45)
);

create table tours(
id int AUTO_INCREMENT PRIMARY KEY,
country varchar(45),
town varchar(45),
duration varchar(45),
price float,
provider_id int,
FOREIGN KEY (provider_id) REFERENCES providers(id)
);


create table orders(
id int AUTO_INCREMENT PRIMARY KEY,
cl_username varchar(45),
tour_id int,
kolvo int,
FOREIGN KEY (tour_id) REFERENCES tours(id)
);

insert into providers (name, telephone, email, rating) values
("Julian", 100, "jul@gmail.com", "9 from 10"),
("Carlos", 200, "carl@gmail.com"," 5 from 10"),
("Sharlotta", 300, "sharl@gmail.com", "2 from 10"),
("Ivan", 400, "iva@gmail.com", "6 from 10"),
("Meril", 500, "merl@gmail.com", "10 from 10"),
("Michael", 600, "mich@gmail.com", "3 from 10");

insert into tours (country, town, duration, price, provider_id) values
("Spain", "Barcelona", "2 weeks", 1600, 1),
("Italy", "Rome", "1 weeks", 1884, 2),
("Spain", "Valencia","5 days", 999, 1),
("France", "Paris","12 days", 200, 3),
("Italy", "Milan","4 days", 455, 5),
("Spain", "Madrid","1 week", 900, 6),
("Cyprus", "Pafos","2 weeks", 2555, 4),
("Portugal", "Lisbon","3 days", 400, 5),
("Japan", "Tokyo", "2 weeks", 2500, 4),
("Australia", "Sydney", "10 days", 1800, 3),
("Canada", "Vancouver", "10 week", 1500, 2),
("Brazil", "Rio de Janeiro", "30 days", 8000, 1),
("France", "Bordeaux", "2 weeks", 3000, 2),
("Portugal", "Albufeira", "1 week", 1200, 2),
("France", "Marseille", "5 days", 1000, 5),
("Russia", "Moscow", "10 days", 2995, 6),
("Portugal", "Braga", "45 days", 2200, 4),
("Russia", "Saratov", "12 week", 6789, 3),
("Greece", "Athens", "100 days", 45000, 1),
("France", "Lyon", "2 weeks", 1515, 5);



