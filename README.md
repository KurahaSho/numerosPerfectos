# Numeros perfectos
 
Los números **naturales perfectos** son enteros positivos que cumplen con la regla de  n = sum(divisores propios) donde multiplos propios son aquellos que dejan como residuo de la división 0.
En este desarrollo se intenta hayar números **naturales perfectos** a partir de un intervalo escogido por el usuario, quien ingresa los números que establecen el límite.
 
## Implementación

Los números naturales perfectos tienen profunda relación con los números primos, euclides demostró que mediante la fórmula
2^(n-1) (2^n - 1), sin embargo se ha descartado esta opción, puesto que había que elevar cada número del rango a escoger para poder verificar, lo que significaría números mucho más grandes y un espacion mayor en memoria ram.
Para poder usar números grandes en php sin perder presición es necesario usar librerías "no estandar" para el proyecto se usa **GMP**, es necesario activarlo mediante php.ini (`;extension=gmp`) o mediante línea de comandos, además también usamos `max_execution_time` con un tiempo variable, puesto que depende de la magnitud de los números a evaluar

## Metodología

Para el proyecto se usó php orientado a objetos para el procesamiento de datos, html, css y bootstrap en general para el desarrollo del front y finalmente usamos una base de datos (numeros_palindromos), que contiene una sola tabla donde serán almacenados los naturales perfectos y sus divisores (numeros).

## En trabajo

- Aumentar rendimiento
- Crear tests
- Garantizar ejecución prolongada (actualmente tras 120s el servidor detiene la ejecución)  --Terminado.

## Uso

El modulo principal del programa es la clase llamada `NumerosPerfectos` la cual tiene una función recursiva `procesarRango(numeroFinal, numeroInicio)`,  que recibe como parámetros 2 números y crea un rango de acción, dentro de ese rango se escoge a fueza bruta números objetivos, "presuntos palíndromos", a partir de esa suposición se obtienen los divisores propios del número con un el bucle `for ($i = 1; $i < $numeroInicio; $i++)` valiendose nuevamente de la fuerza bruta y el operador módulo que nos dice cuando es un divisor propio `if ($numeroInicio % $i == 0)`.<br/><br/>

Esta clase además posee una llamada a la función `guardarNumeroPerfecto`  en la clase `DatabaseHandler` que es la encargada de la persistencia de información hacia sql, por lo tanto puede ser extraida y cambiar las llamadas para guardar los datos a su gusto.<br/><br/>

En el paquete además viene un pequeño frontend, construido en bootstrap 4, consiste en 2 inputs, el primero opcional (de no ingresarse se toma como 1) donde se ingresan los límites del rango (inferior - superior) y se puede visualizar el histórico de números hayados dado el rango, sin embargo al calcular rangos por que tengan el mismo valor que entradas ya en base de datos, **no son guardados** sino que se dejan los que estaban anteriormente, p.ej al poner un rango entre 1 y 10 el resultado es este 6, entonces si no da click en el botón borrar del resultado, en la siguiente consulta solo se agregarían los naturales perfectos mayores que 6. La idea a futuro es ahorrar recorrido gracias a los naturales perfectos que ya estén guardados.<br/><br/>

También podrás encontrar una carpeta con el pseudocódigo usado para planear la solución<br/><br/>

Y por último, no menos importante la clase `DatabaseHandler`  que tiene funciones para la escritura, borrado y consulta en la base de datos (mysql).<br/>
El funcionamiento de la base de datos es sencillo, sin embargo no hay que dejar de lado el formato del campo **divisores**, en el cual se separa cada número con comas de la forma n1, n2, n3, ... ,<br/>

## Nuestra base de datos

la estructura de la base de datos es la siguiente:<br/><br/>
| numerosperfectos |
|------------------|
| table: numeros   |

<br/><br/>

numeros                                        |
---------------------------------------------- |
id entero, clave primaria                      |
numero entero, unico no nulo                   |
divisores texto                                |
