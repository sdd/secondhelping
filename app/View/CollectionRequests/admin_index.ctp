<div class="collectionRequests index">
	<h2><?php echo __('Collection Requests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('offering_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('eta'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($collectionRequests as $collectionRequest): ?>
	<tr>
		<td><?php echo h($collectionRequest['CollectionRequest']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($collectionRequest['User']['username'], array('controller' => 'users', 'action' => 'view', $collectionRequest['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($collectionRequest['Offering']['title'], array('controller' => 'offerings', 'action' => 'view', $collectionRequest['Offering']['id'])); ?>
		</td>
		<td><?php echo h($collectionRequest['CollectionRequest']['created']); ?>&nbsp;</td>
		<td><?php echo h($collectionRequest['CollectionRequest']['status']); ?>&nbsp;</td>
		<td><?php echo h($collectionRequest['CollectionRequest']['eta']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $collectionRequest['CollectionRequest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $collectionRequest['CollectionRequest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $collectionRequest['CollectionRequest']['id']), null, __('Are you sure you want to delete # %s?', $collectionRequest['CollectionRequest']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Collection Request'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offerings'), array('controller' => 'offerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offering'), array('controller' => 'offerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
