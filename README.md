
A fully automated CRUD system that seamlessly detects database columns and their requirements, generating corresponding tags for swift implementation.

The system generated every entry, be it table names, column names, or even relational data dynamically. The system uses various SQL queries to fetch data about the table in question, such as the number of columns, names of the columns, type constraints, foreign key constraints, record values and so on to seamlessly generate dynamic rows and columns for each DB entity. It also uses a bunch of keywords and cases from the <mark>`table_alias.php`</mark> file to  identify the *datatype of the columns* from the database and generate corresponding input types in Insert as well as Edit forms. The code uses a variety of reusable functions from the <mark>`table_fuctions.php`</mark>. file to perform every task. It can be even said that the <mark>`table_functions.php`</mark> is the backbone of the system. 

To be able to make this system your own, read carefully the comments of `table_alias.php` and adjust the keyword according to your own needs. 
