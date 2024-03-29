<h1>Introduction</h1>
A fully automated CRUD system that seamlessly detects database columns and their requirements, generating corresponding tags for swift implementation.

The system generated every entry, be it table names, column names, or even relational data dynamically. The system uses various SQL queries to fetch data about the table in question, such as the number of columns, names of the columns, type constraints, foreign key constraints, record values and so on to seamlessly generate dynamic rows and columns for each DB entity. It also uses a bunch of keywords and cases from the <mark>`table_alias.php`</mark> file to  identify the *datatype of the columns* from the database and generate corresponding input types in Insert as well as Edit forms. The code uses a variety of reusable functions from the <mark>`table_fuctions.php`</mark>. file to perform every task. It can be even said that the <mark>`table_functions.php`</mark> is the system's backbone. 

To be able to make this system your own, read carefully the comments of `table_alias.php` and adjust the keyword according to your own needs. 
 
<h1>Getting Started</h1>
<h2>Installation</h2>
To seamlessly integrate the AutoCRUD system into your project, follow these simple installation steps:
<h3> Download Source Code:</h3>
  <li>Visit the GitHub repository at <a href="https://github.com/heyabhiraj/AutoCRUD">AutoCRUD</a> and download the source code.
<h3>Integration:</h3>
  <li>Integrate the downloaded source code into your project's admin panel.



<h2>Setup</h2>
Configure AutoCRUD to align with your project requirements by following these setup instructions:
<ol>
  <h3> <li>
    
  Edit `config.php`:
  </h3>Locate the config.php file and update the following values:
  <ul>
    <li type = disc>Username
    <li type = disc>Password
    <li type = disc>Database name
    <li type = disc>Server name
  </ul>

   <h3> <li>
    
  Customize `table_alias.php`:
  </h3>Locate the config.php file and update the following values:
  <ul>
    <li type = disc>Open the table_alias.php file.
    <li type = disc>Navigate to the $columnAliases array.
    <li type = disc>Create a switch case for every table in your database.
    <li type = disc>Beneath each case, assign an associative array to $columnAliases, mapping original attribute names in the table to preferred display names.
  </ul>

   <h3> <li> 
     
   Customize `$tableAliases` array:
   </h3> 
    Store the display name of the tables in the similar fashion.\

   <h3> <li> 
     
   Customize `$foreignKey` array:
   </h3> Stores the primary keys of the tables that are acting as foreign keys in the corresponding table case.

  <h3> <li> 
     
   Customize `$categoryColumnList` array:
   </h3> 

  Store the column of the related table that is to fetched using the foreign key. For example, `category_name` is fetched using the foreign key `category_id` from the table `item_category`.
 
   

</ol>


