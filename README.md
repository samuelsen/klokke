# Clock
To use this you'll need to edit the "sqlConnect.php" within the admin folder to set the connection to your database.

In the database you'll need a table called "clock" with these colloms: 

Name        |    Type
------------|------------------------
countTime   |    Time
timeStamp   |    Time
show        |    int(1)

NB! for now you'll need to do a first input manually before the clock will work.
  Run this SQL: INSERT INTO clock ('countTime', 'timeStamp', 'show') VALUES (CURRENT_TIME(), CURRENT_TIME(), '1');
