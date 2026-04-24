---
name: Cyber-Fiber Kinetic
colors:
  surface: '#121221'
  surface-dim: '#121221'
  surface-bright: '#383848'
  surface-container-lowest: '#0d0d1c'
  surface-container-low: '#1a1a2a'
  surface-container: '#1e1e2e'
  surface-container-high: '#292839'
  surface-container-highest: '#343344'
  on-surface: '#e3e0f6'
  on-surface-variant: '#e5bcc4'
  inverse-surface: '#e3e0f6'
  inverse-on-surface: '#2f2f3f'
  outline: '#ac878f'
  outline-variant: '#5c3f45'
  surface-tint: '#ffb1c3'
  primary: '#ffb1c3'
  on-primary: '#66002c'
  primary-container: '#ff4b89'
  on-primary-container: '#590026'
  inverse-primary: '#bb0058'
  secondary: '#a6e6ff'
  on-secondary: '#003543'
  secondary-container: '#14d1ff'
  on-secondary-container: '#00566b'
  tertiary: '#c3c2f2'
  on-tertiary: '#2c2c53'
  tertiary-container: '#8d8dba'
  on-tertiary-container: '#25264c'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffd9e0'
  primary-fixed-dim: '#ffb1c3'
  on-primary-fixed: '#3f0019'
  on-primary-fixed-variant: '#8f0041'
  secondary-fixed: '#b7eaff'
  secondary-fixed-dim: '#4cd6ff'
  on-secondary-fixed: '#001f28'
  on-secondary-fixed-variant: '#004e60'
  tertiary-fixed: '#e2dfff'
  tertiary-fixed-dim: '#c3c2f2'
  on-tertiary-fixed: '#17173d'
  on-tertiary-fixed-variant: '#43436b'
  background: '#121221'
  on-background: '#e3e0f6'
  surface-variant: '#343344'
typography:
  headline-xl:
    fontFamily: Montserrat
    fontSize: 72px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.04em
  headline-lg:
    fontFamily: Montserrat
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Nunito Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Nunito Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-bold:
    fontFamily: Montserrat
    fontSize: 14px
    fontWeight: '600'
    lineHeight: '1.0'
    letterSpacing: 0.1em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 8px
  container-max: 1280px
  gutter: 24px
  margin-mobile: 16px
  section-padding: 120px
---

## Brand & Style

The brand personality for this design system is high-velocity, futuristic, and essential. It targets a tech-literate audience that demands reliability and speed. The visual language utilizes a mix of **Glassmorphism** and **High-Contrast/Bold** styles to simulate the physical properties of light passing through glass fiber.

The aesthetic leverages depth through layered transparency and luminous accents. Kinetic energy is represented by sharp geometric patterns and vibrant glows, creating an immersive "digital grid" atmosphere. The emotional response should be one of "infinite capacity" and "next-generation connectivity."

## Colors

The palette is rooted in deep space tones, moving from a dense navy-black to a rich dark purple. 

- **Primary (Neon Pink):** Used for critical calls to action and primary interactive states. It represents the "pulse" of the network.
- **Secondary (Electric Blue):** Used for data visualization, technical highlights, and secondary actions. It represents the "cool" precision of fiber technology.
- **Backgrounds:** A tiered system of `#0F0F1E` (Main Deep Navy) and `#1A1A40` (Surface Dark Purple) to create natural depth without relying solely on pure black.
- **Accents:** Use gradients blending the primary and secondary colors specifically for progress bars, connectivity lines, and high-impact hero headings.

## Typography

This design system uses a dual-font strategy to balance technical edge with readability.

- **Headlines & Labels:** **Montserrat** provides a technical, geometric flair. Tight letter spacing on large headlines emphasizes the "compressed speed" of fiber data. Use uppercase for labels and small buttons to enhance the professional, high-tech feel.
- **Body & Content:** **Nunito Sans** is used for its superior legibility at smaller scales and its clean, modern terminals. It keeps long-form information blocks, like mission and value statements, grounded and approachable.

## Layout & Spacing

The design system utilizes a **fixed-width grid** for core content stability, centered within a fluid background that allows for edge-to-edge geometric patterns. 

A 12-column grid is standard, with generous section padding (`120px`) to provide "breathing room" between high-density data cards. Vertical rhythm is strictly enforced in multiples of `8px`. Use wide margins for information blocks to emphasize focus and prestige.

## Elevation & Depth

Depth is achieved through **Glassmorphism** and **Tonal Layering**. 

1.  **Base Layer:** The Deep Navy `#0F0F1E` serves as the canvas.
2.  **Geometric Layer:** Large-scale hexagonal patterns are rendered in a subtle, low-opacity Purple-Navy with `linear-gradients` that simulate light hitting a surface.
3.  **Glass Layer (Pricing Cards):** Surfaces use a background blur (minimum `20px`) and a semi-transparent fill (`rgba(26, 26, 64, 0.6)`). Borders are 1px solid with a gradient of Pink-to-Transparent to create a "glowing edge" effect.
4.  **Floating Elements:** Interactive elements use a subtle Electric Blue outer glow (`drop-shadow`) instead of traditional black shadows to maintain the high-tech, self-illuminated aesthetic.

## Shapes

The shape language is "Soft-Tech." While the background patterns are sharp and hexagonal, UI components use a `0.25rem` (4px) base radius. This prevents the interface from feeling too aggressive while maintaining a precision-engineered look. 

Buttons and input fields should strictly adhere to this soft rounding. Hexagonal shapes should be reserved for decorative backgrounds or icon containers, never for primary interactive buttons.

## Components

- **Hero Sections:** Feature a background grid of hexagons with varying opacities. Use a large headline with a Primary-to-Secondary gradient.
- **Pricing Cards:** Implement tiered heights for the "Most Popular" plan. Use glassmorphism with a more prominent Electric Blue border for the featured tier. Pricing should be in Montserrat Bold.
- **Buttons:** 
    - *Primary:* Solid Neon Pink with white text.
    - *Secondary:* Ghost style with Electric Blue border and text.
    - *Hover:* Add a slight neon glow effect and a 2px vertical lift.
- **Information Blocks:** Mission and Values sections use a "Split-Panel" layout. High-quality imagery on one side (with a dark purple overlay) and clean typography on the other, separated by a thin vertical line in Electric Blue.
- **Chips/Status:** Use small pill-shaped chips with low-opacity backgrounds of pink or blue to indicate plan features or network status.
- **Inputs:** Dark purple background, 1px navy border, turning Electric Blue on focus.