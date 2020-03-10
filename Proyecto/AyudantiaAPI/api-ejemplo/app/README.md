# IIC2413 - Bases de Datos - Entrega 4 Grupo 26 (y ex 31)


### Integrantes

Nombre            | 
----------------- | 
Santiago Laguna | 
Tomás Cortéz | 
José Laguna |
Ignacio Rojas |

Grupos 26 y 31

## Sobre la entrega
el archivo a correr desde la terminal es main.py.

las direcciones son exactamente las mismas que las del enunciado de la entrega. las formas get, post y delete también lo son

Ejemplos a correr desde chrome:

.../all (esta ruta extra permite ver todos los mensajes)
.../messages/b17d8866-b4f7-46b0-8379-21c5ee2cd1e1
.../messages/project-search?nombre=yo

Ejemplos para correr en postman:

.../messages/content-search, body-raw-json: {"required": ["hola"], "forbidden":["olla"]}

.../messages/content-search, body-raw-json: {"required": ["hola"]}

.../messages/content-search, body-raw-json: {"forbidden":["hola"]}

.../messages/content-search, body-raw-json: {"desired": ["hola"]}

.../messages/content-search, body-raw-json: {required: ["hola"], "desired": ["olla"]}

agregar mensaje: 
.../messages
body-raw-json: {"content": "ayudante ponme un 7 plis", "metadata": {"time": "1900-12-17 10:20:37", "sender": "grupo26",
"receiver": "mejor ayudante"
}
}

borrar mensaje:
.../messages/{*} donde * es cualquier id de los que aparece en la ruta .../all
