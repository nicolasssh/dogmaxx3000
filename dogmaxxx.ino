#include <Servo.h>

Servo myservo;  // création de l'objet myservo 

int pin_servo = 6;       // Pin 6 sur lequel est branché le servo sur l'Arduino si vous utilisez un ESP32 remplacez le 6 par 4 et si vous utilisez un ESP8266 remplacez le 6 par 2

int pos = 0;             // variable permettant de conserver la position du servo
int angle_initial = 0;   //angle initial
int angle_final = 90;   //angle final
int increment = 1;       //incrément entre chaque position
bool angle_actuel = false;//Envoi sur le port série la position courante du servomoteur
const int buttonPin = 2; 
int buttonState = 0;
int photocellPin = A0;
int photocellReading;

void setup() {
  Serial.begin(9600);                       
  while(!Serial){;} 
  myservo.attach(pin_servo);  // attache le servo au pin spécifié sur l'objet myservo
  pinMode(buttonPin, INPUT);
}

void loop() {

  pos = angle_final;

  buttonState = digitalRead(buttonPin);
  
  if(buttonState == HIGH) {
    for (pos = angle_initial; pos <= angle_final; pos += increment) { // Déplace le servo de 0 à 180 degrées par pas de 1 degrée 
      myservo.write(pos);              // Demande au servo de se déplacer à cette position angulaire
      delay(10);                       // Attend 30ms entre chaque changement de position
      if (angle_actuel) {
          Serial.println(myservo.read());
      }
    }
    delay(1000);
    for (pos = angle_final; pos >= angle_initial; pos -= increment) { // Fait le chemin inverse
      myservo.write(pos);              
      delay(10);   
      if (angle_actuel) {
          Serial.println(myservo.read());
      }
    }
  }
  else
   {
    pos = angle_final;
   }

  int photocellReading = analogRead(photocellPin);
   
  if (photocellReading < 10) {
    Serial.println(" - Noir");
  } else if (photocellReading < 200) {
    Serial.println(" - Sombre");
  } else if (photocellReading < 500) {
    Serial.println(" - Lumiere");
  } else if (photocellReading < 800) {
    Serial.println(" - Lumineux");
  } else {
    Serial.println(" - Tres lumineux");
  }
  delay(100);
}
