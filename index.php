<?php

require_once('connect.php');
$connection = db_connect();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Querying the Pokédex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
      header {
        font-family: "Press Start 2P", system-ui;
      }
      main {
        font-family: "Courier Prime", monospace;
      }
    </style>

  </head>
  <body class="bg-danger">
    <header class="text-center my-5">
        <h1 class="display-4 text-black fw-bold text-uppercase">Querying the Pokédex</h1>
    </header>

    <main class="row justify-content-center">
      <section class="col-12 col-md-10 col-lg-9 col-xxl-10 bg-white p-3 border border-black border-5 rounded shadow-lg">
        <div class="row">
          <div class="col-md-4 col-xl-6 mb-3">
              <img src="img/pokemon.png" alt="Pokemon characters with yellow background and Pokemon logo on top." class="img-fluid rounded pb-3">
              <img src="img/mythical-pokemon.png" alt="Mythical Pokemon characters with blue background." class="img-fluid rounded pb-3">
              <img src="img/pokemon-trainers.png" alt="Pokemon trainers with Pikachu." class="img-fluid rounded pb-3">
              <img src="img/ash-and-pika.png" alt="Ash and Pikachu." class="img-fluid rounded pb-3">
          </div>
          <div class="col-md-8 col-xl-6">
            <h2 class="fw-bold text-uppercase text-danger">Questions and Answers</h2>

            <h3 class="mt-4" style="font-size: 20px;">Question 1: What is the total number of Pokémon currently in the Pokédex?</h3>
              <?php
                  $sql = "SELECT COUNT(*) AS total_pokemon FROM pokedex;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                        echo "<p class=\"text-primary\">The total number of Pokémon currently in the Pokédex is " . $row['total_pokemon'] . ".</p>";
                      
                  } else {
                      echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                  }
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 2: Which Pokémon has the highest Attack stat amongst Legendary Pokémon? Which one has the highest Attack stat amongst non-Legendary Pokémon?</h3>
              <?php
                  $sql = "SELECT pokemon_name FROM pokedex WHERE legendary = 1 ORDER BY attack DESC LIMIT 1;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          echo "<p class=\"text-primary\">The Pokémon that has the highest Attack stat amongst Legendary Pokémon is " . $row['pokemon_name'] . ".</p>";
                  } else {
                    echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                }
              ?>

              <?php
                  $sql = "SELECT pokemon_name FROM pokedex WHERE legendary = 0 ORDER BY attack DESC LIMIT 1;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          echo "<p class=\"text-primary\">The Pokémon that has the highest Attack stat amongst non-Legendary Pokémon is " . $row['pokemon_name'] . ".</p>";
                  } else {
                    echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                }
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 3: How many Pokémon are exclusively "Fire" types?</h3>
              <?php
                  $sql = "SELECT COUNT(*) AS total_pokemon FROM pokedex WHERE type_1 = 'Fire' AND type_2 IS NULL;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                        echo "<p class=\"text-primary\">The number of Pokémon that are exclusively 'Fire' types is " . $row['total_pokemon'] . ".</p>";
                      
                  } else {
                      echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                  }
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 4: What are the names and attack stats of all the Legendary Pokémon in Generation 7?</h3>
              <?php
                  $sql = "SELECT pokemon_name, attack FROM pokedex WHERE legendary = 1 AND generation = 7; ";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) : ?>
                        
                    <table class="table table-striped text-primary">
                      <thead>
                          <tr>
                              <th class="text-primary">Pokémon Name</th>
                              <th class="text-primary">Attack stats</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                              <tr>
                                  <td class="text-primary"><?php echo $row['pokemon_name'] ?></td>
                                  <td class="text-primary"><?php echo $row['attack'] ?></td>
                              </tr>
                          <?php endwhile; ?>
                      </tbody>
                  </table>

                <?php else : ?>
                    <p class="text-danger">No Pokémon were found in the database.</p>
                <?php endif; ?>           

            <h3 class="mt-4" style="font-size: 20px;">Question 5: What is the average defense stat of all the Pokémon?</h3>
              <?php
                  $sql = "SELECT AVG(defense) AS average_defense FROM pokedex;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) {
                      $row = mysqli_fetch_assoc($result);
                      echo "<p class=\"text-primary\">The average defense of all the Pokémon in our database is " . number_format($row['average_defense']) . ".</p>";

                  } else {
                      echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                  }
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 6: What are the names and types of all of the non-Legendary Pokémon with a speed greater than 120?</h3>
              <?php
                  $sql = "SELECT pokemon_name, type_1, type_2 FROM pokedex WHERE legendary = 0 AND speed > 120; ";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) : ?>
                        
                    <table class="table table-striped text-primary">
                      <thead>
                          <tr>
                              <th class="text-primary">Pokémon Name</th>
                              <th class="text-primary">Type 1</th>
                              <th class="text-primary">Type 2</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                              <tr>
                                  <td class="text-primary"><?php echo $row['pokemon_name'] ?></td>
                                  <td class="text-primary"><?php echo $row['type_1'] ?></td>
                                  <td class="text-primary"><?php echo $row['type_2'] ?></td>
                              </tr>
                          <?php endwhile; ?>
                      </tbody>
                  </table>

                <?php else : ?>
                    <p class="text-danger">No Pokémon were found in the database.</p>
                <?php endif; ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 7: Which five (5) Pokémon have the highest HP (Hit Points) amongst all 'Water' types?</h3>
              <?php
                  $sql = "SELECT pokemon_name, hp FROM pokedex WHERE type_1 = 'Water' OR type_2 = 'Water' ORDER BY hp DESC LIMIT 5;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) : ?>
                       
                    <table class="table table-striped text-primary">
                      <thead>
                          <tr>
                              <th class="text-primary">Pokémon Name</th>
                              <th class="text-primary">HP (Hit Points)</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                              <tr>
                                  <td class="text-primary"><?php echo $row['pokemon_name'] ?></td>
                                  <td class="text-primary"><?php echo $row['hp'] ?></td>
                              </tr>
                          <?php endwhile; ?>
                      </tbody>
                  </table>
  
                  <?php else : ?>
                      <p class="text-danger">No Pokémon were found in the database.</p>
                  <?php endif; ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 8: What is the total number of Pokémon in each generation?</h3>
              <?php
                  $sql = "SELECT generation, COUNT(*) AS total_pokemon FROM pokedex GROUP BY generation;";
                  $result = mysqli_query($connection, $sql);

                  if (mysqli_num_rows($result) > 0) : ?>
                       
                    <table class="table table-striped text-primary">
                      <thead>
                          <tr>
                              <th class="text-primary">Generation</th>
                              <th class="text-primary">Total number of Pokémon</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                              <tr>
                                  <td class="text-primary"><?php echo $row['generation'] ?></td>
                                  <td class="text-primary"><?php echo $row['total_pokemon'] ?></td>
                              </tr>
                          <?php endwhile; ?>
                      </tbody>
                  </table>
  
                <?php else : ?>
                     <p class="text-danger">No Pokémon were found in the database.</p>
                <?php endif; ?> 

            <h3 class="mt-4" style="font-size: 20px;">Question 9: What are the names of Pokémon that have both "Ghost" and "Fairy" as their types?</h3>
              <?php
                    $sql = "SELECT pokemon_name FROM pokedex WHERE (type_1 = 'Ghost' AND type_2 = 'Fairy') OR (type_1 = 'Fairy' AND type_2 = 'Ghost');";
                    $result = mysqli_query($connection, $sql);
    
                    if (mysqli_num_rows($result) > 0) {

                      $pokedex = [];
  
                      while ($row = mysqli_fetch_assoc($result)) {
                          $pokedex[] = $row['pokemon_name'];
                      }
  
                      $last_pokemon = array_pop($pokedex);
                      $pokemon_list = implode(", ", $pokedex);
  
                      if (!empty($pokemon_list)) {
                          echo "<p class=\"text-primary\">$pokemon_list, and $last_pokemon are the names of Pokémon that have both 'Ghost' and 'Fairy' as their types.</p>";
                      } else {
                          echo "<p class=\"text-primary\">$last_pokemon is the name of Pokémon that have both 'Ghost' and 'Fairy' as their types.";
                      }
                  } else {
                      echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                  }
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 10: What is the average HP, attack, and defense stats of the Pokémon belonging to the "Grass" type?</h3> 
              <?php
                  $sql = "SELECT AVG(hp) AS average_hp, AVG(attack) AS average_attack, AVG(defense) AS average_defense FROM pokedex WHERE type_1 = 'Grass' OR type_2 = 'Grass';";
                  $result = mysqli_query($connection, $sql);
                  
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<p class=\"text-primary\">The stats of the Pokemon belonging to the 'Grass' type are the following : the average HP is " . number_format($row['average_hp']) . ", the avarage attack is " . number_format($row['average_attack']) . ", and the average defense is " . number_format($row['average_defense']) . ".</p>";
                    }
                  } else {
                    echo "<p class=\"text-danger\">No Pokémon were found in the database.</p>";
                  }
                  
                    // to remove round off -- remove : number_format()
              ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 11: Insert a new Pokémon into the Pokédex with the following details: 

                Name: Sprigatito
                Type: Grass
                HP: 40
                Attack: 61
                Defense: 54
                Speed: 65
                Sp. Atk: 45
                Sp. Def: 45
                Generation: 9
                Legendary: No

            Retrieve the record for Sprigatito and display it to the user.</h3>

            <?php

                $check_sql = "SELECT * FROM pokedex WHERE pokemon_name = 'Sprigatito';";
                $check_result = mysqli_query($connection, $check_sql);

                if (mysqli_num_rows($check_result) == 0) {
                    $insert_sql = "INSERT INTO pokedex (
                        pokemon_name, type_1, hp, attack, defense, speed, special_attack, special_defense, generation, legendary
                    ) VALUES (
                        'Sprigatito', 'Grass', 40, 61, 54, 65, 45, 45, 9, 0
                    );";

                    if (mysqli_query($connection, $insert_sql)) {
                        echo "<p class='text-success'>Sprigatito was successfully added to the Pokédex.</p>";
                    } else {
                        echo "<p class='text-danger'>Error inserting Sprigatito: " . mysqli_error($connection) . "</p>";
                    }
                } else {
                    echo "<p class='text-warning'>Sprigatito already exists in the Pokédex.</p>";
                }

                $sql = "SELECT * FROM pokedex WHERE pokemon_name = 'Sprigatito';";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                echo "<p class=\"text-primary\">Pokémon Name: " . $row['pokemon_name'] . "</p>";
                echo "<p class=\"text-primary\">Type: " . $row['type_1'] . "</p>";
                echo "<p class=\"text-primary\">HP: " . $row['hp'] . "</p>";
                echo "<p class=\"text-primary\">Attack: " . $row['attack'] . "</p>";
                echo "<p class=\"text-primary\">Defense: " . $row['defense'] . "</p>";
                echo "<p class=\"text-primary\">Speed: " . $row['speed'] . "</p>";
                echo "<p class=\"text-primary\">Special Attack: " . $row['special_attack'] . "</p>";
                echo "<p class=\"text-primary\">Special Defense: " . $row['special_defense'] . "</p>";
                echo "<p class=\"text-primary\">Generation: " . $row['generation'] . "</p>";
                echo "<p class=\"text-primary\">Legendary: " . ($row['legendary'] ? 'Yes' : 'No') . "</p>";
                } else {
                    echo "<p class='text-danger'>Sprigatito not found in the database.</p>";
                }
            ?>
            
            <h3 class="mt-4" style="font-size: 20px;">Question 12: Increment Sprigatito speed stat by 10 and display the updated entry to the user.</h3>

            <?php
                $update_sql = "UPDATE pokedex SET speed = speed + 10 WHERE pokemon_name = 'Sprigatito';";
                mysqli_query($connection, $update_sql);

                $sql = "SELECT * FROM pokedex WHERE pokemon_name = 'Sprigatito';";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                echo "<p class=\"text-primary\">Pokémon Name: " . $row['pokemon_name'] . "</p>";
                echo "<p class=\"text-primary\">Type: " . $row['type_1'] . "</p>";
                echo "<p class=\"text-primary\">HP: " . $row['hp'] . "</p>";
                echo "<p class=\"text-primary\">Attack: " . $row['attack'] . "</p>";
                echo "<p class=\"text-primary\">Defense: " . $row['defense'] . "</p>";
                echo "<p class=\"text-primary\">Speed: " . $row['speed'] . "</p>";
                echo "<p class=\"text-primary\">Special Attack: " . $row['special_attack'] . "</p>";
                echo "<p class=\"text-primary\">Special Defense: " . $row['special_defense'] . "</p>";
                echo "<p class=\"text-primary\">Generation: " . $row['generation'] . "</p>";
                echo "<p class=\"text-primary\">Legendary: " . ($row['legendary'] ? 'Yes' : 'No') . "</p>";
                } else {
                echo "<p class='text-danger'>Sprigatito not found in the database.</p>";
                }
            ?>

            <h3 class="mt-4" style="font-size: 20px;">Question 13: Delete Sprigatito from the Pokédex and try to display it to the user.</h3>

            <?php
                $delete_sql = "DELETE FROM pokedex WHERE pokemon_name = 'Sprigatito';";
                mysqli_query($connection, $delete_sql);

                $sql = "SELECT * FROM pokedex WHERE pokemon_name = 'Sprigatito';";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                echo "<p class=\"text-primary\">Pokémon Name: " . $row['pokemon_name'] . "</p>";
                echo "<p class=\"text-primary\">Type: " . $row['type_1'] . "</p>";
                echo "<p class=\"text-primary\">HP: " . $row['hp'] . "</p>";
                echo "<p class=\"text-primary\">Attack: " . $row['attack'] . "</p>";
                echo "<p class=\"text-primary\">Defense: " . $row['defense'] . "</p>";
                echo "<p class=\"text-primary\">Speed: " . $row['speed'] . "</p>";
                echo "<p class=\"text-primary\">Special Attack: " . $row['special_attack'] . "</p>";
                echo "<p class=\"text-primary\">Special Defense: " . $row['special_defense'] . "</p>";
                echo "<p class=\"text-primary\">Generation: " . $row['generation'] . "</p>";
                echo "<p class=\"text-primary\">Legendary: " . ($row['legendary'] ? 'Yes' : 'No') . "</p>";
                } else {
                echo "<p class='text-danger'>Sprigatito not found in the database.</p>";
                }
            ?>
            
          </div>
        </div>
      </section>
    </main>
  </body>
</html>

<?php

db_disconnect($connection);

?>

<!-- Images Sources:
https://www.amazon.ca/Pokemon-Gaming-Poster-Evolution-Version/dp/B0BGYGD8TH
https://bulbapedia.bulbagarden.net/wiki/Mythical_Pok%C3%A9mon
https://aminoapps.com/c/pokemon/page/blog/who-is-strong-ash-vs-misty/EzhP_u5XJwelzrGW6drG3m4RL6q27Q
https://www.lemonde.fr/en/culture/article/2023/01/13/pokemon-series-ends-after-25-years-and-1-200-episodes_6011499_30.html
-->