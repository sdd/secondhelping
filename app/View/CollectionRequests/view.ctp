<div class="collectionRequests view">
<h2><?php  echo __('Collection Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($collectionRequest['CollectionRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collectionRequest['User']['username'], array('controller' => 'users', 'action' => 'view', $collectionRequest['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Offering'); ?></dt>
		<dd>
			<?php echo $this->Html->link($collectionRequest['Offering']['title'], array('controller' => 'offerings', 'action' => 'view', $collectionRequest['Offering']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($collectionRequest['CollectionRequest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($collectionRequest['CollectionRequest']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eta'); ?></dt>
		<dd>
			<?php echo h($collectionRequest['CollectionRequest']['eta']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Collection Request'), array('action' => 'edit', $collectionRequest['CollectionRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Collection Request'), array('action' => 'delete', $collectionRequest['CollectionRequest']['id']), null, __('Are you sure you want to delete # %s?', $collectionRequest['CollectionRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Collection Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offerings'), array('controller' => 'offerings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offering'), array('controller' => 'offerings', 'action' => 'add')); ?> </li>
	</ul>
</div>
