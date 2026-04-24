# CSS Moderno — Referencia avanzada

## Soporte de browser (2025)

| Feature                  | Chrome | Firefox | Safari | Edge  |
|--------------------------|--------|---------|--------|-------|
| Custom properties        | 49+    | 31+     | 9.1+   | 16+   |
| `@layer`                 | 99+    | 97+     | 15.4+  | 99+   |
| Container queries        | 105+   | 110+    | 16+    | 105+  |
| `:has()`                 | 105+   | 121+    | 15.4+  | 105+  |
| `oklch()`                | 111+   | 113+    | 15.4+  | 111+  |
| Logical properties       | 87+    | 63+     | 14.1+  | 87+   |
| `@property`              | 85+    | 128+    | 16.4+  | 85+   |
| Subgrid                  | 117+   | 71+     | 16+    | 117+  |
| CSS nesting nativo       | 120+   | 117+    | 17.2+  | 120+  |

---

## @property — Tipos en custom properties

Sin `@property`, una custom property es solo texto. Con `@property`, tiene tipo,
herencia, y puede animarse.

```css
@property --card-opacity {
  syntax: "<number>";
  inherits: false;
  initial-value: 1;
}

@property --gradient-angle {
  syntax: "<angle>";
  inherits: false;
  initial-value: 0deg;
}

/* Ahora puedes animar --gradient-angle con transition */
.card {
  transition: --gradient-angle 0.3s ease;
  background: linear-gradient(var(--gradient-angle), #3b82f6, #8b5cf6);
}

.card:hover {
  --gradient-angle: 180deg;
}
```

Sin `@property`, `transition` sobre custom properties no funciona.

---

## CSS Nesting nativo — Diferencias con Sass

```css
/* Sass — compilado, no es CSS real */
.card {
  &__title { color: red; }
  &--featured { background: blue; }
}

/* CSS nativo — funciona en browser moderno */
.card {
  padding: 1rem;

  & .card__title {      /* requiere espacio + & al inicio */
    font-size: 1.25rem;
  }

  &.card--featured {    /* sin espacio para modificadores */
    background: var(--color-brand-50);
  }

  &:hover {
    box-shadow: var(--shadow-md);
  }

  @container (min-width: 400px) {
    grid-template-columns: auto 1fr;
  }
}
```

Ojo: el selector anidado resuelve diferente que Sass en algunos edge cases.
`& .child` ≠ `&__child` — el primero es descendiente, el segundo concatenación.

---

## Container queries — Tipos de contenedor

```css
/* inline-size — sólo mide el ancho (lo más común) */
.wrapper {
  container-type: inline-size;
}

/* size — mide ancho Y alto (cuidado: crea BFC, puede romper layouts) */
.wrapper {
  container-type: size;
}

/* Nombre opcional pero recomendado para selectores específicos */
.card-grid {
  container-type: inline-size;
  container-name: card-grid;
}

/* Sin nombre: responde al contenedor más cercano */
@container (min-width: 400px) { }

/* Con nombre: responde a ese contenedor específico */
@container card-grid (min-width: 600px) { }
```

### Container query units

```css
/* cqi = 1% del inline-size del contenedor */
.card__title {
  font-size: clamp(1rem, 4cqi, 1.5rem);
}
```

---

## oklch() — Escalar paletas de color

```css
:root {
  /* Define un hue base y escala sólo lightness */
  --hue-brand: 250;
  --chroma-brand: 0.2;

  --color-brand-50:  oklch(97% var(--chroma-brand) var(--hue-brand));
  --color-brand-100: oklch(93% var(--chroma-brand) var(--hue-brand));
  --color-brand-200: oklch(85% var(--chroma-brand) var(--hue-brand));
  --color-brand-300: oklch(75% var(--chroma-brand) var(--hue-brand));
  --color-brand-400: oklch(65% var(--chroma-brand) var(--hue-brand));
  --color-brand-500: oklch(55% var(--chroma-brand) var(--hue-brand));
  --color-brand-600: oklch(45% var(--chroma-brand) var(--hue-brand));
  --color-brand-700: oklch(35% var(--chroma-brand) var(--hue-brand));
  --color-brand-800: oklch(25% var(--chroma-brand) var(--hue-brand));
  --color-brand-900: oklch(15% var(--chroma-brand) var(--hue-brand));
}
```

