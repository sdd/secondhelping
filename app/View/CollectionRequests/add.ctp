<div class="collectionRequests form">
<?php echo $this->Form->create('CollectionRequest'); ?>
	<fieldset>
		<legend><?php echo __('Add Collection Request'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('offering_id');
		echo $this->Form->input('status');
		echo $this->Form->input('eta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Collection Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offerings'), array('controller' => 'offerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offering'), array('controller' => 'offerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
