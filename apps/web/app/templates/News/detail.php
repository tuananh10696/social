<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/news.css?v=0b2367f8e46a4e00b95e49eda0857677">
<style>
	p>a {
		border-bottom: 1px solid #e8664e;
		color: #e8664e;
		font-weight: 600;
		letter-spacing: .1em;
		line-height: 1.875;
		-webkit-transition: border-color .3s ease;
		-o-transition: border-color .3s ease;
		transition: border-color .3s ease;
		will-change: border-color;
	}
</style>
<?php $this->end() ?>

<main>
	<div class="news-wrapper detail">
		<section class="ttl-section">
			<div class="section-wrapper"> <span class="circle gray"> <img src="/assets/images/circle-gray.svg?v=1deef8be8ac37b793816d6e57117bfe0" alt=""></span><span class="circle green"><img src="/assets/images/circle-green.svg?v=fe7aafb7c1bf7cc75a8820d93fff66ba" alt=""></span><span class="circle red"><img src="/assets/images/circle-red.svg?v=c6bd3b8d2f4340b41678f05533339265" alt=""></span><span class="circle blue"><img src="/assets/images/circle-blue.svg?v=7124f5e56da2ece3ebbbfa70a7022891" alt=""></span>
				<h2 class="ttl"> <span class="ja">お知らせ・ブログ</span><span class="en">NEWS・BLOG</span></h2>
			</div>
		</section>
		<section class="contents-section">
			<div class="bg-top"> </div>
			<div class="bg-content">
				<div class="section-wrapper">
					<div class="wysiwyg">
						<div class="inner">
							<div class="data">
								<div class="date"><?= $info->start_at->format('Y.m.d') ?></div>
								<div class="category"><?= h($info->category['name']) ?></div>
							</div>
							<h1><?= h($info->title) ?></h1>
							<?php foreach ($contents as $content) : ?>
								<?php $is_show = is_show($content) ?>
								<?php if (!$is_show) : ?>
									<?= $this->element('info/content_' . $content['block_type'], ['c' => $content]); ?>
								<?php endif ?>
							<?php endforeach; ?>
						</div>

					</div>
					<div class="detailPagination">
						<div class="detailPagination-wrapper">
							<?php
							if (!empty($listId[0])) {
								$target_prev = in_array($listId[0]['info']['link_type'], ['2', '4']) ? 'target="_blank"' : '';
								$href_prev = '/news/' . $listId[0]['info']['id'];
								if ($listId[0]['info']['link_type'] == 2) $href_prev = $listId[0]['info']['link'];
								if ($listId[0]['info']['link_type'] == 3) $href_prev = $listId[0]['info']['link_blank'];
								if ($listId[0]['info']['link_type'] == 4) $href_prev = $listId[0]['info']['attaches']['file'][0];
							}
							if (!empty($listId[1])) {
								$target_next = in_array($listId[1]['info']['link_type'], ['2', '4']) ? 'target="_blank"' : '';
								$href_next = '/news/' . $listId[1]['info']['id'];
								if ($listId[1]['info']['link_type'] == 2) $href_next = $listId[1]['info']['link'];
								if ($listId[1]['info']['link_type'] == 3) $href_next = $listId[1]['info']['link_blank'];
								if ($listId[1]['info']['link_type'] == 4) $href_next = $listId[1]['info']['attaches']['file'][0];
							}
							?>
							<?php if (!$this->request->getQuery('preview')) : ?>
								<ul class="list">
									<?php if (!empty($listId[0])) : ?>
										<li class="list-item prev"><a href="<?= $href_prev ?>" <?= $target_prev ?>> <span>前へ</span></a></li>
									<?php endif ?>
									<li class="list-item back"><a href="<?= renderBackUrl('news') ?>"> <span>一覧へ戻る</span></a></li>
									<?php if (!empty($listId[1])) : ?>
										<li class="list-item next"><a href="<?= $href_next ?>" <?= $target_next ?>> <span>次へ</span></a></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="bredcrumb">
		<ul>
			<li> <a href="/">TOP</a></li>
			<li><a href="/news/">お知らせ・ブログ</a></li>
			<li class="current"><a href="javascript:void(0);"><?= h($info->title) ?></a></li>
		</ul>
	</div>
</main>