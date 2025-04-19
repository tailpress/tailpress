<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col">

	<?php do_action( 'tailpress_header' ); ?>

	<header>

		<div class="mx-auto container">
			<div class="lg:flex lg:justify-between lg:items-center border-b py-6">
				<div class="flex justify-between items-center">
					<div>
						<?php if ( has_custom_logo() ) { ?>
                            <?php the_custom_logo(); ?>
						<?php } else { ?>
							<a href="<?php echo get_bloginfo( 'url' ); ?>" class="font-extrabold text-lg uppercase">
								<?php echo get_bloginfo( 'name' ); ?>
							</a>

							<p class="text-sm font-light text-gray-600">
								<?php echo get_bloginfo( 'description' ); ?>
							</p>

						<?php } ?>
					</div>

					<div class="lg:hidden">
						<a href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
							<svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1"
								 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd">
									<g id="icon-shape">
										<path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z"
											  id="Combined-Shape"></path>
									</g>
								</g>
							</svg>
						</a>
					</div>
				</div>

				<?php
				wp_nav_menu(
					array(
						'container_id'    => 'primary-menu',
						'container_class' => 'hidden bg-gray-100 mt-4 p-4 lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
						'menu_class'      => 'lg:flex lg:-mx-4',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mx-4',
						'fallback_cb'     => false,
					)
				);
				?>
			</div>
		</div>
	</header>

	<div id="content" class="site-content grow">

		<?php if ( is_front_page() ) { ?>
			<!-- Start introduction -->
			<div class="container mx-auto">
				<div class="px-12 py-16 my-12 rounded-xl bg-linear-to-r from-blue-50 from-10% via-sky-100 via-30% to-blue-200 to-90%">
                    <div class="mx-auto max-w-(--breakpoint-md)">
                        <h1 class="font-display text-3xl lg:text-6xl tracking-tight font-extrabold text-red-400 mb-6">Start building your next <a href="https://tailwindcss.com" class="text-secondary">Tailwind CSS</a> flavoured WordPress theme
                            with <a href="https://tailpress.io" class="text-primary">TailPress</a>.</h1>
                        <p class="text-gray-600 text-xl font-medium mb-10">TailPress is your go-to starting
                            point for developing WordPress themes with Tailwind CSS and comes with basic block-editor support out
                            of the box.</p>
                        <a href="https://github.com/jeffreyvr/tailpress"
                            class="w-full sm:w-auto flex-none bg-gray-900 text-white text-lg leading-6 font-semibold py-3 px-6 border border-transparent rounded-xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-hidden transition-colors duration-200">View
                            on GitHub</a>
                    </div>
                </div>
			</div>
			<!-- End introduction -->
		<?php } ?>

		<?php do_action( 'tailpress_content_start' ); ?>

		<main>
