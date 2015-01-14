<?php

/**
 * File AdminGroupController.php
 *
 * PHP version 5.4+
 *
 * @author    Dzung Nguyen
 * @copyright 2010-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  controllers
 * @package   Controllers\Admin
 */
/**
 * Class AdminGroupController
 *
 * Defined a Admin users controller.
 *
 * @author    Dzung Nguyen
 * @copyright 2013-2014 evolpas
 * @license   http://www.evolpas.com/license license
 * @version   XXX
 * @link      http://www.evolpas.com
 * @category  controllers
 * @package   Controllers\Admin
 * @since     XXX
 */

namespace Admin;

use \AdminGroup;
use \View;
use \Response;
use \Lang;
use \Session;
use \Input;
use \AdminUser;
use \Redirect;
use \Auth;
use \App;
use \Hash;

class AdminUserController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function datatables() {
		$users = AdminUser::select(array(
					'id',
					'first_name',
					'last_name',
					'email',
					'created_at',
		));
		return \Datatables::of($users)
						->remove_column('id')
						->edit_column('created_at', function($user) {
									return $user->created_at->format('d/m/Y H:i');
								})->add_column('actions', '<a href="{{route("admin.users.edit", $id)}}" class="text-blue" title="{{ trans("messages.edit")}}">
                                        <i class="fa fa-fw fa-edit"></i>{{trans("messages.edit")}}
                                    </a>
                                    <a href="{{ route("admin.users.destroy", $id) }}" class="text-danger" data-method="delete" title="{{trans("messages.delete") }}">
                                        <i class="fa fa-fw fa-ban"></i>{{trans("messages.delete")}}
                                    </a>')
						->make();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
//        $users = AdminUser::condition(Input::all())
//            ->orderBy('created_at', 'desc')
//            ->paginate();
		$this->layout->content = View::make('admin.users.index', array(
					//'users' => $users,
					'input' => Input::all(),
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$groups = AdminGroup::lists('name', 'id');
		return View::make('admin.users.create', array(
					'groups' => $groups
		));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$v = \AdminUser::defaultValidate(Input::all());
		if ($v->passes()) {
			$user = new AdminUser(Input::all());
			$user->save();
			$user->attachGroup(Input::get('groups', ''));
			Session::flash('success', Lang::get('messages.user_saved_successfully', array('name' => $user->getFullName())));
			return Redirect::route('admin.users.index');
		} else {
			return Redirect::back()->withInput()->withErrors($v->messages());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$groups = AdminGroup::lists('name', 'id');
		$user = AdminUser::findOrFail($id);
		$curentGroup = $user->groups()->lists('group_id');
		return View::make('admin.users.edit', array(
					'user' => $user,
					'groups' => $groups,
					'curentGroup' => $curentGroup
		));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$user = AdminUser::findOrFail($id);
		$v = \AdminUser::editValidate(Input::all(), $user->id);
		if ($v->passes()) {
			$user->update(Input::all());
			$user->attachGroup(Input::get('groups', ''));
			Session::flash('success', Lang::get('messages.user_saved_successfully', array('name' => $user->getFullName())));
			return Redirect::route('admin.users.index');
		} else {
			return Redirect::back()->withErrors($v->messages());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$user = \AdminUser::findOrFail($id);
		$user->groups()->detach();
		$user->delete();
		Session::flash('success', Lang::get('messages.user_deleted', array('name' => $user->getFullName())));
		return Redirect::back();
	}

	/**
	 * Show the form to edit profile
	 * @return Response
	 */
	public function profile() {
		$user = Auth::admin()->get();
		$resources = \AdminResource::$resources;
		$allowedRoutes = App::make('allowed_routes');
		$this->layout->content = View::make('admin.users.profile', array(
					'user' => $user,
					'resources' => $resources,
					'allowedRoutes' => $allowedRoutes,
		));
	}

	/**
	 * Update profile
	 * @return Response
	 */
	public function postProfile() {
		$v = \AdminUser::profileValidate(Input::all());
		if ($v->passes) {
			$user = Auth::admin()->get();
			$user->update(Input::all());
			Session::flash('success', Lang::get('messages.profile_saved'));
			return Redirect::back();
		}
		return Redirect::back()->withErrors($v->messages());
	}

	/**
	 * Show the form to change password
	 * @return Response
	 */
	public function password() {
		$this->layout->content = View::make('admin.users.password');
	}

	/**
	 * Post and handling for change password action
	 * @return Response
	 */
	public function postPassword() {
		$v = \AdminUser::passwordValidate(Input::all());
		if ($v->passes()) {
			$user = Auth::admin()->get();
			if (!Hash::check(Input::get('old_password'), $user->password)) {
				Session::flash('error', Lang::get('messages.old_password_not_match'));
				return Redirect::back();
			}
			$user->update(Input::all());
			Session::flash('success', Lang::get('messages.password_updated'));
		} else {
			return Redirect::back()->withErrors($v->messages());
		}
	}

}
