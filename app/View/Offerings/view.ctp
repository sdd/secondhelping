<div class="offerings view">
<h2><?php  echo __('Offering'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($offering['Location']['name'], array('controller' => 'locations', 'action' => 'view', $offering['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($offering['OfferStatus']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Due'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['due']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($offering['Offering']['tags']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Offering'), array('action' => 'edit', $offering['Offering']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Offering'), array('action' => 'delete', $offering['Offering']['id']), null, __('Are you sure you want to delete # %s?', $offering['Offering']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Offerings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offering'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collection Requests'), array('controller' => 'collection_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection Request'), array('controller' => 'collection_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Collection Requests'); ?></h3>
	<?php if (!empty($offering['CollectionRequest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Offering Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Eta'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($offering['CollectionRequest'] as $collectionRequest): ?>
		<tr>
			<td><?php echo $collectionRequest['id']; ?></td>
			<td><?php echo $collectionRequest['user_id']; ?></td>
			<td><?php echo $collectionRequest['offering_id']; ?></td>
			<td><?php echo $collectionRequest['created']; ?></td>
			<td><?php echo $collectionRequest['status']; ?></td>
			<td><?php echo $collectionRequest['eta']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'collection_requests', 'action' => 'view', $collectionRequest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'collection_requests', 'action' => 'edit', $collectionRequest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'collection_requests', 'action' => 'delete', $collectionRequest['id']), null, __('Are you sure you want to delete # %s?', $collectionRequest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Collection Request'), array('controller' => 'collection_requests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
