---
name: Calm Progress
colors:
  surface: '#f9f9ff'
  surface-dim: '#d3daea'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f3ff'
  surface-container: '#e7eefe'
  surface-container-high: '#e2e8f8'
  surface-container-highest: '#dce2f3'
  on-surface: '#151c27'
  on-surface-variant: '#424754'
  inverse-surface: '#2a313d'
  inverse-on-surface: '#ebf1ff'
  outline: '#727785'
  outline-variant: '#c2c6d6'
  surface-tint: '#005ac2'
  primary: '#0058be'
  on-primary: '#ffffff'
  primary-container: '#2170e4'
  on-primary-container: '#fefcff'
  inverse-primary: '#adc6ff'
  secondary: '#006c49'
  on-secondary: '#ffffff'
  secondary-container: '#6cf8bb'
  on-secondary-container: '#00714d'
  tertiary: '#825100'
  on-tertiary: '#ffffff'
  tertiary-container: '#a36700'
  on-tertiary-container: '#fffbff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d8e2ff'
  primary-fixed-dim: '#adc6ff'
  on-primary-fixed: '#001a42'
  on-primary-fixed-variant: '#004395'
  secondary-fixed: '#6ffbbe'
  secondary-fixed-dim: '#4edea3'
  on-secondary-fixed: '#002113'
  on-secondary-fixed-variant: '#005236'
  tertiary-fixed: '#ffddb8'
  tertiary-fixed-dim: '#ffb95f'
  on-tertiary-fixed: '#2a1700'
  on-tertiary-fixed-variant: '#653e00'
  background: '#f9f9ff'
  on-background: '#151c27'
  surface-variant: '#dce2f3'
typography:
  headline-lg:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-caps:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  badge:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 12px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1280px
  gutter: 1.5rem
  margin-mobile: 1rem
  stack-sm: 0.5rem
  stack-md: 1rem
  stack-lg: 2rem
---

## Brand & Style

The design system is anchored in the concept of "Guided Clarity." For young graduates, the job search is often a period of high anxiety and fragmented information. This design system counters that stress through a **Minimalist** aesthetic that prioritizes white space, soft transitions, and a clear information hierarchy.

The emotional response should be one of quiet confidence and organization. By utilizing a "Corporate Modern" foundation stripped of unnecessary visual noise, the UI becomes a supportive tool rather than another source of overwhelm. The style utilizes light-weight shadows and a restricted color palette to keep the user focused on their progress.

## Colors

The palette is designed to provide immediate semantic meaning while maintaining a soft, approachable feel. 

- **Primary Blue (#3B82F6):** Used for primary actions, navigation states, and the "Envoyée" status. It represents professionalism and momentum.
- **Success Green (#10B981):** Reserved for "Entretien" (Interview) statuses and positive outcomes, providing a visual reward for progress.
- **Warning Yellow (#F59E0B):** Used for "En attente" (Pending) and "Haute Priorité" (High Priority) to draw attention without triggering alarm.
- **Neutral Gray (#6B7280):** Utilized for "Refusée" (Rejected) statuses and archived content, allowing them to recede visually compared to active applications.
- **Background (#F9FAFB):** An off-white base that reduces screen glare and makes the white card components "pop" with subtle depth.

## Typography

**Inter** is the sole typeface for this design system to ensure maximum legibility and a systematic, utilitarian feel. 

- **Headlines:** Use tighter letter spacing and heavier weights to create a strong visual anchor for page titles and card headings.
- **Body Text:** Standardized at 16px for primary readability, with a 14px variant for secondary details within application cards (e.g., date applied, contact name).
- **Labels & Badges:** Use a medium weight (500-600) to ensure text remains crisp even at smaller sizes within status tags. 
- **Hierarchy:** Contrast is achieved through weight and color (Neutral Gray for secondary info) rather than excessive size variations.

## Layout & Spacing

This design system uses a **Fluid Grid** model with a maximum container width to prevent line lengths from becoming unreadable on ultra-wide monitors.

- **Grid:** A 12-column system for desktop, collapsing to 4 columns for tablet, and a single column for mobile.
- **Rhythm:** An 8px base unit (0.5rem) governs all spacing. Vertical rhythm is critical; use `stack-lg` (32px) between sections and `stack-md` (16px) between cards.
- **Whitespace:** Emphasize generous internal padding within cards (24px) to ensure information doesn't feel cramped, contributing to the "reassuring" brand pillar.

## Elevation & Depth

Depth is conveyed through **Ambient Shadows** rather than heavy borders or high-contrast lines. 

- **Surface 0 (Background):** The `#F9FAFB` base layer.
- **Surface 1 (Cards):** Pure white (`#FFFFFF`) with a `0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)` shadow. This "2xl" level of softness makes components feel light and floating.
- **Interactive States:** On hover, cards should subtly lift using a slightly deeper shadow and a 2px upward translation.
- **Overlays:** Modals and dropdowns use a backdrop blur (8px) and a more pronounced shadow to focus the user’s attention on the task at hand.

## Shapes

The shape language is purposefully **Rounded** to evoke a sense of friendliness and safety. 

- **Primary Components:** Application cards and main containers use a `1rem` (16px) radius, aligned with the "2xl" requirement.
- **Small Components:** Buttons and input fields use a `0.5rem` (8px) radius to maintain consistency without feeling overly "bubbly."
- **Badges:** Use a fully rounded pill-shape (999px) to distinguish them clearly from interactive buttons.

## Components

### Status Badges
Status indicators use a "Soft Fill" style: a high-transparency background tint of the semantic color with high-contrast text.
- **Envoyée:** Blue tint background, Blue-700 text.
- **En attente:** Yellow tint background, Yellow-800 text.
- **Entretien:** Green tint background, Green-700 text.
- **Refusée:** Gray tint background, Gray-600 text.

### Cards
Cards are the primary container. They must feature a white background, 24px padding, and the defined "2xl" shadow. Content should be structured with the company logo (left), application title (center-left), and status badge (top-right).

### Input Fields
Inputs are minimalist: a 1px border (`#E5E7EB`), white background, and 12px horizontal padding. On focus, the border transitions to Primary Blue with a 3px soft blue outer glow (ring).

### Buttons
- **Primary:** Solid `#3B82F6` with white text.
- **Secondary:** Transparent background with `#3B82F6` border and text.
- **Priority:** Small indicators using a 8px colored dot (Success Green for "Basse", Warning Yellow for "Moyenne", Red for "Haute") next to text.

### Icons
Use **Heroicons** (Outline style). Keep stroke weight at 1.5px to match the refinement of the Inter typeface. Icons should be used sparingly to aid navigation without cluttering the interface.