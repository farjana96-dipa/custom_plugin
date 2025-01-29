<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php

  global $wpdb;

  $tbl = $wpdb->prefix.'cutom_plugin_table';
  echo $tbl;
  /*$wpdb->insert(
    'wp_cutom_plugin_table',
    array(
      'name' => 'Fateha Tuj Johora',
      'email' => 'fateha@gmail.com',
      'phone' => '01518930507'
    )
  );*/

  $results = $wpdb->get_results("SELECT * FROM wp_cutom_plugin_table");

  echo "<pre>";
  echo print_r($results);
  echo "</pre>";

  $wpdb->update(
    'wp_cutom_plugin_table',
    array(
      'name' => 'Rahima Akter Misty',
      ),
      array(
        'id' => 3
      )

      );


      $wpdb->insert(
        'wp_cutom_plugin_table',
        array(
          'name' => 'Anowara Begum',
          'email' => 'anwara@gmail.com',
          'phone' => '01545789645'
        )
      );


      $wpdb->query(
        $wpdb->prepare(
          'UPDATE wp_cutom_plugin_table SET name = %s WHERE id = %d ' ,
           "Kohinur Begum", 
           6
        )
      );


  
   ?>
</head>
<body>
<h2> Signup Form</h2>
<form class="w-50 py-4" id="signup_form" action="#" method="post">
    <div class="mb-3 form-group">
        <label for="uname" class="form-label">Username</label>
        <input type="text" class="form-control" id="uname" aria-describedby="unameHelp" required>
      
      </div>
      <div class="mb-3 form-group">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        
      </div>
      <div class="mb-3 form-group">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
   
      <button type="submit" class="btn btn-primary" id="clickbtn">Submit</button>
</form>


</body>
</html>




