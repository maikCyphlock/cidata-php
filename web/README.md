# Cidata — Landing Page

Sitio web de una página para **Cidata**, proveedor de internet por fibra óptica en Acarigua-Araure, Estado Portuguesa, Venezuela. Desarrollado en PHP puro, sin frameworks, listo para subir a cPanel.

---

## Estructura del proyecto

```
/web/
├── index.php           — Landing page principal
├── send-mail.php       — Handler del formulario de contacto
├── .htaccess           — Seguridad, caché y compresión
└── assets/
    ├── css/
    │   └── style.css   — Design system Cidata + estilos completos
    ├── js/
    │   └── main.js     — FAQ accordion, nav mobile, flash messages
    └── img/
        ├── logo-primary.png
        └── logo-white.png
```

---

## Secciones de la página

| Sección | ID ancla | Descripción |
|---|---|---|
| Nav | — | Sticky, logo, links, botón CTA, hamburger mobile |
| Hero | — | Headline, subtítulo, CTAs, trust badges, tarjetas decorativas de velocidad |
| Planes | `#planes` | 3 cards: Básico, Pro (destacado), Ultra |
| Por qué Cidata | `#nosotros` | 4 features con íconos Lucide |
| Banner azul | — | CTA "Instalación en 24h" |
| Contacto | `#contacto` | Formulario que envía email con PHP `mail()` |
| Banner magenta | — | CTA "Cámbiate a Cidata" |
| FAQ | `#faq` | 5 preguntas con accordion |
| Footer | — | Logo blanco, links, redes sociales, año dinámico |

---

## Planes de internet

| Plan | Velocidad | Precio | Público |
|---|---|---|---|
| Básico | 300 Mbps | $25/mes | Navegación básica, Streaming HD |
| Pro ⭐ | 600 Mbps | $30/mes | Familias, Streaming 4K, Gaming |
| Ultra | 1 Gbps | $35/mes | Creadores, múltiples dispositivos |

---

## Configuración antes de subir a cPanel

Editar las constantes al inicio de `send-mail.php`:

```php
define('MAIL_TO',      'info@cidata.com.ve');    // Correo donde llegan los contactos
define('MAIL_FROM',    'noreply@cidata.com.ve');  // Debe coincidir con el dominio del hosting
define('MAIL_SUBJECT', 'Nuevo contacto desde cidata.com.ve');
```

---

## Tecnologías

- **PHP** puro (sin frameworks) — compatible con PHP 7.4+
- **CSS** con custom properties (variables nativas, sin preprocesador)
- **JavaScript** vanilla (sin jQuery ni dependencias)
- **Google Fonts** — Montserrat (títulos) + Nunito Sans (cuerpo)
- **Lucide Icons** — via CDN (`unpkg.com/lucide`)

---

## Brand system

Basado en el design system oficial de Cidata:

| Token | Valor |
|---|---|
| Azul primario | `#29ABE2` |
| Magenta / Pink | `#E8007D` |
| Negro | `#0D0D0D` |
| Fuente títulos | Montserrat 900 |
| Fuente cuerpo | Nunito Sans |
| Botones | Forma pill (`border-radius: 9999px`) |

---

## Despliegue en cPanel

1. Configurar `MAIL_TO` y `MAIL_FROM` en `send-mail.php`
2. Subir todo el contenido de `/web/` a `public_html/` via Administrador de archivos o FTP
3. Verificar que el servidor tenga PHP 7.4+ habilitado
4. El `.htaccess` se aplica automáticamente si Apache tiene `mod_rewrite` activo
