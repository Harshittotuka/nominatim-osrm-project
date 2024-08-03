<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Nominatim Geocoding and Auto-Suggestions Application

# Overview
This project is a Laravel-based application that integrates with the Nominatim API to provide geocoding and auto-suggestions for addresses. The application allows users to convert addresses into geographic coordinates and receive address suggestions based on user input. The Nominatim API, built on OpenStreetMap data, is used for these operations, offering a free and reliable geocoding solution.

# Features
Geocoding: Convert a given address into geographic coordinates (latitude and longitude).
Auto-Suggestions: Get address suggestions based on a query input.
API Integration: Utilize the Nominatim API for geocoding and auto-suggestions.
Modular Codebase: Separate service and controller layers for clean and maintainable code.
User-Agent Customization: Set a custom User-Agent header for API requests.

# Installation


**Clone the repository**
```
git clone https://github.com/Harshittotuka/nominatim-osrm-project.git
cd nominatim-geocoding-app
```

**Install dependencies**

```
composer install
npm install
npm run dev
```

**Set up environment variables**

*Copy the .env.example file to .env and configure your database and other settings.*

```
cp .env.example .env
php artisan key:generate
```

**Run migrations (if any)**

```
php artisan migrate
```

**Serve the application**

```
php artisan serve
```

# API Endpoints

# Get Coordinates

**Endpoint:** /get-coordinates

**Method:** POST

**Description:** _Converts an address into geographic coordinates._

**Parameters:** _address (string) - The address to be converted._

> Example Request:

```
curl -X POST -d "address=1600 Amphitheatre Parkway, Mountain View, CA" http://127.0.0.1:8000/get-coordinates
```
> Example Response:
```
{
  "latitude": "37.4224764",
  "longitude": "-122.0842499"
}
```

# Get Suggestions

**Endpoint:** _/get-suggestions_

**Method:** _GET_

**Description:** _Provides address suggestions based on the input query._

**Parameters:** _query (string) - The query for address suggestions._

>Example Request:

```
curl -X GET "http://127.0.0.1:8000/get-suggestions?query=Amphitheatre"
```


