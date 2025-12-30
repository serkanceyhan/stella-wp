<?php
namespace ThemeAtelier\ChatHelp\Admin\TADiscountPage;
if ( ! class_exists( 'TADiscountPage' ) ) {
class TADiscountPage
{
	public function __construct()
	{
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
		add_action('admin_notices', array($this, 'discount_admin_notice'));
		add_action('admin_init', array($this, 'discount_admin_notice_dismissed'));
	}

	public function admin_scripts()
	{
		wp_enqueue_style('themeatelier_discount_page_style', plugins_url('assets/css/discount-page.css', __FILE__), '', '1.0');

	}

	public function discount_admin_notice()
	{
		// Get the current user ID and screen information
		$user_id = get_current_user_id();
		$screen  = get_current_screen();

		// Generate URLs for dismiss action and discount page
		$dismiss_url = wp_nonce_url(
			add_query_arg('themeatelier_discount_dismissed', 'true'),
			'themeatelier_discount_dismissed_nonce',
			'nonce'
		);

		// Only show the notice if the user meta 'themeatelier_discount_dismissed' does not exist
		if (!get_user_meta($user_id, 'themeatelier_discount_dismissed', true)) {
		?>
			<div class="themeatelier_discount_page_header notice updated is-dismissible">
				<img src="<?php echo esc_url(plugins_url('assets/icons/black-friday.svg', __FILE__)); ?>">
				<div>
					<h3>Black Friday Mega Sale is Live!</h3>
					<p style="font-size:16px">Unlock up to 65% OFF annual plans and 80% OFF lifetime licenses on all ThemeAtelier premium plugins. Supercharge your WordPress projects with powerful features — at the <b>best price of the year</b> 🎉</p>

					<p><b>⏳ Limited time only — Sale ends soon. Don’t miss out!</b></p>
					<a target="_blank" class="button" href="https://themeatelier.net/deals/"><strong>Claim Your Discount</strong></a>
					<a href="<?php echo esc_url($dismiss_url); ?>" class="notice-dismiss"></a>
				</div>
			</div>
<?php
		}
	}


	public function discount_admin_notice_dismissed()
	{
		$user_id = get_current_user_id();

		// Check if the URL parameter is present and the nonce is valid
		if (! empty($_GET['themeatelier_discount_dismissed'])) {
			check_admin_referer('themeatelier_discount_dismissed_nonce', 'nonce');
			// Add user meta to prevent the notice from displaying again
			add_user_meta($user_id, 'themeatelier_discount_dismissed', 'true', true);
		}
	}
}
}