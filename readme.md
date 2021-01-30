# Cofessa

### Versión 1.0

Sitio web hecho con laravel 5.2 y bootstrap 2. Sin ajax y con jquery solamente para mejorar un poco la presentación visual.

#### Requerimientos

Contar con un servicio de hosting de preferencia especializado que al menos ofrezca lo siguiente para facilitar la instalación, ya que la falta de requerimientos puede dificultar este proceso:

- Servidor http (apache, nginx, etc...).
- Debe tener php activado, con la versión 5.5.9 como mínima y 7.2.x como la máxima.
- Contar con las siguientes extensiones habilitadas en php: `gd, fileinfo, json, mbstring, pdo, pdo_mysql, tokenizer y openssl`.
- Git.
- Composer.
- MySQL/MariaDB.
- Acceso ssh/sftp/rsync con suficientes permisos.

#### Instalación

- Leer el archivo `install.md` para más información.

#### Rutas de acceso

- Ingresar: `https://{url}/ingresar`
- Registro: `https://{url}/registro`
- Reestablecer usuario: `https://{url}/perfil/reestablecer-usuario`

#### Importante

- Por defecto la ruta de registro ha sido bloqueada, por lo que para volver activarla hay que buscar y abrir el archivo `.env` y cambiar el valor de `ALLOW_USER_REGISTRATION=false` a `ALLOW_USER_REGISTRATION=true`. Se recomienda mantenerla inhabilitada después de crear un nuevo usuario.

#### Licencia

Leer `license.md` para más información.
