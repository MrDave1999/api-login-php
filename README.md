# api-login-php

This repository shows a simple example of how to create a token-based authentication using [JWT](https://jwt.io/introduction) as standard.

## Installation

### On Linux:

**1.** Clone the repository:
```git
git clone https://github.com/MrDave1999/api-login-php.git
```

**2.** Change directory:
```
cd api-login-php
```

**3.** Change user and group to the storage and bootstrap directories so that the web server can write to those directories:
```
sudo chown -R www-data:www-data ./storage ./bootstrap
```

**4.** Add your user to the `www-data` group and set write permissions to the group:
```
sudo usermod -aG www-data $USER
sudo chmod -R g+w ./bootstrap
```

**5.** Copy the contents of `.env.example` to `.env`:
```
cp .env.example .env
```

**6.**  Install the project dependencies:
```
docker run --rm -it -v $PWD:/app composer install
```

**7.** Build the image and initiate services:
```
docker-compose up --build -d
```

**8.** Access the application with this URL:
```
http://localhost:8080/
```

### On Windows:

**1.** Clone the repository:
```git
git clone https://github.com/MrDave1999/api-login-php.git
```

**2.** Change directory:
```
cd api-login-php
```

**3.** Copy the contents of `.env.example` to `.env`:
```
xcopy .env.example .env
```

**4.**  Install the project dependencies:
```
docker run --rm -it -v %cd%:/app composer install
```

**5.** Build the image and initiate services:
```
docker-compose up --build -d
```

**6.** Access the application with this URL:
```
http://localhost:8080/
```
## Documentation

Consult the [wiki](https://github.com/MrDave1999/api-login-php/wiki/Endpoints) to find out what the endpoints are and what they mean.