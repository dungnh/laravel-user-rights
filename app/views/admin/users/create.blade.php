@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.add_user'); ?></small>
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
            echo Former::open(route('admin.users.store'))
                ->id('form-admin-user')
                ->method('Post')

            ?>
            <div class="box-body col-lg-8">
                <?php echo View::make('admin.users._form')->with('groups', $groups)->render() ?>
            </div><!-- /.box-body -->
            <div class="clearfix"></div>

            <div class="box-footer">
                <div class="form-group col-md-offset-2">
                    <input class="btn-primary btn" id="btn-submit-user" type="button" value="<?php echo trans('messages.save'); ?>"> 
                    <a class="btn-default btn" href="<?php echo route('admin.users.index') ?>"><?php echo trans('messages.cancel'); ?></a>
                </div>
            </div>
            <?php echo Former::close(); ?>
        </div><!-- /.box -->
    </div>
</div>

@stop