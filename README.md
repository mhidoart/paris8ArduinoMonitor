# ArduinoMonitor
the idea of this project is to monitor  humidity &amp; temperature (smoke , light added later) of a place  and being able to see the result from anywhere, for example you can see the temperature of your house or the humidity of youre Greenhouse ( indoor garden) to Maintain the health of your plants.  

Technical description: 
1. the project is made using "arduino wemos D1 R1" + multiple detectors ( humidity, temperature, smoke, light). 
2. as depndecies we used multiple libraries: WiFi, HTTPClient,SimpleTimer..etc   you can see the results of the project on :    http://assabbane.com/paris8/

# how to make this project yourself

1. copy all php files in a folder on your website (lets suppos the name of folder is arduinoMonitor)
2. create a database (and a user who can use the database if you work online "cpanel ...etc" )
3. add the credencials to your database in connect.php (db_name,db_user,db_password)
4. import to your database  the file "tempLog.sql" who will create the  table (where data is stored) 
- by default the created table has already some data so after this step you can see already some graphs (localhost/arduinoMonitor/index.php)
5. very important! change the serverName variable in sketch.ino to your URL and change (char ssid[] = "mehdi"; char pass[] = "mehdi123";) to the credencials of your wifi

# wiring 
i'l add it later but its obvious from the sketch.ino

# fiew tips if you are a beginner

- i recommend that u do this section (how to make this project yourself) online since ur arduino will be connected to the internet,
or if you want to work locally your computer should be visible in LAN (local area network) and u should change the serverName in sketch.ino to the IP of your computer.

-don't forget to change serverName and wifi credencials in sketch.ino or no new data will be added and of cours the wiring of the detectors to arduino
