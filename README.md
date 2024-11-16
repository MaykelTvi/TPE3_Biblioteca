# TPE3_Biblioteca
Integrantes: Menna Zujani, Bautista / Tvihaug, Maykel 

Rutas para prestamos


Listar todos los préstamos
Método: GET
Ruta completa: http://localhost/tpeapi/prestamos


Modificar un préstamo existente
Método: PUT
Ruta completa: http://localhost/tpeapi/prestamo/:ID
{
    "id_libro": 1,
    "id_usuario": 2,
    "fecha_prestamo": "2024-01-01"
}


Agregar un nuevo préstamo
Método: POST
Ruta completa: http://localhost/tpeapi/prestamo
{
    "id_libro": 1,
    "id_usuario": 2,
    "fecha_prestamo": "2024-01-01"
}


Eliminar un préstamo
Método: DELETE
Ruta completa: http://localhost/tpeapi/prestamo/:ID
Ejemplo: http://localhost/tpeapi/prestamo/1



Rutas para libros

Listar todos los libros
Método: GET
Ruta completa: http://localhost/tpeapi/libros


Query Params Opcionales:
sort (Ordenar por columna): Ejemplo: http://localhost/tpeapi/libros?sort=titulo
order (ASC o DESC): Ejemplo: http://localhost/tpeapi/libros?order=DESC
ambos: Ejemplo: http://localhost/tpeapi/libros?sort=titulo&order=DESC


Obtener un libro por su ID
Método: GET
Ruta completa: http://localhost/tpeapi/libros/:ID



Modificar un libro existente
Método: PUT
Ruta completa: http://localhost/tpeapi/libro/:ID
{
    "titulo": "Nuevo Título",
    "autor": "Autor Actualizado",
    "prestado": (0 o 1)
}


Agregar un nuevo libro
Método: POST
Ruta completa: http://localhost/tpeapi/libro
{
    "titulo": "Título del Libro",
    "autor": "Autor del Libro",
    "prestado": (0 o 1)
}


Eliminar un libro
Método: DELETE
Ruta completa: http://localhost/tpeapi/libro/:ID