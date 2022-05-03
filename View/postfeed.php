
<!DOCTYPE html>
<html>
<head>Display all users</head>
<body>
 <h1>Users list</h1>
 <table>
   <thead>
     <tr>
       <th>ID</th>
       <th>Titre</th>
     </tr>
   </thead>
   <tbody>
     <?php
     require_once('../model/postmanager.php');
     while($row = $dpost->fetch(PDO::FETCH_ASSOC)) : ?>
     <tr>
       <td><?php echo htmlspecialchars($row['idPost']); ?></td>
       <td><?php echo htmlspecialchars($row['title']); ?></td>
     </tr>
     <?php endwhile; ?>
   </tbody>
 </table>
</body>
</html>