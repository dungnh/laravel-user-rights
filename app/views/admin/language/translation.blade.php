@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.settings'); ?>
    <small><?php echo trans('messages.translations'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.translations'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-anchor"></i>
                <h3 class="box-title"><?php echo trans('messages.translations'); ?></h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo route('admin.language.index') ?>" class="btn btn-success">
                        <i class="fa fa-arrow-left"></i> <?php echo trans('messages.back'); ?></a>
                </div>
            </div>
            <form action="<?php echo route('admin.language.translation', array('to' => $to)) ?>" method="post" accept-charset="character_set">
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>English</th>
                                <th>Japanese</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($langContentFrom as $k => $v): ?>
                                <tr style="font-weight: bold">
                                    <td><?php echo $k ?></td>
                                    <td><?php echo $k ?></td>
                                </tr>
                                <?php foreach ($v as $langKey => $langVal) : ?>
                                    <?php if (!is_array($langVal)): ?>
                                        <tr>
                                            <td>
                                                <input class="form-control disabled" type="text" name="" value="<?php echo $langVal ?>" readonly/>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="<?php echo $k . '[' . $langKey . ']' ?>" value="<?php echo ( isset($langContentTo[$k][$langKey])) ? $langContentTo[$k][$langKey] : '' ?>"/>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($langVal as $ksub => $vsub): ?>
                                            <tr>
                                                <td>
                                                    <input class="form-control" type="text" name="" value="<?php echo $vsub ?>" readonly/>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="<?php echo $k . '[' . $langKey . '][' . $ksub . ']' ?>" value="<?php echo ( isset($langContentTo[$k][$langKey][$ksub])) ? $langContentTo[$k][$langKey][$ksub] : '' ?>"/>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-sm-offset-6 col-lg-8 col-sm-6">
                            <input class="btn-primary btn"  type="submit" value="<?php echo trans('messages.save'); ?>"> 
                            <a class="btn-default btn" href="<?php echo route('admin.language.index') ?>"><?php echo trans('messages.cancel'); ?></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop