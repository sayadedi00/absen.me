Arduino Based Attendance System
===
RFID Based Attendance System using Arduino and Adafruit Fingerprint Module.

# Why did we decide to make it?
Attendance in University is generally paper based which may sometimes cause errors. Taking attendance manually consumes more time. So, In this project we have designed Fingerprint Based Attendance System using Arduino and Adafruit Fingerprint Module.

# Website settings
* Website setting is on config.php

* Using RedirectEngine on (search on google)

# Components we used in the project
* Arduino Mega Board

* AS608 Fingerprint Sensor

* ESP8266 Wifi module

* 1 Buzzer

* 3 Push Buttons

* LCD display (16*2) with i2c lcd module

# Components Connect With Arduino UNO

## ESP8266 Wifi module
---------------

|Pin   |    Wiring to Arduino Uno|
|------|-------------------------|
|TX    |    Digital 12           |
|RX    |    Digital 13           |

Caution: Menggunakan power 3.3V!


## AS608 Fingerprint Sensor
--------------------------------------------------

|Pin    |   Wiring to Arduino Uno|
|-------|------------------------|
TX      |   Digital 10
RX      |   Digital 11
VCC     |   3.3V
GND     |   GND

## I2C module
-------------

|I2C Character LCD |  Arduino|
|------------------|---------|
GND         	  |  GND
VCC        	    |  5 V
SDA        	    |  20
SDL         	  |  21

## OTHERS
-----------------

|Name           |   Wiring to Arduino Uno|
|---------------|------------------------|
BUTTON_1        |   Digital 2 ke GND
BUTTON_2        |   Digital 3 ke GND
BUTTON_3        |   Digital 4 ke GND
BUZZER          |   PIN 8 ke GND



## Contributors ✨
Thanks goes to these wonderful people ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->