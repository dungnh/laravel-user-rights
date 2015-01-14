@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.groups'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.groups'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <i class="fa fa-anchor"></i>
                <h3 class="box-title"><?php echo trans('messages.languages'); ?></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo trans('messages.language'); ?></th>
                            <th><?php echo trans('messages.status'); ?></th>
                            <th><?php echo trans('messages.translated'); ?></th>
                            <th><?php echo trans('messages.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appLanguages as $lang): ?>
                            <tr>
                                <td><?php echo $lang->language_name ?></td>
                                <td>
                                    <?php if ($lang->is_default == 1): ?>
                                        <span class="label label-success"><?php echo trans('messages.default'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($lang->code != Config::get('app.fallback_locale')):
                                        $percen = (int) (($lang->total - $lang->lack) / $lang->total * 100);

                                        ?>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-primary" style="width: <?php echo $percen.'%' ?>"></div>
                                        </div>
                                    <span class="label label-primary pull-right" style="margin-top: 3px"><?php echo $percen . '%' ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($lang->code != Config::get('app.fallback_locale')): ?>
                                        <a href="<?php echo route('admin.language.translation', array('to' => $lang->code)) ?>" class="label label-primary"><?php echo trans('messages.translate'); ?></a>
                                    <?php endif; ?>
                                    <?php if ($lang->is_default == 0): ?>
                                        <a href="<?php echo route('admin.language.default', $lang->id) ?>" class="label label-danger" ><?php echo trans('messages.make_default'); ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="">

</div>
@stop