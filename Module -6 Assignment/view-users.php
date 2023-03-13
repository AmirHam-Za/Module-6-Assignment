<?php
  // Read data from CSV file
  $file = fopen('users.csv', 'r');
  $users = array();
  while (($data = fgetcsv($file)) !== FALSE) {
    $users[] = $data;
  }
  fclose($file);
?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>View Users</title>
    </head>
    <body>
    <table>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Profile Picture</th>
          </tr>
          <?php foreach ($users as $user): ?>
          <tr>
            <td><?php echo $user[0]; ?></td>
            <td><?php echo $user[1]; ?></td>
            <td><img src="<?php echo $user[2]; ?>" width="100"></td>
          </tr>
        </table>
    </body>
  </html>
  
  
  <?php 
  
  
  ?>