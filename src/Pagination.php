<?php

namespace TailPress;

use WP_Query;

class Pagination
{
    public const SVG_PREV = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
        <path fill-rule="evenodd" d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
    </svg>';

    public const SVG_NEXT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
        <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>';

    public static function render(?WP_Query $query = null): void
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;
        $original_query = null;

        if ($query) {
            $original_query = $wp_query;
            $wp_query = $query;
        }

        if ($wp_query->max_num_pages <= 1) {
            return;
        }

        $paged = max(1, absint($wp_query->get('paged', 1)));
        $max = (int) $wp_query->max_num_pages;
        $links = self::generate_pagination_links($paged, $max);

        echo '<nav aria-label="Page navigation"><ul class="mt-12 border-t border-light py-6 flex items-center justify-center gap-2">';

        self::render_previous_link($paged, $links);
        self::render_page_links($paged, $links);
        self::render_next_link($paged, $max, $links);

        echo '</ul></nav>';

        if ($original_query) {
            $wp_query = $original_query;
        }
    }

    private static function generate_pagination_links(int $paged, int $max): array
    {
        $links = [$paged];

        if ($paged >= 3) {
            $links[] = $paged - 2;
            $links[] = $paged - 1;
        }

        if ($paged + 2 <= $max) {
            $links[] = $paged + 1;
            $links[] = $paged + 2;
        }

        sort($links);
        return array_unique($links);
    }

    private static function render_previous_link(int $paged, array $links): void
    {
        if (in_array(1, $links)) {
            return;
        }

        if (get_previous_posts_link()) {
            printf(
                '<li><span class="page-link">%s</span></li>',
                get_previous_posts_link(
                    sprintf('<span aria-hidden="true">%s</span><span class="sr-only">Previous page</span>', self::SVG_PREV)
                )
            );
        }

        if (!in_array(2, $links)) {
            echo '<li class="page-item"></li>';
        }
    }

    private static function render_page_links(int $paged, array $links): void
    {
        foreach ($links as $link) {
            $class = $paged === $link ? 'text-dark' : 'text-dark/60';
            printf(
                '<li><a href="%s" class="%s px-4 mx-4">%s</a></li>',
                esc_url(get_pagenum_link($link)),
                esc_attr($class),
                esc_html($link)
            );
        }
    }

    private static function render_next_link(int $paged, int $max, array $links): void
    {
        if (get_next_posts_link()) {
            printf(
                '<li><span class="page-link">%s</span></li>',
                get_next_posts_link(
                    sprintf('<span aria-hidden="true">%s</span><span class="sr-only">Next page</span>', self::SVG_NEXT)
                )
            );
        }

        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                echo '<li class="page-item"></li>';
            }
        }
    }
}
