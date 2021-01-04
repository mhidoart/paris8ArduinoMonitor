#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

#include "DHT.h"
#define DHTTYPE DHT11
#define dht_dpin D8
DHT dht(dht_dpin, DHTTYPE); 
SimpleTimer timer;
char ssid[] = "mehdi";
char pass[] = "mehdi123";
String link;
String serverName = "http://website.com/arduinoMonitor/add.php";


float t;
float h;

void setup()
{
    Serial.begin(9600);
    
    dht.begin();
}

void loop()
{
  delay(1000);
  sendUptime();
}

void sendUptime()
{
  float h = dht.readHumidity();
  float t = dht.readTemperature(); 
  Serial.println("Humidity and temperature\n\n");
  Serial.print("Current humidity = ");
  Serial.print(h);
  Serial.print("%  ");
  Serial.print("temperature = ");
  Serial.print(t);
   
  if(WiFi.status()== WL_CONNECTED){
    HTTPClient http;
    link = serverName;
    link += "?temp1=" + String(dht.readTemperature());
    link +=  "&hum1=" + String(dht.readHumidity());
    
    http.begin( link);
    
    
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
 
    
    String httpRequestData = "?temp1=" + String(dht.readTemperature())
                          + "&hum1=" + String(dht.readHumidity());
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    

    
    int httpResponseCode = http.POST(httpRequestData);
     
    
        
    if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();
  }
  else {
    Serial.println("WiFi Disconnected");
  }
  //Send an HTTP POST request every 30 seconds
  delay(30000);  
 
}
