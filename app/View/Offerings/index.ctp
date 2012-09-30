<div class="offerings index">
	<h2><?php echo __('Offerings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('due'); ?></th>
			<th><?php echo $this->Paginator->sort('tags'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($offerings as $offering): ?>
	<tr>
		<td><?php echo h($offering['Offering']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($offering['Location']['name'], array('controller' => 'locations', 'action' => 'view', $offering['Location']['id'])); ?>
		</td>
		<td><?php echo h($offering['OfferStatus']['name']); ?>&nbsp;</td>
		<td><?php echo h($offering['Offering']['title']); ?>&nbsp;</td>
		<td><?php echo h($offering['Offering']['description']); ?>&nbsp;</td>
		<td><?php echo h($offering['Offering']['created']); ?>&nbsp;</td>
		<td><?php echo h($offering['Offering']['due']); ?>&nbsp;</td>
		<td><?php echo h($offering['Offering']['tags']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $offering['Offering']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $offering['Offering']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $offering['Offering']['id']), null, __('Are you sure you want to delete # %s?', $offering['Offering']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Offering'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collection Requests'), array('controller' => 'collection_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection Request'), array('controller' => 'collection_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
