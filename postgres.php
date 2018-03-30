<?php include "../inc/dbinfo.inc"; ?>
<?php
   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }

   // Performing SQL query
   $query = 'SELECT * FROM education';
   $query1 = 'SELECT * FROM experience';
   $result = pg_query($query) or die('Education Query failed: ');
   $result1 = pg_query($query1) or die('Experience Query failed: ');

   // Printing results in HTML
   echo "<table>\n";
   while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
       echo "\t<tr>\n";
       foreach ($line as $col_value) {
         echo "\t\t<td>$col_value</td>\n";
       }
       echo "\t</tr>\n";
   }
   echo "</table>\n";

   echo "<table>\n";
   while ($line = pg_fetch_array($result1, null, PGSQL_ASSOC)) {
       echo "\t<tr>\n";
       foreach ($line as $col_value) {
         echo "\t\t<td>$col_value</td>\n";
       }
       echo "\t</tr>\n";
   }
   echo "</table>\n";


   // Free resultset
   pg_free_result($result);
   pg_free_result1($result1);

   // Closing connection
   pg_close($db);

?>

