<?php

echo Former::text('email')
        ->class('form-control');
echo Former::text('first_name')
        ->label(Lang::get('messages.first_name'))
        ->class('form-control');
echo Former::text('last_name')
        ->class('form-control');
echo Former::password('password')
        ->class('form-control');
echo Former::password('password_confirmation')
        ->class('form-control');
echo Former::select('group_id')
        ->options($groups, isset($curentGroup) ? $curentGroup : null)
        ->multiple()
        ->id('user-select-group')
        ->class('custom-select2 select2');
?>