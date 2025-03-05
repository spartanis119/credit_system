# Simulador de Préstamos y Capacidad de Endeudamiento

## Indice

1. [¿En qué consiste?](#1-en-que-consiste)
2. [¿Cómo ejecutar en local?](#2-como-ejecutar-en-local)
   2.1 [Instalar dependencias](#21-instalar-dependencias)
   2.2 [Configurar variables de entorno](#22-configurar-variables-de-entorno)
   2.3 [Generar clave de aplicación](#23-generar-clave-de-aplicacion)
   2.4 [Construir los archivos del frontend](#24-construir-los-archivos-del-frontend)

## 1. ¿En qué consiste?
En este repositorio se presenta una solución a la problemática planteada sobre un sistema crediticio que pueda calcular la capacidad de endeudamiento y el monto máximo que puede ser aprobado basado en la situación financiera de cada cliente.


## 2. ¿Cómo ejecutar en local?
Para ejecutar el proyecto en un entorno local, siga los siguientes pasos:

### 2.1 Instalar dependencias
Ejecute los siguientes comandos para instalar las dependencias del proyecto:
```bash
composer install
npm install
```
### 2.2 Configurar variables de entorno
Después de instalar las dependencias, cree un archivo `.env` y modifique las siguientes variables para evitar el uso de una base de datos y prevenir errores en la ejecución:
```bash
DB_CONNECTION=null
SESSION_DRIVER=file
```
### 2.4 Construir los archivos del frontend
Ejecute el siguiente comando para generar la clave de la aplicación:
```bash
php artisan key:generate
```
Por último, ejecute el siguiente comando para compilar los archivos necesarios:
```bash
npm run build
```


