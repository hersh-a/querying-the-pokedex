Querying the Pokédex

This is one of my database project where I got to work with a **Pokédex database** and practice SQL queries with PHP. 

---

## About the Project

In this project, I worked with a **Pokédex**, which is basically a database of Pokémon species. Each Pokémon has unique stats, types, and characteristics. My goal was to **create the database table, populate it, and write PHP scripts to answer specific queries** about the Pokémon.  

I also got to practice using `INSERT`, `UPDATE`, `DELETE`, and `SELECT` queries while making sure the results display nicely on a web page.  

---

## Setting Up the Table

I started with a **partial Pokédex table (`init.sql`)** that included 928 Pokémon entries. My task was to:  

1. Review the column names and data types.  
2. Decide which columns can be `NULL`.  
3. Add a `PRIMARY KEY` to the table.  
4. Finish the `CREATE TABLE` statement and run it in PHPMyAdmin.  

Once the table was created, I ran the second part of the script to **populate the table with all the Pokémon records**.  

---

## What I Did in PHP

After the table was ready, I created a PHP file to answer several queries. I made sure that all results were **legible and easy to understand**, either in complete sentences or nicely formatted HTML tables.  

Here are the tasks I completed:

1. Counted the total number of Pokémon in the Pokédex.  
2. Found the Pokémon with the **highest Attack stat** for Legendary and non-Legendary Pokémon.  
3. Counted Pokémon that are exclusively **Fire type**.  
4. Listed the **Legendary Pokémon in Generation 7** along with their attack stats.  
5. Calculated the **average Defense stat** for all Pokémon.  
6. Listed non-Legendary Pokémon with **Speed > 120** along with their types.  
7. Found the top 5 **Water-type Pokémon by HP**.  
8. Counted Pokémon in each **generation**.  
9. Found Pokémon that are **both Ghost and Fairy type**.  
10. Calculated **average HP, Attack, and Defense** for Grass-type Pokémon.  
11. **Inserted** a new Pokémon (Sprigatito) and displayed its info.  
12. **Updated Sprigatito’s Speed** and displayed the updated stats.  
13. **Deleted Sprigatito** and verified it was removed from the table.  

---

## Notes on Pokémon Data

- Pokémon can have **one or two types**. If a Pokémon only has one type, the second type is `NULL`.  
- Stats include **HP, Attack, Defense, Speed, Special Attack, and Special Defense**.  
- Each Pokémon belongs to a **Generation** (1–9). Generation 9 Pokémon were added manually in this lab.  
- **Legendary Pokémon** are rare and powerful, and they usually appear only once per game.  

