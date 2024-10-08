<?php
namespace Elementor\Core\Isolation;

class Wordpress_Adapter implements Wordpress_Adapter_Interface {

	public function get_plugins(): array {
		return get_plugins();
	}

	public function is_plugin_active( $plugin_path ): bool {
		return is_plugin_active( $plugin_path );
	}

	public function wp_nonce_url( $url, $action ): string {
		return wp_nonce_url( $url, $action );
	}

	public function self_admin_url( $path ): string {
		return self_admin_url( $path );
	}

	/**
	 * Retrieves an array of pages (or hierarchical post type items).
	 *
	 * @return WP_Post[]|false Array of pages (or hierarchical post type items). Boolean false if the
	 *                         specified post type is not hierarchical or the specified status is not
	 *                         supported by the post type.
	 */
	public function get_pages( $args ) : ?array {
		return get_pages( $args );
	}

	/**
	 * Creates and returns a wp query instance.
	 *
	 * @return \WP_Query
	 */
	public function get_query( $args ) : ?\WP_Query {
		return new \WP_Query( $args );
	}

	public function get_option( $option_key ) {
		return get_option( $option_key );
	}

	public function update_option( $option_key, $option_value ) : void {
		update_option( $option_key, $option_value );
	}

	public function add_option( $option_key, $option_value ) : void {
		add_option( $option_key, $option_value );
	}

	public function add_query_arg( $args, $url ) : string {
		return add_query_arg( $args, $url );
	}

	public function has_custom_logo() : bool {
		return has_custom_logo();
	}

	public function wp_register_script_module(  string $id, string $src, array $deps = array(), $version = false ) : void {
		if ( version_compare( get_bloginfo( 'version' ), '6.5', '<' ) ) {
			require_once ELEMENTOR_PATH . 'includes/wordpress/script-modules.php';
			wp_script_modules();
		}

		wp_register_script_module( $id, $src, $deps, $version );
	}

	public function wp_enqueue_script_module( string $id, string $src = '', array $deps = array(), $version = false ) : void {
		if ( version_compare( get_bloginfo( 'version' ), '6.5', '<' ) ) {
			require_once ELEMENTOR_PATH . 'includes/wordpress/script-modules.php';
			wp_script_modules();
		}

		wp_enqueue_script_module( $id, $src, $deps, $version );
	}
}
