<?php

use App\Model\Entity\PageConfigItem;
?>
<table class="table table-sm table-hover table-bordered dataTable dtr-inline">
    <colgroup>
        <col style="width: 100px;">
        <col style="width: 75px;">
        <col style="width: 135px">
        <col>
        <?php foreach ($list_buttons as $ex) : ?>
            <col style="width: 100px">
        <?php endforeach; ?>
        <col style="width: 135px">
        <?php if ($this->Common->isViewPreviewBtn($page_config)) : ?>
            <col style="width: 75px;">
        <?php endif; ?>
        <?php if ($this->Common->isViewSort($page_config, $sch_category_id)) : ?>
            <col style="width: 150px">
        <?php endif; ?>
    </colgroup>

    <thead class="bg-gray">
        <tr>
            <th>掲載</th>
            <th>記事ID</th>
            <th>掲載期間</th>
            <th style="text-align:left;">
                <?php if ($this->Common->isCategoryEnabled($page_config)) {
                    echo 'カテゴリ/';
                } ?>
                <?php if ($this->Common->enabledInfoItem($page_config->id, PageConfigItem::TYPE_MAIN, 'title')) : ?>
                    <?= $this->Common->infoItemTitle($page_config->id, PageConfigItem::TYPE_MAIN, 'title', 'title', 'タイトル'); ?>
                <?php endif; ?>
            </th>
            <?php foreach ($list_buttons as $ex) : ?>
                <th style="text-align:left;"><?= $ex->name; ?></th>
            <?php endforeach; ?>

            <th>更新日時</th>
            <?php if ($this->Common->isViewPreviewBtn($page_config)) : ?>
                <th style="text-align:left;">確認</th>
            <?php endif; ?>

            <?php if ($this->Common->isViewSort($page_config, $sch_category_id)) : ?>
                <th>順序の変更</th>
            <?php endif; ?>

        </tr>
    </thead>

    <?php
    foreach ($data_query->toArray() as $key => $data) :
        $data->appendInit();
        $no = sprintf("%02d", $data->id);
        $id = $data->id;
        $scripturl = '';

        $status = $data['status'] === 'publish';
        $status_text = $status ? '掲載中' : '下書き';
        $status_class = $status ? 'visible' : 'unvisible';
        $status_btn_class = $status ? 'visi' : 'unvisi';

        if ($status) {
            $now = new \DateTime();
            if ($data->start_at && $data->start_at->format('Y-m-d') > $now->format('Y-m-d')) {
                // 掲載待ち
                $status_class = 'unvisible_wait';
                $status_text = '掲載待ち';
            } elseif ($data->end_at && $data->end_at->format('Y-m-d') <= $now->format('Y-m-d')) {
                $status_class = 'unvisible_end';
                $status_text = '掲載終了';
            }
        }
        ?>
        <a name="m_<?= $id ?>"></a>
        <tr class="<?= $status_class; ?>" id="content-<?= $data->id ?>">
            <td>
                <?= $this->element('status_button', ['status' => $status, 'id' => $data->id, 'class' => 'scroll_pos', 'enable_text' => $status_text, 'disable_text' => $status_text]); ?>
            </td>

            <td>
                <?= $data->id; ?>
            </td>

            <td style="text-align: center;">
                <?= __('{0}{1}', ($data->start_at ? $data->start_at->format('Y/m/d') : ''), ($data->start_now == 1 && $data->end_at ? __(' - {0}', $data->end_at->format('Y/m/d')) : '')) ?>
            </td>

            <td>
                <?php $is_map_txt = $data->index_type == 1 ? '<span class="badge badge-danger">おすすめ</span>' : ''; ?>
                <?php if ($this->Common->isCategoryEnabled($page_config)) : ?>
                    <?php if ($page_config->is_category_multiple == 1) : ?>
                        <?= $this->Html->view($this->Common->getInfoCategories($data->id, 'names'), ['before' => '【', 'after' => '】' . $is_map_txt . '<br>']); ?>
                    <?php else : ?>
                        <?= $this->Html->view((!empty($data->category->name) ? $data->category->name : '未設定'), ['before' => '【', 'after' => '】' . $is_map_txt . '<br>']); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?= $this->Html->link(h($data->title), ['action' => 'edit', $data->id, '?' => $query], ['escape' => false, 'class' => 'btn btn-light w-100 text-left']) ?>

            </td>

            <?php foreach ($list_buttons as $ex) : ?>
                <td>
                    <a href="<?= $this->Html->exUrl($ex->link, ['info_id' => $data->id, 'page_slug' => 'event_info']); ?>" class="btn btn-success btn-sm text-white"><?= $ex->name; ?></a>
                </td>
            <?php endforeach; ?>


            <td>
                <?= $data['modified']->format('Y-m-d H:i') ?>
            </td>

            <?php if ($this->Common->isViewPreviewBtn($page_config)) : ?>
                <td>

                    <?php
                            $href = "/news/{$data->id}?preview=on";
                            if ($data['link_type'] == 2) $href = $data['link'];
                            if ($data['link_type'] == 3) $href = $data['link_blank'];
                            if ($data['link_type'] == 4) $href = $data['attaches']['file'][0];
                            ?>
                    <div class="prev"><a href="<?= $href ?>" target="_blank">プレビュー</a></div>
                </td>
            <?php endif; ?>

            <?php if ($this->Common->isViewSort($page_config, $sch_category_id)) : ?>
                <td>
                    <ul class="ctrlis">
                        <?php if (!$this->Paginator->hasPrev() && $key == 0) : ?>
                            <li class="non">&nbsp;</li>
                            <li class="non">&nbsp;</li>
                        <?php else : ?>
                            <li class="cttop"><?= $this->Html->link('top', array('action' => 'position', $data->id, 'top', '?' => $query), ['class' => 'scroll_pos']) ?></li>
                            <li class="ctup"><?= $this->Html->link('top', array('action' => 'position', $data->id, 'up', '?' => $query), ['class' => 'scroll_pos']) ?></li>
                        <?php endif; ?>

                        <?php if (!$this->Paginator->hasNext() && $key == count($datas) - 1) : ?>
                            <li class="non">&nbsp;</li>
                            <li class="non">&nbsp;</li>
                        <?php else : ?>
                            <li class="ctdown"><?= $this->Html->link('top', array('action' => 'position', $data->id, 'down', '?' => $query), ['class' => 'scroll_pos']) ?></li>
                            <li class="ctend"><?= $this->Html->link('bottom', array('action' => 'position', $data->id, 'bottom', '?' => $query), ['class' => 'scroll_pos']) ?></li>
                        <?php endif; ?>
                    </ul>
                </td>
            <?php endif; ?>

        </tr>

    <?php endforeach; ?>

</table>