Para generar un color neutro (gris) sin matiz: `oklch(50% 0 0)` — chroma 0 elimina el color.

### Color mixing

```css
/* Mezcla de colores nativa */
.button--hover-bg {
  background: color-mix(in oklch, var(--color-brand-500) 80%, white);
}
```

---

## Subgrid — Para alinear elementos a través de componentes

```css
/* Sin subgrid: cada tarjeta tiene su propio grid, no se alinean entre sí */

/* Con subgrid: las tarjetas participan del grid del padre */
.card-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: auto;
  gap: 1rem;
}

.card {
  display: grid;
  grid-row: span 3;                    /* ocupa 3 filas del padre */
  grid-template-rows: subgrid;         /* sus hijos se alinean al padre */
}

/* Ahora .card__image, .card__body, .card__footer en todas las tarjetas
   se alinean entre sí automáticamente, sin altura fija */
.card__image { }   /* fila 1 del padre */
.card__body  { }   /* fila 2 del padre */
.card__footer{ }   /* fila 3 del padre */
```

---

## :has() — Patrones avanzados

```css
/* Selector de cantidad — aplica cuando hay exactamente N hijos */
.grid:has(> :nth-child(4):last-child) {
  grid-template-columns: repeat(2, 1fr); /* 4 items = 2 columnas */
}

.grid:has(> :nth-child(3):last-child) {
  grid-template-columns: repeat(3, 1fr); /* 3 items = 3 columnas */
}

/* Formulario: deshabilita submit si hay campos inválidos */
.form:has(:invalid) .form__submit {
  opacity: 0.5;
  pointer-events: none;
}

/* Imagen opcional — layout condicional sin JS */
.card:not(:has(.card__image)) .card__body {
  padding-block-start: var(--space-6);
}
```

---

## Tokens semánticos — La capa que falta en muchos sistemas

No basta con tokens de escala (`--color-brand-500`). Necesitas tokens semánticos
que describan intención, no valor.

```css
:root {
  /* Escala (primitivos) */
  --color-blue-500: oklch(55% 0.2 250);
  --color-red-500: oklch(50% 0.25 30);

  /* Semánticos (intención) — referencian primitivos */
  --color-interactive: var(--color-blue-500);
  --color-danger: var(--color-red-500);
  --color-surface: white;
  --color-text-primary: oklch(15% 0.01 250);
  --color-text-secondary: oklch(45% 0.01 250);

  /* Componente — referencian semánticos */
  /* Esto va en cada componente, no en :root */
}
```

Cuando cambias el tema, sólo redefines los semánticos. Los componentes no cambian.

---

## Responsive typography — sin media queries

```css
:root {
  /* fluid type scale */
  --text-sm:   clamp(0.833rem, 0.75rem + 0.2vw, 0.9rem);
  --text-base: clamp(1rem,     0.9rem  + 0.25vw, 1.1rem);
  --text-lg:   clamp(1.2rem,   1rem    + 0.5vw,  1.35rem);
  --text-xl:   clamp(1.44rem,  1.1rem  + 0.85vw, 1.8rem);
  --text-2xl:  clamp(1.728rem, 1.2rem  + 1.3vw,  2.4rem);
}
```

`clamp(min, preferred, max)` — el tamaño crece con el viewport pero tiene límites.
No necesitas media queries para tipografía responsiva.

---

## Performance — Propiedades baratas vs caras

### Baratas (no disparan layout)
- `transform`
- `opacity`
- `filter`
- `will-change: transform` (con moderación)

### Caras (disparan layout = reflow)
- `width`, `height`
- `margin`, `padding`
- `top`, `left` (usar `transform: translate()` en su lugar)
- `font-size`

### Muy caras (disparan paint en todo el documento)
- `box-shadow` en muchos elementos
- `border-radius` + `overflow: hidden` + animación

```css
/* MAL — anima propiedades que disparan layout */
.modal {
  transition: top 0.3s, height 0.3s;
}

/* BIEN — anima sólo transform/opacity */
.modal {
  transform: translateY(-100%);
  transition: transform 0.3s, opacity 0.3s;
}
.modal--open {
  transform: translateY(0);
  opacity: 1;
}
```
