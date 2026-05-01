# Colonial Fleet Registry 🚀

Aplicación web de gestión de la flota superviviente de las Doce Colonias. Desarrollada en PHP puro con arquitectura MVC, permite registrar, editar y combatir naves de distintos tipos, con sistema de autenticación de usuarios y control de roles.

---

## Tecnologías

- PHP 8+
- MySQL
- PDO
- HTML5 / CSS3
- Arquitectura MVC (Model-View-Controller)
- Docker (entorno de desarrollo)

---

## Estructura del proyecto

```
EXAMEN/
├── index.php               # Front Controller — punto de entrada único
├── autoload.php            # SPL Autoloader (models/ + controllers/)
├── conf.json               # Configuración de la base de datos
├── query.sql               # Script DDL (creación de tablas)
├── style.css               # Hoja de estilos global
├── hash.php                # Utilidad auxiliar para generar hashes
│
├── models/
│   ├── Connection.php      # Singleton PDO
│   ├── GestorPDO.php       # Repositorio central de queries
│   ├── Nave.php            # Clase abstracta base
│   ├── NaveBatalla.php     # Subclase — nave de combate
│   ├── NaveCarguera.php    # Subclase — nave de logística
│   ├── NaveCientifica.php  # Subclase — nave de investigación
│   └── Usuario.php         # Modelo de usuario
│
├── controllers/
│   ├── NaveController.php      # CRUD de naves + atacar + marcarCylon
│   └── UsuarioController.php   # Login, alta, logout, idioma
│
└── views/
    ├── listar.php          # Listado principal con paginación
    ├── crear.php           # Formulario de alta de nave
    ├── editar.php          # Formulario de edición de nave
    ├── marcarCylon.php     # Marcar nave como sospechosa Cylon
    ├── login.php           # Formulario de inicio de sesión
    └── alta.php            # Formulario de registro de usuario
```

---

## Patrones y conceptos aplicados

### MVC
Separación estricta de responsabilidades. `index.php` actúa como Front Controller — recibe todas las peticiones, comprueba autenticación y delega en el controlador correspondiente. Los controladores orquestan la lógica, los modelos gestionan los datos y las vistas solo renderizan HTML.

### Singleton
`Connection.php` implementa el patrón Singleton para garantizar una única instancia de la conexión PDO durante todo el ciclo de vida de la petición, evitando conexiones redundantes al servidor de base de datos.

### Herencia y polimorfismo
`Nave` es una clase abstracta de la que heredan `NaveBatalla`, `NaveCarguera` y `NaveCientifica`. Cada subclase sobreescribe el método `recibirAtaque($impactos)` con un multiplicador de daño distinto:

| Tipo | Multiplicador | Motivo |
|---|---|---|
| NaveBatalla | × 0.5 | Blindaje reforzado |
| NaveCarguera | × 1.0 | Sin blindaje especial |
| NaveCientifica | × 2.0 | Estructura frágil |

El estado de la nave se actualiza automáticamente tras cada impacto según sus puntos de casco:

| Puntos de casco | Estado |
|---|---|
| > 90 | Activa |
| 1 – 90 | Dañada |
| 0 | Destruida |

### Single Table Inheritance
Las tres subclases de nave se almacenan en una única tabla `naves`. La columna `tipo` determina qué clase instanciar al recuperar datos. Las columnas específicas de cada subtipo quedan a `NULL` cuando no corresponden.

---

## Funcionalidades

### Naves
- Listar todas las naves con paginación (5 por página)
- Crear nuevas naves de cualquier tipo
- Editar datos de una nave existente
- Eliminar naves
- Registrar impactos de combate — el daño varía según el tipo de nave y actualiza el estado automáticamente
- Marcar naves como sospechosas de infiltración Cylon (solo administradores)

### Usuarios
- Registro de nuevos usuarios con contraseña hasheada (bcrypt)
- Inicio de sesión con verificación segura (`password_verify`)
- Opción "Recordarme" — cookie httpOnly de 30 días
- Re-autenticación automática al volver si la cookie está activa
- Cierre de sesión completo (sesión + cookies)

### Preferencias
- Selector de idioma (Español / English) guardado en sesión
- Color de cinta personalizable guardado en cookie de 30 días

### Control de acceso
| Acción | Visitante | Usuario autenticado | Admin |
|---|---|---|---|
| Ver listado | ✓ | ✓ | ✓ |
| Crear nave | ✗ | ✓ | ✓ |
| Editar nave | ✗ | ✓ | ✓ |
| Eliminar nave | ✗ | ✓ | ✓ |
| Registrar impacto | ✗ | ✓ | ✓ |
| Marcar Cylon | ✗ | ✗ | ✓ |

---

## Instalación

### Requisitos
- Docker y Docker Compose
- O bien: servidor Apache/Nginx con PHP 8+ y MySQL

### Pasos

1. Clona el repositorio:
```bash
git clone https://github.com/tu-usuario/colonial-fleet-registry.git
```

2. Configura las credenciales de la base de datos en `conf.json`:
```json
{
    "host": "localhost",
    "userName": "root",
    "password": "tu_password",
    "db": "colonial_fleet"
}
```

3. Importa el esquema de base de datos:
```bash
mysql -u root -p < query.sql
```

4. Crea un usuario administrador manualmente en la base de datos:
```sql
INSERT INTO usuarios (username, password, rol) 
VALUES ('admin', '$2y$...hash_bcrypt...', 'admin');
```
> Usa `hash.php` para generar el hash de la contraseña.

5. Apunta el servidor web a la carpeta del proyecto y abre `index.php`.

---

## Seguridad

- Contraseñas almacenadas con `password_hash()` (bcrypt)
- Todas las queries usan sentencias preparadas con `bindValue()` — protección contra SQL Injection
- Cookie de sesión con flags `httpOnly` y `SameSite: Strict`
- Rutas protegidas verificadas en el Front Controller — no solo ocultadas en la vista
- Doble protección en `marcarCylon`: comprobación de sesión activa y de rol admin

---

## Autor

Adrián — DAW 3ª Evaluación
