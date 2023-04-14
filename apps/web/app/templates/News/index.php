<?php $this->start('css') ?>
<link rel="stylesheet" href="/assets/css/news.css?v=37a5cc979b5b7839cac4d0f606e3bb1e">
<?php $this->end() ?>

<main>
	<div class="news-wrapper">
		<section class="ttl-section">
			<div class="section-wrapper"> <span class="circle gray"> <img src="/assets/images/circle-gray.svg?v=1deef8be8ac37b793816d6e57117bfe0" alt=""></span><span class="circle green"><img src="/assets/images/circle-green.svg?v=fe7aafb7c1bf7cc75a8820d93fff66ba" alt=""></span><span class="circle red"><img src="/assets/images/circle-red.svg?v=c6bd3b8d2f4340b41678f05533339265" alt=""></span><span class="circle blue"><img src="/assets/images/circle-blue.svg?v=7124f5e56da2ece3ebbbfa70a7022891" alt=""></span>
				<h2 class="ttl"> <span class="ja">お知らせ・ブログ</span><span class="en">NEWS・BLOG</span></h2>
			</div>
		</section>
		<section class="contents-section">
			<div class="bg-top"> </div>
			<div class="bg-content">
				<div class="section-wrapper">
					<div class="newsContent">
						<div class="newsContent-item left">
							<h3 class="listTtl">CATEGORY</h3>
							<ul class="categoryList">
								<?php foreach ($category as $category_data) : ?>
									<li class="categoryList-item">
										<a href="/news?category_id=<?= $category_data->id ?>">
											<?= h($category_data->name) ?><span class="num">(<?= count($category_data->infos) ?>)</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="newsContent-item right">
							<div class="newsList-wrapper">
								<div class="inner">
									<ul class="newsList">
										<?php foreach ($infos as $data) : ?>
											<?php
												$target = in_array($data['link_type'], ['2', '4']) ? 'target="_blank"' : '';
												$href = '/news/' . $data['id'];
												if ($data['link_type'] == 2) $href = $data['link'];
												if ($data['link_type'] == 3) $href = $data['link_blank'];
												if ($data['link_type'] == 4) $href = $data['attaches']['file'][0];
												?>
											<li class="newsList-item"> <a href="<?= $href ?>" <?= $target ?>>
													<div class="data">
														<div class="date"><?= $data->start_at->format('Y.m.d') ?></div>
														<div class="category"><?= h($data->category['name']) ?></div>
													</div>
													<div class="ttl"><?= h($data->title) ?></div>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<div class="pagination">
								<div class="pagination-wrapper">
									<?php if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) : ?>
										<?= $this->Paginator->prev('') ?>
										<?= $this->Paginator->numbers(['modulus' => 2, 'first' => 1, 'last' => 1]); ?>
										<?= $this->Paginator->next('') ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="bredcrumb">
		<ul>
			<li> <a href="/">TOP</a></li>
			<li class="current"><a href="javascript:void(0);">お知らせ・ブログ</a></li>
		</ul>
	</div>
</main>