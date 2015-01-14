@extends('layouts.admin-login')
@section('content')
<div class="form-box" id="login-box">
    <div class="header"><?php echo trans('messages.sign_in'); ?></div>
    <form action="<?php echo route('admin.login') ?>" method="post">
        <div class="body bg-gray">
            <div class="form-group">
                <input type="text" name="email" class="form-control" value="admin@admin.com" placeholder="<?php echo trans('messages.email'); ?>"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" value="123456"  class="form-control" placeholder="<?php echo trans('messages.password'); ?>"/>
            </div>          
            <div class="form-group">
                <label class="remember-me"><input type="checkbox" name="remember_me"/> <?php echo trans('messages.remember_me'); ?></label>
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn btn-login bg-olive btn-block"><?php echo trans('messages.sign_in'); ?></button>  
        </div>
    </form>
    <?php if (Session::has('error')): ?>
        <div class="alert alert-danger">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
</div>
@stop