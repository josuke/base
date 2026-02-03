# Base Theme

Theme padre de WordPress pensado para ser ligero, rápido y extensible desde temas hijo.

## Qué incluye
- Setup mínimo en `functions.php`.
- Limpieza opcional del `<head>` por filtros.
- Assets mínimos (reset CSS y JS ligero).
- Templates base (`index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`).
- Sistema de componentes en `template-parts/{slug}` con `index.php`, `style.css`, `script.js`.

## Qué no incluye
- Diseño visual, layouts específicos ni builders.
- Plantillas avanzadas o personalizadas.
- Dependencias externas obligatorias.

## Cómo extender desde un tema hijo
1. Crear la carpeta del tema hijo en `wp-content/themes/mi-tema-hijo`.
2. Añadir un `style.css` mínimo.
3. Añadir un `functions.php` que encole tus assets.
4. Activar el tema hijo desde el panel de WordPress.

Ejemplo de `style.css` para el hijo:
```css
/*
Theme Name: Mi Tema Hijo
Template: base
Version: 0.1.0
*/
```

Ejemplo de `functions.php` para el hijo:
```php
<?php
add_action('wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get('Version');
	wp_enqueue_style('child-main', get_stylesheet_directory_uri() . '/style.css', [], $ver);
});
```

Si quieres desactivar los assets del padre:
```php
add_filter('base_enable_assets', '__return_false');
```

## Componentes (template parts con assets)
Estructura:
```
template-parts/
  hero/
    index.php
    style.css
    script.js
```

Render con helper:
```php
base_component('hero', [
	'title' => 'Hola',
	'subtitle' => 'Subtitulo',
]);
```

Acceso a parámetros dentro del componente:
```php
<?php $args = (array) get_query_var('base_component_args', []); ?>
```

Resolución de componentes:
- Si el tema hijo tiene el mismo `template-parts/{slug}`, se usa el del hijo.
- Si no existe en el hijo, se usa el del padre.

Desactivar assets de componentes si lo necesitas:
```php
add_filter('base_component_assets_enabled', '__return_false', 10, 2);
```

## Jerarquía de templates
Los templates base (`page.php`, `single.php`, `archive.php`, etc.) siguen la jerarquía estándar de WordPress:
- Si el tema hijo define un template, se usa el del hijo.
- Si no existe, se usa el del padre.

## Filtros disponibles
- `base_head_cleanup_options`  
  Controla limpieza por partes. Ejemplo:
  ```php
  add_filter('base_head_cleanup_options', function ($options) {
  	$options['emoji'] = false;
  	return $options;
  });
  ```

- `base_enable_assets`  
  Desactiva los assets del padre si el hijo los reemplaza.
  ```php
  add_filter('base_enable_assets', '__return_false');
  ```
- `base_component_assets_enabled`  
  Habilita/deshabilita encolado de CSS/JS por componente.

## Updater
El updater de GitHub se carga solo en el admin para evitar impacto en el frontend.

## Estructura del theme
- `functions.php`: carga de setup, limpieza y updater opcional.
- `inc/setup.php`: soportes de tema y encolado de assets base.
- `inc/cleanup.php`: limpieza del `<head>` por filtros.
- `inc/updater.php`: updater opcional basado en GitHub.
- `template-parts/`: partes de template reutilizables.
- `assets/`: CSS/JS mínimos.
- `page-wip.php`: plantilla WIP que muestra solo el contenido del editor (sin header/footer).
