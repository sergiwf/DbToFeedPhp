Generador de Feeds de RocketROI a partir de una base de datos
==================================
Se trata de un ejecutable en PHP que dada una consulta en SQL, genera un archivo de con todos los resultados de forma bien estructurada. 

## Requisitos

  * PHP 5+
  

## Empezando

El ejecutable ha de recibir un archivo properties.ini con los siguientes parametros:

* Tipo y datos de acceso a la base de datos
* Sentencia SQL para generar los datos.
* Archivo de salida de datos.

Actualmente soporta las siguientes bases de datos:

* PostgreSql
* MySql

y los siguientes formatos de salida:

* CSV

## Ejemplos de uso

Ejemplo de archivo de propiedades para PostgreSql:

```
database=postgres
databaseServer=127.0.0.1
databasePort=5432
databaseName=test
user=test
password=test
select=select * from test_table
output=default

```

Si usas MySql:
```
database=mysql
databaseServer=127.0.0.1
databasePort=3306
databaseName=test
user=test
password=test
select=select * from test_table
output=default

```

El proceso empezará a hacer consultas incrementales de 500 registros hasta que haya acabado de generar todo el archivo de salida.

Puedes controlar el número de registros por consulta añadiendo la siguiente linea al archivo de propiedades:

```
limit=100
```

Para llamar al ejecutable inicializar el siguiente archivo:

```
php DbToFeedPhp.php
```
