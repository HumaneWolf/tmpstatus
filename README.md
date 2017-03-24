# TruckersMP Server Status

This is a simple server status page for the [TruckersMP Multiplayer Mod](http://truckersmp.com/) for American Truck Simulator and Euro Truck Simulator 2, built using their official API.

## Features:  

* App level caching - The page will only load from the API if the saved data is older than 90 seconds, if not it will use the data from a previous pageload.  
* Does NOT require a DB - Saves in files using the json format and plaintext.

## Requirements

* PHP 5.6+  
* Composer  

## Installation

* Download and unpack it.  
* Point your webserver to the `/public` directory.  
* Run `composer install`

## See it in action

**[sandbox.humanewolf.com/tmpstatus](https://sandbox.humanewolf.com/tmpstatus/)**
