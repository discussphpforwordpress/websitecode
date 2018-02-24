<?php

class Membership_Groups_Widgets_SuggestedGroups extends Wp_Widget {

	private $module;
	/**
	 * Register widget with WordPress.
	 */
	function __construct(Membership_Groups_Module $module) {

		$this->module = $module;

		parent::__construct(
			'Membership_Groups_Widgets_SuggestedGroups',
			$module->translate('Membership by Supsystic Suggested Groups'),
			array(
				'description' => $module->translate('Shows the list of suggested groups.')
			)
		);

		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
	}

	public function enqueueScripts() {
		if (is_active_widget(false, false, $this->id_base, true) ) {
			$this->module->getModule('base')->enqueueAssets();
			$this->module->enqueueGroupsListAssets();
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

		$limit = empty($instance['limit']) ? '5' : $instance['limit'];
		$columns = empty($instance['columns']) ? '1' : $instance['columns'];
		$buttons = empty($instance['buttons']) ? 'true' : $instance['buttons'];
		$tagsModel = $this->module->getModel('Tags', 'Groups');

		$groups = $tagsModel->getSuggestedGroups(array(
			'limit' => $limit,
		));

		$columnsLiterals = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');

		echo $this->module->render('@groups/widgets/popular.twig', array(
			'groups' => $groups,
			'columns' => $columnsLiterals[$columns - 1],
			'buttons' => $buttons
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
		$limit = empty($instance['limit']) ? '5' : $instance['limit'];
		$columns = empty($instance['columns']) ? '1' : $instance['columns'];
		$buttons = empty($instance['buttons']) ? 'true' : $instance['buttons'];

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
				<?php echo $this->module->translate('Number of groups to show:'); ?>
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
			<label for="<?php echo $this->get_field_id('columns'); ?>">
				<?php echo $this->module->translate('Number of columns to show:'); ?>
			</label>
			<input
				class="widefat"
				min="1"
				max="10"
				id="<?php echo $this->get_field_id('columns'); ?>"
				name="<?php echo $this->get_field_name('columns'); ?>"
				type="number"
				value="<?php echo esc_attr($columns); ?>"
			>
		</p>
		<p>
			<input
				type="hidden"
				name="<?php echo $this->get_field_name('buttons'); ?>"
				value="false"
			>
			<input
				id="<?php echo $this->get_field_id('buttons'); ?>"
				name="<?php echo $this->get_field_name('buttons'); ?>"
				type="checkbox"
				value="true"
				<?php if ($buttons == 'true'): ?>checked="true"<?php endif; ?>
			>
			<label class="widefat" for="<?php echo $this->get_field_id('buttons'); ?>">
				<?php echo $this->module->translate('Show group action buttons?'); ?>
			</label>

		</p>

		<?php
	}
}