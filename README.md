# Simulador de Préstamos y Capacidad de Endeudamiento

## Indice

1. [¿En qué consiste?](#1-en-que-consiste)
2. [¿Cómo ejecutar en local?](#2-como-ejecutar-en-local)
   - [Instalar dependencias](#instalar-dependencias)
   - [Configurar variables de entorno](#configurar-variables-de-entorno)
   - [Generar clave de aplicación](#generar-clave-de-aplicacion)
   - [Construir los archivos del frontend](#construir-los-archivos-del-frontend)

## ¿En qué consiste?
En este repositorio se presenta una solución a la problemática planteada sobre un sistema crediticio que pueda calcular la capacidad de endeudamiento y el monto máximo que puede ser aprobado basado en la situación financiera de cada cliente.


## 2. ¿Cómo ejecutar en local?
Para ejecutar el proyecto en un entorno local, siga los siguientes pasos:

### Instalar dependencias
Ejecute los siguientes comandos para instalar las dependencias del proyecto:
```bash
composer install
npm install
```
### Configurar variables de entorno
Después de instalar las dependencias, cree un archivo `.env` y modifique las siguientes variables para evitar el uso de una base de datos y prevenir errores en la ejecución:
```bash
DB_CONNECTION=null
SESSION_DRIVER=file
```
### Generar clave de aplicación
Ejecute el siguiente comando para generar la clave de la aplicación:
```bash
php artisan key:generate
```
### Construir los archivos del frontend
Ejecute el siguiente comando para compilar los archivos necesarios:
```bash
npm run build
```
Finalmente, ejecute el siguiente comando para iniciar el servidor local:  
```bash
php artisan serve
```

