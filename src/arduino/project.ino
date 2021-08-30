/* Includes */
#include <SoftwareSerial.h>
#include <Wire.h> 
#include "ArduinoESPAT.h"
#include "Adafruit_Fingerprint.h"
#include "LiquidCrystal_I2C.h"
/* Defines */
// Wifi use 12 for RX, 13 for TX 
#define wifis "YOUR WIFI"
#define passwords "YOUR PASSWORD"
#define FINGER_RX 10
#define FINGER_TX 11
#define b_check 2
#define b_daftar 3
#define b_delete 4
#define buzzer 9

/* Serials */
SoftwareSerial finger_print(FINGER_RX,FINGER_TX);

/* Class */
LiquidCrystal_I2C lcd(0x27, 16, 2);
ESPAT espat(wifis, passwords);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&finger_print);

/* Variables */
String esp_get;
int is; 
uint8_t id;
uint8_t pilih = 0;
String scan_id;
String webs = "Your domain (without https/http)";

/* Arduino Functions */
void setup(){
  pinMode(b_check, INPUT_PULLUP);
  pinMode(b_daftar, INPUT_PULLUP);
  pinMode(b_delete, INPUT_PULLUP);
  pinMode(buzzer, OUTPUT);
  Serial.begin(9600);
  lcd.init();
  lcd.backlight();
  if(espat.begin()){
    Serial.println("Initialize Ok");
    set_lcd("Setup...", "Wifi OK..");
  }else{
    Serial.println("Initialize Fail");
    set_lcd("Setup...", "Wifi FAIL..");
  }

  if(espat.changeMode(1)){
    Serial.println("Mode OK");
    set_lcd("Setup...", "mode OK..");
  }else{
    Serial.println("Mode not OK");
    set_lcd("Setup...", "mode not OK..");
  }

  if(espat.tryConnectAP()){
    Serial.println("Connected");
    set_lcd("Setup...", "connect OK..");
  }else{
    Serial.println("Connect Failed");
    set_lcd("Setup...", "Fail connect..");
  }
  set_lcd("Setup...", "Fingerprint..");
  /* Finger print sensor detection */
  finger.begin(57600);
  if (finger.verifyPassword()) {
    Serial.println("Sensor Fingerprint Terdeteksi!");
    set_lcd("Setup...", "Sensor detected");
  } else {
    Serial.println("Sensor Fingerprint tidak terdeteksi :(");
    while (1) { delay(1); }
    set_lcd("Setup...", "Sensor not detect");
  }
  
  Serial.println(F("Reading sensor parameters"));
  finger.getParameters();
  Serial.print(F("Status: 0x")); Serial.println(finger.status_reg, HEX);
  Serial.print(F("Sys ID: 0x")); Serial.println(finger.system_id, HEX);
  Serial.print(F("Capacity: ")); Serial.println(finger.capacity);
  Serial.print(F("Security level: ")); Serial.println(finger.security_level);
  Serial.print(F("Device address: ")); Serial.println(finger.device_addr, HEX);
  Serial.print(F("Packet len: ")); Serial.println(finger.packet_len);
  Serial.print(F("Baud rate: ")); Serial.println(finger.baud_rate);
  Serial.println("Finishing Setup");
  set_lcd("Setup...", "Complete");
}

