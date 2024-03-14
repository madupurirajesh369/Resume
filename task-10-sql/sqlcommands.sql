insert into Customers (customer_id,first_name,last_name,age,country) values ("6","Virat","Kohli","35","India"),
("7","MS","Dhoni","41","India"),
("8","Sachin","Tendulkar","45","India");

select count(customer_id) as customers,country from Customers group by country;

select order_id as orders from Orders where amount between 100 and 500;

select Customers.first_name, Customers.last_name
from Customers
join Orders on Customers.customer_id = Orders.customer_id
where Orders.item = 'Keyboard';

select first_name, last_name 
from Customers 
where customer_id in (select customer_id from Orders where item = 'Keyboard');

select country
from Customers 
where customer_id in (select customer from Shippings where status = 'Pending');

select Customers.country
from Customers
join Shippings on Customers.customer_id=Shippings.customer
where status="Pending";

select count(Customers.customer_id) as customer
from Customers
join Orders on Customers.customer_id = Orders.customer_id
group by Orders.customer_id