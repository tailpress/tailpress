<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="relative pt-16 before:absolute before:top-0 before:left-0 before:h-px before:w-6 before:bg-zinc-950 after:absolute after:top-0 after:right-0 after:left-8 after:h-px after:bg-zinc-950/10">
        <div class="relative lg:-mx-4 lg:flex lg:justify-end">
            <div class="pt-10 lg:w-2/3 lg:flex-none lg:px-4 lg:pt-0">
            <h2 class="text-2xl font-semibold text-zinc-950"><a href="<?php the_permalink(); ?>" class="!no-underline"><?php the_title(); ?></a></h2>
            <dl class="lg:absolute lg:top-0 lg:left-0 lg:w-1/3 lg:px-4">
                <dt class="sr-only"><?php _e('Published', 'tailpress'); ?></dt>
                <dd class="absolute top-0 left-0 text-sm text-zinc-950 lg:static">
                    <time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished" class="text-sm text-zinc-700"><?php echo get_the_date(); ?></time>
                </dd>
                <dt class="sr-only">Author</dt>
                <dd class="mt-6 flex gap-x-4">
                    <div class="flex-none overflow-hidden rounded-xl bg-light">
                        <?php
                            echo get_avatar(get_the_author_meta( 'ID' ), 32, '', esc_attr(sprintf(__('Avatar for %s', 'tailpress'), get_the_author())), [
                                'class' => 'h-12 w-12 object-cover grayscale',
                                'style' => 'style="color: transparent;"'
                            ]);
                        ?>
                    </div>
                    <div class="text-sm text-zinc-950">
                        <div class="font-semibold"><?php the_author(); ?></div>
                    </div>
                </dd>
            </dl>
            <div class="mt-6 max-w-2xl text-base text-zinc-600">
                <?php the_excerpt(); ?>
            </div>
            <a class="!no-underline mt-8 inline-flex rounded-full bg-zinc-950 px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-zinc-800" aria-label="<?php echo esc_attr(sprintf(__('Read more: %s', 'tailpress'), get_the_title())); ?>" href="<?php the_permalink(); ?>">
                <?php _e('Read more', 'tailpress'); ?>
            </a>
        </div>
    </div>
</article>
