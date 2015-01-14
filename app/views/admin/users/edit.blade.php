@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.edit_user'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.user'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 center">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo trans('messages.input_user'); ?></h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <?php
            echo Former::open(route('admin.users.update', $user->id))
                    ->id('form-admin-user')
                    ->method('put')
            ?>
            <div class="box-body col-lg-8">
                <?php Former::populate($user); ?>
                <?php
                echo Former::text('email')
                        ->class('form-control');
                echo Former::text('first_name')
                        ->label(Lang::get('messages.first_name'))
                        ->class('form-control');
                echo Former::text('last_name')
                        ->class('form-control');
                echo Former::select('group_id')
                        ->options($groups, isset($curentGroup) ? $curentGroup : null)
                        ->multiple()
                        ->id('user-select-group')
                        ->class('custom-select2 select2');
                ?>
            </div><!-- /.box-body -->
            <div class="clearfix"></div>
            <div class="box-footer">
                <div class="form-group">
                    <input class="btn-primary btn" id="btn-submit-user" type="button" value="<?php echo trans('messages.save'); ?>"> 
                    <a class="btn-default btn" href="<?php echo route('admin.users.index') ?>"><?php echo trans('messages.cancel'); ?></a>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop