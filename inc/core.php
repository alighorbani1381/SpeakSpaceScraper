<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
require_once('inc/simple_html_dom.php');
require_once('inc/url.php');


if(!urlPage::isOnline()){
	echo "Check Your Connection i don't Access to the Internet!";
	return null;
}

$step = 0;
for ($i = 30853; $i < 30863; $i++) :
	$url = urlPage::urlGenerate($i);
	$html = file_get_html($url);

	if (!urlPage::hasMessage($html))
		continue;

    echo " | ";
	foreach ($html->find('div.TranslucentPanel') as $messagePanel) {
		$user = @$messagePanel->find('div.col-lg-11 h3', 0)->plaintext;
		$messages[$user]['url'] = $url;
		foreach ($messagePanel->find('p.message-text') as $test)
			$messages[$user]['message'][] = $test->plaintext;
	}

endfor;

?>

<div class="container">
		<?php if (count($messages) != 0) : ?>
			<?php foreach ($messages as $user => $message) : ?>
				<?php if ($user != "") : ?>
					<div class="card">
						<h5 class="card-header">
							<span>نوشته شده توسط:</span>
							<a target="_blank" href="<?= $message['url'] ?>"><?= $user ?></a>
						</h5>
						<div class="card-body">
							<?php foreach ($message['message'] as $key => $messageItem) : ?>
								<p class="card-text">
									<b><?= $key + 1 . ": " ?></b>
									<?= $messageItem ?>
								</p>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else : ?>
			پیدا نشد
		<?php endif; ?>
	</div>