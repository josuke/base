# Base Theme

Theme padre de WordPress, ligero y extensible, pensado como base comun para temas hijo. El objetivo es mantener el padre minimo y estable, y que el hijo defina el diseno y los templates especificos del proyecto.

## Que es y para que sirve
Este theme ofrece la estructura y compatibilidad necesarias para arrancar proyectos rapido, sin builders ni dependencias obligatorias. Es ideal para:
- Sitios corporativos
- Blogs
- Tiendas WooCommerce (el hijo decide el layout)

## Lo que si incluye
- Setup base de WordPress y compatibilidad con el core.
- Estructura minima de templates para evitar errores.
- Sistema de componentes reutilizables.
- Accesibilidad basica.

## Lo que no incluye
- Diseno visual final.
- Layouts avanzados o builders.
- Dependencias externas obligatorias.

## Como crear un tema hijo
1. Crea una carpeta en `wp-content/themes/mi-tema-hijo`.
2. Anade `style.css` con los headers minimos.
3. Anade `functions.php` y encola tus assets.
4. Activa el tema hijo desde el admin de WordPress.

### `style.css` minimo
```css
/*
Theme Name: Mi Tema Hijo
Template: base
Version: 0.1.0
*/
```

### `functions.php` minimo
```php
<?php
add_action('wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get('Version');
	wp_enqueue_style('child-main', get_stylesheet_directory_uri() . '/style.css', [], $ver);
});
```

## Recomendaciones para el tema hijo
- Manten los estilos en el hijo y evita tocar el padre.
- Sobrescribe templates copiando el archivo desde el padre al hijo y modificandolo alli.
- Usa `template-parts/` en el hijo para componentes propios.

## Estructura sugerida del hijo
- `style.css`
- `functions.php`
- `templates/` o `template-parts/`
- `assets/` (CSS/JS/imagenes)

## Ejemplo listo para usar
En este repo tienes un ejemplo de tema hijo en `child-theme-example/`. Puedes copiar esa carpeta a `wp-content/themes/` y renombrarla, cambiando solo el `Theme Name` en `style.css`.

Incluye:
- `front-page.php` con uso de `base_component('hero', ...)`.
- `page-demo.php` con loader, header, hero y footer.
- `template-parts/hero/` con `index.php`, `style.css`, `script.js`.
- `assets/css/main.css` y `assets/js/main.js`.
- `functions.php` con encolado de assets y editor styles del hijo.
- `screenshot.png` de ejemplo.
