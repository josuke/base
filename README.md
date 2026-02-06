# Base Theme

Theme padre de WordPress, ligero y extensible para temas hijo.

## Incluye
- Setup básico de theme y menús.
- Soportes: title-tag, post-thumbnails, html5, responsive-embeds, align-wide, custom-logo, appearance-tools, wp-block-styles, customize-selective-refresh-widgets, editor-styles.
- CSS/JS base encolados con versionado por `filemtime`.
- Editor styles en `assets/css/editor-style.css`.
- Limpieza opcional del `<head>` por filtros.
- Sistema de componentes en `template-parts/{slug}` con assets opcionales.
- Templates base: `index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`.
- Accesibilidad básica: skip link + `:focus-visible`.
- Componentes: `header`, `footer`, `content`, `content-none`, `content-search`.
- Template WIP: `page-wip.php`.
- Updater GitHub (solo admin).

## No incluye
- Diseño visual específico ni layouts avanzados.
- Dependencias externas obligatorias.

## Estructura
- `functions.php`: carga de setup, cleanup, componentes, updater.
- `inc/setup.php`: soportes y encolado.
- `inc/cleanup.php`: limpieza del `<head>`.
- `inc/components.php`: helper `base_component()`.
- `inc/updater.php`: updater GitHub.
- `template-parts/`: componentes reutilizables.
- `assets/`: CSS/JS base y estilos del editor.

## Tema hijo (resumen)
1. Crea el child en `wp-content/themes/mi-tema-hijo`.
2. Añade `style.css` mínimo.
3. Añade `functions.php` para encolar CSS/JS del hijo.
4. Actívalo desde WP.

Ejemplo `style.css`:
```css
/*
Theme Name: Mi Tema Hijo
Template: base
Version: 0.1.0
*/
```

Ejemplo `functions.php`:
```php
<?php
add_action('wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get('Version');
	wp_enqueue_style('child-main', get_stylesheet_directory_uri() . '/style.css', [], $ver);
});
```

## Filtros
- `base_head_cleanup_options` (activar/desactivar partes de limpieza).
- `base_enable_assets` (desactivar assets base).
- `base_component_assets_enabled` (activar/desactivar assets por componente).

## Componentes
Render:
```php
base_component('hero', [
	'title' => 'Hola',
	'subtitle' => 'Subtítulo',
]);
```

Args dentro del componente:
```php
<?php $args = (array) get_query_var('base_component_args', []); ?>
```
