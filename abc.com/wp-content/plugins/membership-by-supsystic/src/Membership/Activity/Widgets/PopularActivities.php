<?php

class Membership_Activity_Widgets_PopularActivities extends Wp_Widget {

	private $module;
	/**
	 * Register widget with WordPress.
	 */
	function __construct(Membership_Activity_Module $module) {

		$this->module = $module;

		parent::__construct(
			'Membership_Activity_Widgets_PopularActivities',
			$module->translate('Membership by Supsystic Popular Activities'),
			array(
				'description' => $module->translate('Shows the list of activities, depending on likes.')
			)
		);

		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
	}

	public function enqueueScripts() {

		if (is_active_widget(false, false, $this->id_base, true) ) {
			$this->module->getModule('base')->enqueueAssets();
			$this->module->getModule('activity')->enqueueActivitiesAssets();
		}
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {

		echo $args['before_widget'];

		if (! empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance) . $args['after_title'];
		}

		$since = empty($instance['since']) ? '0' : $instance['since'];
		$limit = empty($instance['limit']) ? '5' : $instance['limit'];
		$show_shortened_post = empty($instance['show_shortened_post']) ? null : $instance['show_shortened_post'];
		$activityModel = $this->module->getModel('Activity');

		$activities = $activityModel->getPopularActivities(array(
			'limit' => $limit,
			'since' => $since,
			'show_shortened_post' => $show_shortened_post,
			'show_shortened_post_len' => 300,
		));

		echo $this->module->render('@activity/widgets/popular.twig', array(
			'activities' => $activities,
		));

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {

		$title = empty($instance['title']) ? '' : $instance['title'];
		$since = empty($instance['since']) ? '0' : $instance['since'];
		$limit = empty($instance['limit']) ? '5' : $instance['limit'];
		$show_shortened_post = empty($instance['show_shortened_post']) ? null : $instance['show_shortened_post'];

		$sinceText = array(
			$this->module->translate('Today'),
			$this->module->translate('This week'),
			$this->module->translate('This month'),
			$this->module->translate('This year'),
		);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php echo $this->module->translate('Title:'); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				type="text"
				value="<?php echo esc_attr($title); ?>"
			>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>">
				<?php echo $this->module->translate('Number of activities to show:'); ?>
			</label>
			<input
				class="widefat"
				min="1"
				id="<?php echo $this->get_field_id('limit'); ?>"
				name="<?php echo $this->get_field_name('limit'); ?>"
				type="number"
				value="<?php echo esc_attr($limit); ?>"
			>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('since'); ?>">
				<?php echo $this->module->translate('Since:'); ?>
			</label>
			<select
				class="widefat"
				id="<?php echo $this->get_field_id('since'); ?>"
				name="<?php echo $this->get_field_name('since'); ?>"
			>
				<?php foreach ($sinceText as $value => $time): ?>
				<option
						value="<?php echo $value; ?>"
						<?php if ($since == $value): ?>selected="true"<?php endif; ?>
				><?php echo $time; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id('show_shortened_post');?>"
					name="<?php echo $this->get_field_name('show_shortened_post');?>"
					<?php echo (($show_shortened_post == 1) ? 'checked="checked"' : ''); ?>
			/>
			<label for="<?php echo $this->get_field_id('show_shortened_post');?>">
				<?php echo $this->module->translate('Show short post view'); ?>
			</label>
		</p>

		<?php
	}
}