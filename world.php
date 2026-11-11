<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = isset($_GET['country']) ? trim($_GET['country']) : '';
$lookup = isset($_GET['lookup']) ? trim($_GET['lookup']) : '';


$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
if ($lookup === 'cities') {
    $stmt = $conn->prepare(
        "SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country"
    );
    $stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
} else {
    $stmt = $conn->prepare(
        "SELECT * FROM countries WHERE name LIKE :country"
    );
    $stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
}
$stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
$stmt->execute(); 
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if ($lookup === 'cities'): ?>
  <table>
    <tr>
      <th>City Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['district']); ?></td>
        <td><?= htmlspecialchars($row['population']); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>  
<table>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']); ?></td>
      <td><?= htmlspecialchars($row['continent']); ?></td>
      <td><?= htmlspecialchars($row['independence_year']); ?></td>
      <td><?= htmlspecialchars($row['head_of_state']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?> 
 
