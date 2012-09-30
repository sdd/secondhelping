<div class="locations view">
<h2><?php  echo __('Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($location['User']['username'], array('controller' => 'users', 'action' => 'view', $location['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($location['Location']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lon'); ?></dt>
		<dd>
			<?php echo h($location['Location']['lon']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($location['Location']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street Address'); ?></dt>
		<dd>
			<?php echo h($location['Location']['street_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($location['Location']['area']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town Or City'); ?></dt>
		<dd>
			<?php echo h($location['Location']['town_or_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postcode'); ?></dt>
		<dd>
			<?php echo h($location['Location']['postcode']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), null, __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offerings'), array('controller' => 'offerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offering'), array('controller' => 'offerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Offerings'); ?></h3>
	<?php if (!empty($location['Offering'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Due'); ?></th>
		<th><?php echo __('Tags'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($location['Offering'] as $offering): ?>
		<tr>
			<td><?php echo $offering['id']; ?></td>
			<td><?php echo $offering['location_id']; ?></td>
			<td><?php echo $offering['status']; ?></td>
			<td><?php echo $offering['title']; ?></td>
			<td><?php echo $offering['description']; ?></td>
			<td><?php echo $offering['created']; ?></td>
			<td><?php echo $offering['due']; ?></td>
			<td><?php echo $offering['tags']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'offerings', 'action' => 'view', $offering['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'offerings', 'action' => 'edit', $offering['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'offerings', 'action' => 'delete', $offering['id']), null, __('Are you sure you want to delete # %s?', $offering['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Offering'), array('controller' => 'offerings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