void loop(){
  if(pilih != 1){
    delay(50);
    set_lcd("Select Mode", "(1)  (2)  (3)");
    Serial.println("Select (1) (2) (3)");
    if(digitalRead(b_check) == LOW){
      Buzzer_bunyi();
      pilih = 1;
    }
    else if(digitalRead(b_daftar) == LOW){
      Buzzer_bunyi();
      pilih = 2;
    }
    else if(digitalRead(b_delete) == LOW){
      Buzzer_bunyi();
      pilih = 3;
    }
    else{
      return true;
    }
  }

  if(pilih == 2){ 
    set_lcd("Daftar...", "Mencari ID");
    if(espat.begin()){
      Serial.println("Initialize Ok");
    }else{
      Serial.println("Initialize Fail");
    }
    if(espat.tryConnectAP()){
      Serial.println("Connected");
    }else{
      Serial.println("Connect Failed");
    }
  
    Serial.println(espat.clientIP());
    Serial.print("Random register id: ");
    esp_get = espat.get(webs, "/api/register", 80);
    esp_get.remove(0,1);
  
    is = esp_get.toInt();
    id = is;
  
    set_lcd("Mendaftar...", "");
    delay(2000);
  
    finger.begin(57600);
    while (!  getFingerprintEnroll() );
  }
  else if(pilih == 3){
    set_lcd("Hapus...", "Mencari ID..");
    if(espat.begin()){
      Serial.println("Initialize Ok");
    }else{
      Serial.println("Initialize Fail");
    }
    if(espat.tryConnectAP()){
      Serial.println("Connected");
    }else{
      Serial.println("Connect Failed");
    }
  
    Serial.println(espat.clientIP());
    Serial.print("Random register id: ");
    esp_get = espat.get(webs, "/api/delete", 80);
    esp_get.remove(0,1);
  
    is = esp_get.toInt();
    id = is;

    if(id == 0){
      Serial.println("Tidak ada yang bisa dihapus");
      set_lcd("Tidak ada ID", "untuk dihapus..");
      delay(1000);
      return;
    }
    Buzzer_bunyi();
    set_lcd("Mengahapus ID", (String) id);
    delay(1000);
    Serial.print("Deleting ID #");
    Serial.println(id);

    finger.begin(57600);
    deleteFingerprint(id);
  }
  else if(pilih == 1){
    if(digitalRead(b_daftar) == LOW){
      Buzzer_bunyi();
      pilih = 0;
      return true;
    }
    else if(digitalRead(b_delete) == LOW){
      Buzzer_bunyi();
      pilih = 0;
      return true;
    }
    else if(digitalRead(b_check) == LOW){
      Buzzer_bunyi();
      pilih = 0;
      return true;
    }
    finger.begin(57600);
    set_lcd("Silahkan absent...", "");
    id = getFingerprintIDez();

    scan_id = String(id);
    delay(50);            //don't ned to run this at full speed.
    if(id != 255){
      Buzzer_bunyi();
      set_lcd("Menemukan jari...", "Connecting..");
      if(espat.begin()){
        Serial.println("Initialize Ok");
      }else{
        Serial.println("Initialize Fail");
      }
      if(espat.tryConnectAP()){
        Serial.println("Connected");
      }else{
        Serial.println("Connect Failed");
      }
    
      Serial.println(espat.clientIP());
      Serial.print("Random register id: ");
      esp_get = espat.get(webs, "/api/absent?id="+scan_id, 80);
      esp_get.remove(0,1);
      Serial.println(esp_get);
      set_lcd("Halo,", esp_get);
      delay(1000);
      int u;
      Buzzer_bunyi();
      for (u = 0 ; u < 16; u++) {
        lcd.scrollDisplayLeft();
        //lcd.scrollDisplayRight();
        delay(500);
      }
    }
  }
}
void Buzzer_bunyi(){
  digitalWrite(buzzer, HIGH);
  delay(300);
  digitalWrite(buzzer, LOW);
}

/* Other Functions */
void set_lcd(String value_1, String value_2){
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print(value_1);

  lcd.setCursor(0, 1);
  lcd.print(value_2);
}
uint8_t readnumber(void) {
  uint8_t num = 0;
  
  while (num == 0) {
    while (! Serial.available());
    num = Serial.parseInt();
  }
  return num;
}

/* Fingerprint Functions */
uint8_t deleteFingerprint(uint8_t id) {
  uint8_t p = -1;
  
  p = finger.deleteModel(id);
  if (p == FINGERPRINT_OK) {
    set_lcd("Berhasil ID:", (String) id);
    delay(1000);
    Serial.println("ID berhasil dihapus!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not delete in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.print("Unknown error: 0x"); Serial.println(p, HEX);
    return p;
  }   
}

uint8_t getFingerprintID() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("No finger detected");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  // OK success!
  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK) {
    Serial.println("Found a print match!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_NOTFOUND) {
    Serial.println("Did not find a match");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
  
  // found a match!
  Serial.print("Found ID #"); Serial.print(finger.fingerID); 
  Serial.print(" with confidence of "); Serial.println(finger.confidence); 
  return finger.fingerID;
}
// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;
  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;
  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;
  
  // found a match!
  Serial.print("ID yang ditemukan #"); Serial.print(finger.fingerID); 
  Serial.print(" dengan ketepatan "); Serial.println(finger.confidence);
  return finger.fingerID; 
}

uint8_t getFingerprintEnroll() {
  int p = -1;
  set_lcd("Mendaftar...", "Letakan jari anda");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      Buzzer_bunyi();
      set_lcd("Mendaftar...", "Gambar diterima");
      delay(1000);
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println(".");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }
  // OK success!
  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      set_lcd("Mendaftar...", "Foto dikonversi");
      delay(1000);
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      set_lcd("Mendaftar...", "Foto kotor..");
      delay(1000);
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  set_lcd("Mendaftar...", "Angkat jari");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); Serial.println(id);
  p = -1;
  set_lcd("Mendaftar...", "Letakan lagi..");
  delay(1000);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Buzzer_bunyi();
      set_lcd("Mendaftar...", "Berhasil..");
      delay(1000);
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.print(".");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }
  // OK success!
  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  // OK converted!
  set_lcd("Mendaftar...", "Menyimpan");
  delay(1000);
  Serial.print("Creating model for #");  Serial.println(id);
  
  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("Fingerprint Sesuai!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Komunikasi error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints tidak sesuai");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
  
  Serial.print("ID "); Serial.println(id);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    Buzzer_bunyi();
    set_lcd("Mendaftar...", "Tersimpan");
    delay(1000);
    Serial.println("Tersimpan!");
    return true;
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Komunikasi error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Tidak bisa menyimpan di penyimpanan.");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
}
