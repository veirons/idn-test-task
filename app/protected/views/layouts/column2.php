<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
    <?php $this->widget('ext.widgets.SimpleChat', array(
            'options' => array(
                'limitCount'=> Yii::app()->params['chatCountMessages'],
                'urlGet' => $this->createUrl('post/simple_chat.getMessage'),
                'urlAdd' => $this->createUrl('post/simple_chat.addMessage'),
                'upTime' => '5000',
            ),
        )); ?>
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
			<?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>