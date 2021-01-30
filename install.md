# Cofessa

### Versión 1.0

#### Instalación

**IMPORTANTE**

Estos pasos deben ser realizados por alguien que tenga conocimiento de cómo configurar servidores, bases de datos y gestión de archivos, de lo contrario el producto puede quedar configurado incorrectamente y funcionar mal. Poner mucha atención a lo siguiente.

#### Instrucciones

*Se pueden usar otros nombres, carpetas y otras estructuras. Solo son referencias.*

- Crear una carpeta llamada `webapps` en la raíz.

- Entrar a `/webapps`.

- Cargar archivo `cofessa.zip` en `/webapps`.

- Adentro de `/webapps` crear carpeta llamada `_uploads`.

- Mover `/webapps/xtras/uploads.zip` a `/webapps/_uploads`.

- Descomprimir `cofessa.zip` en `/webapps`.

- Descomprimir `externos.zip` en`/webapps/_uploads`.

- Crear una nueva base de datos llamada `cofessa_app` o renombrar la creada por el proveedor. Si no se puede que se quede así.

- Verificar que la codificación de la base de datos sea `utf8mb4_unicode_ci`. Editarla si no es el caso.

- Importar las tablas y registros en la base de datos seleccionando el archivo llamado `cofessa_app.sql` ubicado en `/webapps/cofessa/database`.

- En caso que el hosting permita agregar usuarios hay que hacer uno nuevo llamado `cofessa_app` con los mismos parámetros que el default otorgado por el proveedor. Caso contrario intentar renombrar el original a `cofessa_app`. No pasa nada si no se puede.

- Intentar asignar permisos de `select, insert, update, delete, references` e `index` al usuario nuevo/editado de la base de datos y las nuevas tablas del proyecto. Tampoco pasa nada si no se puede.

- Guardar los datos del nuevo usuario creado/editado en papel o bloc de texto.

- Refrescar permisos en la base de datos.

- Averiguar la carpeta o enlace donde se guardan las páginas html para ponerlas visibles al público (suele ser `www`, `public_html`, `htdocs` o similar, consultar al proveedor de hosting si hay dudas).

- Guardar el nombre y la ruta completa de la mencionada carpeta o enlace (por ejemplo: `carpeta1/carpeta2/public_html`). Después borrar esa carpeta vieja o enlace viejo.

- Crear un enlace simbólico desde `/webapps/cofessa/public` hacia `/carpeta1/carpeta2/public_html`.

- Crear otro enlace simbólico desde `/webapps/_uploads/cofessa` hacia `/carpeta1/carpeta2/public_html/uploads`.

- Asignar permisos de lectura y escritura a las carpetas `/webapps/cofessa/bootstrap/cache`, `/webapps/cofessa/storage`, `/webapps/_uploads/cofessa` y `/carpeta1/carpeta2/public_html/uploads`.

- Generar un archivo `.env`, copiar y pegar los campos del archivo de ejemplo llamado `.env.example` y configurar cada campo de acuerdo a los parámetros otorgados por el proveedor y los creados o editados previamente.

- Abrir el sitio de la organización en un navegador y comprobar la instalación.
