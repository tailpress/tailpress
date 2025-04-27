# Changelog

All notable changes to TailPress will be documented in this file.

## Unreleased

## 5.0.0

- Major update to default styling and template files
- Vite as default compiler ([docs](https://tailpress.io/docs/5.0/vite))
- Use composer autoloading
- Use `tailpress/framework` package for theme setup
- Improvement default comments styling
- Adding `Pagination` class
- Search bar in header
- Create a ZIP-version of your theme ([docs](https://tailpress.io/docs/5.0/release#using-tailpress-cli))

## 4.0.1

- Update npm dependencies by @jeffreyvr in #269

## 4.0.0

- Adding Tailwind CSS v4 support by @jeffreyvr in #254
- Add support for responsive embeds by @brendannee in #217

## 3.4.0

- Use `mix.options({ manifest: false })` instead of deprecated `Mix.manifest.refresh = _ => void 0`

## 3.3.0

- Update to Tailwind 3.3.0
- Laravel Mix is now the default compiler (with the TailPress installer (^v2.0.0), use `compiler="esbuild"` if you want to keep using esbuild)

## 3.2.0

- Update to Tailwind 3.2.0

## 3.1.0
- Tailwind font sizes are now set as defined in `theme.json`.
- Breakpoints now based on WordPress defaults (https://developer.wordpress.org/block-editor/reference-guides/packages/packages-viewport/#usage).
- Providing `w-content`, `max-w-content`, `w-wide` and `max-w-wide` utility classes.
- Content width is now actually the width as defined in `theme.json`.
- Fixing align wide, width as defined in `theme.json`.
- Updating Tailwind CSS to version 3.1.0.
- Fix issues package.json scripts on Windows.

## 3.0.0 - 2021-12-14

- Updating Tailwind to 3.0.0.

### TailPress installer

- The TailPress installer (^0.2.0) now allows you to use Laravel Mix instead of esbuild by setting --compiler=mix.
- You may now also set dbname, dbuser, dbpass and dbhost.

## 2.0.0 - 2021-09-03

- Switching to Tailwind CLI and esbuild instead of LaraveL Mix.
- Removing `theme` subdirectory setup as it is no longer needed with the new build setup.
- Removing `TailPress` class and it's functions (`tailpress()->get_header()` etc.) throughout the theme.
- New `tailpress_asset` function to get the URL of an asset (previously `tailpress_mix`).
- `tailpress_asset` function thaty appends a `time` parameter if [wp_get_environment_type()](https://developer.wordpress.org/reference/functions/wp_get_environment_type/) does not return `production` for cache busting (instead of the previously used versioned assets through `mix-manifest.json`).
- Update screenshot.png.
- Remove `block-editor.css`, only use `editor-style.css`.
- Moving `editor-style.css` from root to `css` directory.
- Update readme.

## 1.0.0 - 2021-08-25

- Replace `tailpress.json` with `theme.json` as used by WordPress core.
- Move template files into `theme` subdirectory.
- Move tailwind plugin to a [separate repository](https://github.com/jeffreyvr/tailwindcss-tailpress).
- Update readme and adding section on using installer.

## 0.1.0 - 2021-06-17

- No longer depending on jQuery.
- Fixes text color classes for the Block Editor.
- Use safelist.txt to prevent WP classes from being purged.
- Readme changes.
- MIT License.

## 0.0.9 - 2021-04-05

- Updating to Tailwind CSS v2.1 which includes the JIT engine in core among other things.

## 0.0.8 - 2021-03-23

- Using TailwindCSS JIT for way faster compiling.
- Updated readme.
- Fix loading styling in block editor.
- Check if mix-manifest.json file exists to prevent warning message.

## 0.0.7 - 2021-02-15

- Adding the option to apply submenu_class to the wp_nav_menu args.
- Adding the option to apply classes on li_class and submenu_class on specific depths, like: li_class_0.

### 0.0.6 - 2021-02-08

- Fixes issue on Windows.

## 0.0.5 - 2020-12-24

- Set selectors on single line since this seems to cause issues (nested CSS) with production build (#241a612).

## 0.0.4 - 2020-12-23

- Add nested CSS support for PostCSS.
- Minor readme changes.

## 0.0.3 - 2020-12-22

- Update Laravel Mix from version 5^ to 6^.
- Removing Laravel Mix Tailwind, defining plugins within webpack.mix.js instead.
- Switching from Sass to PostCSS for faster compiling.
- Moved TailPress colors and font size settings to tailpress.json file.
- Use tailpress.json to populate editor-color-palette and editor-font-sizes theme support automatically.
- New screenshot.
- Update readme.
- Other minor fixes and improvements.

## 0.0.2 - 2020-11-24

- Adding basic support for the block editor Gutenberg by generating alignment, font size and color classes.
Contains four theme colors out of the box, being primary, secondary, dark and light. This is adjustable of course.
- Loading a editor-style.css.
- Removing double slashes on resulting manifest asset URLs.
- Modified template files to have a better starting point (including horizontal main navigation, footer always at the bottom for short pages).
- Added a basic 404 page template.

## 0.0.1 - 2020-11-19

- Init release.
