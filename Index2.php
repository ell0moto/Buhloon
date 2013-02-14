<?php

  $database = new mysqli('instance38441.db.xeround.com','Matthew', '1356mm79aa', 'buhloon', '6435');
  
  if($database->connect_error > 0){
      echo 'Database error'  . $database->connect_error; 
  }else{
      echo 'Connected!';
  }
 
 $query = 'SELECT * FROM persons';
 
 $result = $database->query($query);
 
 if(!$result){
     echo 'Database query error!' . $database->error;
 }else{
     while($row = $result->fetch_assoc()){
         echo 'Name: ' . $row['Name'];
     }
 }
 