---
name: css-modern-bem
description: >
  Use this skill whenever CSS is being written, reviewed, or architected — whether the user asks
  to "write CSS", "style a component", "refactor CSS", "review styles", "set up a CSS architecture",
  "use BEM", "modernize CSS", or anything involving stylesheets. Also trigger when the user uploads
  or pastes CSS and asks for improvements, when building UI components, or when the project involves
  design tokens, theming, or responsive layout. This skill covers modern CSS (custom properties,
  cascade layers, container queries, logical properties, :has()) combined with BEM methodology for
  scalable architecture. Do not skip this skill for "small" CSS tasks — even a single component
  benefits from these patterns.
---

# CSS Moderno + Arquitectura BEM

## Cuándo leer los archivos de referencia

- Escribe o revisa CSS de un componente → leer `references/bem.md`
- Configura tokens, theming, o design system → leer `references/modern-css.md`
- Proyecto grande (múltiples componentes, capas) → leer **ambos**
- Duda puntual sobre una propiedad moderna → responder desde este archivo

---

## Principios no negociables

1. **BEM es nomenclatura, no religión.** Úsalo para claridad, no para demostrar que lo conoces.
2. **Las Custom Properties no son variables de Sass.** Tienen cascade, herencia, y son dinámicas en runtime.
3. **`@layer` cambia todo.** Sin cascade layers, el orden de tus archivos es frágil. Con ellas, explícito.
4. **Container queries > media queries para componentes.** Un componente no debería saber el tamaño del viewport.
5. **Logical properties por defecto.** `margin-inline` en vez de `margin-left/right`. Siempre.

---

## BEM — Reglas rápidas

```
.block {}                   /* Componente independiente */
.block__element {}          /* Parte del bloque */
.block--modifier {}         /* Variación del bloque */
.block__element--modifier {}/* Variación de un elemento */
```

**Lo que BEM NO es:**
- No es para anidar más de 1 nivel de `__element`
- No reemplaza cascade layers para gestionar especificidad
- No aplica a utilidades globales (`.sr-only`, `.visually-hidden`)

**Error común:**
```css
/* MAL — elementos anidados en BEM */
.card__header__title {}

/* BIEN */
.card__title {}
```

---

## Custom Properties — Patrones correctos

### Tokens en `:root`, valores en componentes

```css
/* Tokens globales — design decisions */
:root {
  --color-brand-500: oklch(55% 0.2 250);
  --space-unit: 0.25rem;
  --radius-base: 0.375rem;
  --font-body: "Inter", system-ui, sans-serif;
}

/* Propiedades de componente — con fallback explícito */
.card {
  --card-padding: var(--space-4, 1rem);
  --card-radius: var(--radius-base, 0.375rem);
  --card-bg: var(--color-surface, #fff);

  padding: var(--card-padding);
  border-radius: var(--card-radius);
  background: var(--card-bg);
}

/* Modificador que sólo cambia custom properties */
.card--compact {
  --card-padding: var(--space-2, 0.5rem);
}
```

### Theming sin duplicar reglas

```css
/* Tema oscuro — sólo redefines tokens */
[data-theme="dark"] {
  --color-surface: oklch(15% 0.01 250);
  --color-text: oklch(95% 0.01 250);
}
```

---

## Cascade Layers — Estructura obligatoria en proyectos reales

```css
/* Declara el orden primero, siempre en un solo lugar */
@layer reset, tokens, base, components, utilities, overrides;

@layer reset {
  *, *::before, *::after { box-sizing: border-box; }
  /* etc */
}

@layer tokens {
  :root { /* custom properties globales */ }
}

@layer components {
  .card { /* estilos del componente */ }
  .card__title { /* etc */ }
}

@layer utilities {
  .sr-only { /* utilidades que deben ganar a componentes */ }
}
```

**Por qué importa:** Sin `@layer`, un `.card` en un archivo cargado después silencia
cualquier customización tuya. Con layers, la especificidad se gestiona por capa, no por orden de archivo.

---

## Container Queries — Reemplaza media queries en componentes

```css
/* El contenedor declara su contexto */
.card-grid {
  container-type: inline-size;
  container-name: card-grid;
}

/* El componente responde a SU contenedor, no al viewport */
.card {
  display: grid;
  grid-template-columns: 1fr;
}

@container card-grid (min-width: 400px) {
  .card {
    grid-template-columns: auto 1fr;
  }
}
```

---

## :has() — El selector padre que cambiaba imposibles

```css
/* Formulario con error */
.form__group:has(.form__input:invalid) .form__label {
  color: var(--color-error);
}

/* Tarjeta con imagen — layout diferente */
.card:has(.card__image) {
  grid-template-rows: auto 1fr;
}
```

---

## Logical Properties — Tabla de migración

| Físico (evitar)       | Lógico (usar)            |
|-----------------------|--------------------------|
| `margin-left`         | `margin-inline-start`    |
| `margin-right`        | `margin-inline-end`      |
| `margin-top/bottom`   | `margin-block`           |
| `padding-left/right`  | `padding-inline`         |
| `width`               | `inline-size`            |
| `height`              | `block-size`             |
| `top/bottom`          | `inset-block`            |
| `left/right`          | `inset-inline`           |

---

## Estructura de archivos recomendada

```
styles/
├── layers.css          ← Sólo la declaración @layer
├── tokens/
│   ├── colors.css
│   ├── spacing.css
│   └── typography.css
├── base/
│   ├── reset.css
│   └── typography.css
├── components/
│   ├── card.css        ← Un archivo por componente BEM
│   ├── button.css
│   └── form.css
└── utilities/
    └── layout.css
```

Cada archivo de componente sigue esta estructura interna:

```css
/* 1. Custom properties del componente */
/* 2. Bloque base */
/* 3. Elementos (__) */
/* 4. Modificadores (--) */
/* 5. States (:hover, :focus, :disabled) */
/* 6. Container queries si aplica */
```

---

## oklch() — Por qué usarlo en lugar de hex/hsl

```css
/* hex — opaco, no perceptualmente uniforme */
--color-brand: #3b82f6;

/* oklch — perceptualmente uniforme, fácil de escalar */
--color-brand-500: oklch(55% 0.2 250);
--color-brand-400: oklch(65% 0.2 250); /* más claro: sólo cambia L */
--color-brand-600: oklch(45% 0.2 250); /* más oscuro */
```

`oklch(lightness% chroma hue)` — cuando cambias L, el resultado se percibe
uniformemente más claro/oscuro. Con HSL eso no es garantía.

---

## Anti-patrones — lo que no debes hacer

```css
/* 1. Especificidad inflada */
div.card.card--primary .card__title { } /* MAL */
.card--primary .card__title { }         /* BIEN */

/* 2. !important fuera de utilities */
.card { padding: 1rem !important; }     /* MAL — síntoma de arquitectura rota */

/* 3. Custom properties sin fallback en APIs públicas */
padding: var(--card-padding);           /* MAL si este CSS lo usa otro */
padding: var(--card-padding, 1rem);     /* BIEN */

/* 4. Media queries dentro de componentes */
@media (min-width: 768px) {
  .card { } /* MAL — usa container queries */
}

/* 5. Valores mágicos */
margin-top: 23px;                       /* MAL */
margin-top: var(--space-6);             /* BIEN */
```

---

## Referencias

- `references/bem.md` — Guía detallada de BEM con casos edge
- `references/modern-css.md` — Propiedades modernas, soporte de browsers, ejemplos avanzados
