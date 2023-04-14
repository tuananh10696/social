<?php $this->start('search_box'); ?>
<div class="row">
    <div class="col-12">
        <div class="card on">
            <div class="card-header bg-gray-dark">
                <h2 class="card-title">検索条件</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">

                <!--多階層カテゴリ-->
                <?php if ($this->Common->isCategorySort($page_config->id, $sch_category_id) && $page_config->is_category_multilevel == 1) : ?>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <?php
                                $category_level = 0;
                                $prev_category_id = 0;
                                ?>

                            <?php foreach ($category_list as $clist) : $category_level++; ?>
                                <li class="breadcrumb-item">
                                    <?= $this->Form->create(false, ['type' => 'get', 'id' => 'fm_search_' . $clist['category']->id, 'style' => 'display:inline-block;']); ?>
                                    <?= $this->Form->input('sch_page_id', ['type' => 'hidden', 'value' => $sch_page_id]); ?>
                                    <?= $this->Form->input('sch_category_id', [
                                                'type' => 'select',
                                                'options' => $clist['list'],
                                                'onChange' => 'change_category("fm_search_' . $clist['category']->id . '");',
                                                'value' => $clist['category']->id,
                                                'empty' => $clist['empty']
                                            ]); ?>
                                    <?= $this->Form->end(); ?>
                                    <span class="btn_area" style="display: inline-block">
                                        <?php if (!empty($clist['category']->id)) : ?>
                                            <!-- 編集ボタン -->
                                            <a href="<?= $this->Url->build(array(
                                                                        'controller' => 'categories',
                                                                        'action' => 'edit',
                                                                        $clist['category']->id,
                                                                        '?' => ['sch_page_id' => $clist['category']->page_config_id, 'parent_id' => $clist['category']->parent_category_id, 'redirect' => 'infos']
                                                                    )); ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="選択されているカテゴリの編集">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <!-- 追加ボタン -->
                                        <a href="<?= $this->Url->build(array(
                                                                'controller' => 'categories',
                                                                'action' => 'edit',
                                                                0,
                                                                '?' => ['sch_page_id' => $page_config->id, 'parent_id' => $prev_category_id, 'redirect' => 'infos']
                                                            )); ?>" class="btn btn-sm btn-danger" style="margin-left:1px;" data-toggle="tooltip" data-placement="top" title="カテゴリを追加します">
                                            <i class="fas fa-plus"></i>
                                        </a>

                                    </span>
                                </li>
                                <?php $prev_category_id = $clist['category']->id; ?>
                            <?php endforeach; ?>
                            <?php if (!empty($clist['category']->id) && (!$page_config->max_multilevel || $category_level < $page_config->max_multilevel)) : ?>
                                <!-- 下層追加ボタン -->
                                <li class="breadcrumb-item">
                                    <span class="btn_area" style="display: inline-block">
                                        <a href="<?= $this->Url->build(array(
                                                                'controller' => 'categories',
                                                                'action' => 'edit',
                                                                0,
                                                                '?' => ['sch_page_id' => $clist['category']->page_config_id, 'parent_id' => $clist['category']->id, 'redirect' => 'infos']
                                                            )); ?>" class="btn btn-sm btn-warning" style="margin-left:1px;" data-toggle="tooltip" data-placement="top" title="下層カテゴリを追加します">
                                            <i class="fas fa-plus"></i> 下層カテゴリ
                                        </a>
                                    </span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php else : ?>

                    <!-- 検索開始ボタン用フォーム -->
                    <!-- 多階層カテゴリ以外-->
                    <?= $this->Form->create(null, ['type' => 'get', 'valueSources' => ['query'], 'id' => 'fm_search', 'templates' => $form_templates]); ?>
                    <?= $this->Form->hidden('sch_page_id'); ?>

                    <div class="table__search">
                        <div class="row">
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">掲載</span>
                                    </div>
                                    <?= $this->Form->input('sch_status', [
                                            'type' => 'select',
                                            'options' => ['publish' => '掲載中', 'draft' => '下書き', 'post_time_wait' => '掲載待ち' , 'post_time_end' => '掲載終了'],
                                            'empty' => ['' => '全て'],
                                            'class' => 'form-control'
                                        ]); ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">カテゴリ
                                            <small>(&nbsp;<a href="/user_admin/categories/?sch_page_id=<?= $page_config->id ?>">
                                                    <i class="fas fa-list-alt"></i> 一覧へ
                                                </a>&nbsp;)
                                            </small>
                                        </span>
                                    </div>
                                    <?php
                                        $newArray = array_map(function ($v) {
                                            return trim(strip_tags($v));
                                        }, $category_list);
                                        $opts = [
                                            'type' => 'select',
                                            'options' => $newArray,
                                            'class' => 'form-control'
                                        ];
                                        if (!$this->Common->isCategorySort($page_config->id, $sch_category_id))
                                            $opts['empty'] = ['0' => '全て'];
                                        ?>
                                    <?= $this->Form->input('sch_category_id', $opts); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">キーワード検索</span>
                                    </div>
                                    <?= $this->Form->input('sch_words', ['type' => 'text', 'class' => 'form-control', 'maxleng' => '50']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="btn_area center">
                            <button type="button" class="btn btn-secondary mr-2" onclick="window.location.href='/user_admin/infos/?sch_page_id=<?= $page_config->id ?>'"><?= __('条件クリア'); ?></button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i><?= __('検索開始'); ?></button>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                <?php endif; ?>


            </div>
        </div>
        <!--/.card-->
    </div>
    <!--/.col-12-->
</div>
<?php $this->end(); ?>