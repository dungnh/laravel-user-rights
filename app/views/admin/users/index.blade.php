@extends('layouts.admin')
@section('header_content')
<h1>
    <?php echo trans('messages.user_management'); ?>
    <small><?php echo trans('messages.users'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('messages.users'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header clearfix">
                <?php if (in_array('admin.users.create', $allowed_routes)): ?>
                    <div class="col-md-8 no-padding">
                        <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> <?php echo trans('messages.add_user'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <table class="table table-bordered tablesorter dataTable">
                <thead>
                    <tr>
                        <th><?php echo trans('messages.first_name'); ?></th>
                        <th><?php echo trans('messages.last_name'); ?></th>
                        <th><?php echo trans('messages.email'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop
@section('addon_css')
<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
@stop
@section('addon_js')
<script type="text/javascript" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
@stop

@section('inline_js')
<script type="text/javascript">
$(document).ready(function() {
    $('.dataTable').dataTable({
        //"processing": true,
        "serverSide": true,
        "ajax": baseUrl + '/datatables/users'
    });
});
</script>
@stop