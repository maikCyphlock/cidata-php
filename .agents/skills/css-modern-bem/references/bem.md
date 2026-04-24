# BEM — Referencia completa

## La regla de oro

Un bloque BEM es cualquier cosa que puedas levantar y poner en otro contexto
**sin cambiar su CSS**. Si el componente depende de dónde está en el DOM para
verse bien, no es un bloque real.

---

## Cuándo crear un bloque nuevo vs un elemento

**Pregunta:** ¿Puede esto existir sin su padre conceptual?

```
card          → bloque (existe solo)
card__title   → elemento (no tiene sentido sin .card)
avatar        → bloque (aunque aparezca dentro de .card, existe solo)
```

Error frecuente: hacer elemento a algo que en realidad es un bloque reutilizable.

```css
/* MAL — avatar depende semánticamente de card */
.card__avatar {}

/* BIEN — avatar es un bloque independiente */
.avatar {}
.avatar--sm {}
/* dentro del HTML de card simplemente usas .avatar */
```

---

## Modificadores — dos tipos

### Booleano (existe o no existe)
```css
.button--disabled {}
.card--featured {}
.menu--open {}
```

### Clave-valor (cuando hay varias opciones)
```css
.button--size-sm {}
.button--size-md {}
.button--size-lg {}

.button--variant-primary {}
.button--variant-ghost {}
.button--variant-danger {}
```

No mezcles estilos base con lógica del modificador:
```css
/* MAL */
.button--primary {
  display: inline-flex;  /* esto va en .button, no aquí */
  padding: 0.5rem 1rem;  /* esto también */
  background: blue;
}

/* BIEN */
.button {
  display: inline-flex;
  padding: 0.5rem 1rem;
}
.button--primary {
  background: var(--color-brand-500);
  color: white;
}
```

---

## Estados: BEM vs pseudo-clases

Los estados de UI que vienen del DOM (hover, focus, disabled) van con pseudo-clases.
Los estados de aplicación (abierto, seleccionado, cargando) van con modificadores BEM
**o** con atributos `data-*` o `aria-*`.

```css
/* Estado de browser → pseudo-clase */
.button:hover {}
.button:focus-visible {}
.input:disabled {}

/* Estado de app → modificador o aria */
.menu--open {}
/* o mejor aún: */
.menu[aria-expanded="true"] {}
.accordion__panel[aria-hidden="false"] {}
```

Preferir `aria-*` cuando el atributo ya existe semánticamente — matas dos pájaros
(accesibilidad + CSS hook).

---

## BEM con JavaScript

El error clásico: usar clases BEM como hooks de JS.

```javascript
// MAL — JS acoplado a clases de estilo
document.querySelector('.card--active').addEventListener(...)

// BIEN — clases js-* sólo para JS, nunca tienen CSS
document.querySelector('.js-card-toggle').addEventListener(...)
```

Alternativa moderna: `data-*` attributes como hooks de JS.

```javascript
document.querySelector('[data-card-toggle]').addEventListener(...)
```

---

## Profundidad máxima y cómo manejar componentes anidados

BEM no tiene jerarquía de más de un nivel de `__`. Cuando tienes
componentes dentro de componentes, cada uno es su propio bloque.

```html
<!-- MAL -->
<div class="card">
  <div class="card__body">
    <div class="card__body__section">  ← esto no existe en BEM
      <h2 class="card__body__section__title"></h2>
    </div>
  </div>
</div>

<!-- BIEN -->
<div class="card">
  <div class="card__body">
    <section class="card-section">
      <h2 class="card-section__title"></h2>
    </section>
  </div>
</div>
```

---

## Mix — cuando un elemento es también un bloque

Un nodo HTML puede tener clases de dos bloques diferentes. Esto es un "mix".

```html
<article class="card media-object">
  <!--
    .card      → bloque que define la tarjeta
    .media-object → bloque que define el layout imagen+texto
    Cada uno controla sus propias propiedades. Sin conflicto.
  -->
</article>
```

Útil para separar layout de apariencia.

---

## BEM en el mundo real — No todo es componente

Hay tres categorías que no siguen BEM estrictamente:

1. **Reset / base** — estilos sobre selectores de elemento (`p`, `h1`, `a`)
2. **Tokens** — custom properties en `:root`
3. **Utilities** — clases de una sola responsabilidad (`.sr-only`, `.truncate`, `.visually-hidden`)

Las utilities van en su propia `@layer` y su especificidad es intencional.

```css
@layer utilities {
  .sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
  }
}
```

---

## Checklist antes de publicar CSS de un componente

- [ ] ¿El bloque puede vivir en otro contexto sin cambios?
- [ ] ¿Los elementos no tienen más de un nivel de `__`?
- [ ] ¿Los modificadores sólo cambian propiedades visuales, no estructura?
- [ ] ¿Los estados de browser usan pseudo-clases, no modificadores?
- [ ] ¿Los hooks de JS son `js-*` o `data-*`, nunca clases de estilo?
- [ ] ¿Las custom properties del componente tienen fallback?
- [ ] ¿Hay valores mágicos sin token?
