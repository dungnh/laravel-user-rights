<?php

/**
 * File LanguageController.php
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
 * Class LanguageController
 *
 * Defined a Languages controller.
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

use \App;
use \Config;
use \Lang;
use \File;
use \View;
use \Input;
use \Redirect;
use \DB;
use \Session;

class LanguageController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getTranslation() {
		$to = Input::get('to', 'jp');
		$fallbackLocale = Config::get('app.fallback_locale');
		$langPath = app_path() . '/lang/';
		if (!is_dir($langPath . $to)) {
			mkdir($langPath . $to);
		}
		$langFiles = File::files($langPath . $fallbackLocale);
		$langContentFrom = array();
		$langContentTo = array();
		foreach ($langFiles as $langFile) {
			$langFileName = basename($langFile);
			$langFileTitle = basename($langFile, '.php');
			$langContentFrom[$langFileTitle] = File::getRequire($langPath . $fallbackLocale . '/' . $langFileName);
			if (is_file($langPath . $to . '/' . $langFileName)) {
				$langContentTo[$langFileTitle] = File::getRequire($langPath . $to . '/' . $langFileName);
			} else {
				$langContentTo[$langFileTitle] = array();
			}
		}
		$this->layout->content = View::make('admin.language.translation', array(
					'langContentFrom' => $langContentFrom,
					'langContentTo' => $langContentTo,
					'to' => $to
		));
	}

	/**
	 * Posting translate languages parameter and handling to save it to database.
	 *
	 * @return Response
	 */
	public function postTranslation() {
		//echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
		//dd(Input::all());
		$to = Input::get('to', 'jp');
		$data = Input::except('to');
		$langPath = app_path() . '/lang/';
		$total = 0;
		$lack = 0;
		if (!is_dir($langPath . $to)) {
			mkdir($langPath . $to);
		}
		foreach ($data as $file => $langs) {
			$fileName = $file . '.php';
			$filePath = $langPath . $to . '/' . $fileName;
			file_put_contents($filePath, "<?php");
			file_put_contents($filePath, "\nreturn array(", FILE_APPEND);
			foreach ($langs as $k => $v) {
				if (!is_array($v)) {
					$total++;
					if ($v == '') {
						$lack++;
					} else {
						file_put_contents($filePath, "\n'" . $k . "'=>'" . $v . "',", FILE_APPEND);
					}
				} else {
					file_put_contents($filePath, "\n'" . $k . "'=>array(", FILE_APPEND);
					foreach ($v as $ksub => $vsub) {
						$total++;
						if ($vsub == '') {
							$lack++;
						} else {
							file_put_contents($filePath, "\n'" . $ksub . "'=>'" . $vsub . "',", FILE_APPEND);
						}
					}
					file_put_contents($filePath, "\n),", FILE_APPEND);
				}
			}
			file_put_contents($filePath, "\n);", FILE_APPEND);
		}
		$appLanguage = DB::table('app_languages')
				->where('code', $to)
				->first();
		$language = DB::table('languages')
				->where('code', $to)
				->first(array('languages'));
		if ($appLanguage === null) {
			DB::table('app_languages')
					->insert(array(
						'code' => $to,
						'language_name' => $language->languages,
						'lack' => $lack,
						'total' => $total
			));
		} else {
			DB::table('app_languages')
					->where('code', $to)
					->update(array(
						'lack' => $lack,
						'total' => $total
			));
		}
		Session::flash('success', trans('messages.translated'));
		return Redirect::route('admin.language.index');
	}

	/**
	 * Display a listing of the languages which need transalting.
	 *
	 * @return Response
	 */
	public function index() {
		$appLanguages = \Language::get();
		$languages = DB::table('languages')
				->whereNotIn('code', $appLanguages->lists('code'))
				->lists('languages', 'code');
		$this->layout->content = View::make('admin.language.index', array(
					'languages' => $languages,
					'appLanguages' => $appLanguages
		));
	}

	/**
	 * Handling action to set default language for app.
	 *
	 * @return Response
	 */
	public function setDefault($id) {
		$appLanguage = \Language::findOrFail($id);
		\Language::where('is_default', 1)
				->update(array(
					'is_default' => 0,
		));
		$appLanguage->is_default = 1;
		$appLanguage->save();
		Session::flash('success', trans('messages.language_set', array('language' => $appLanguage->language_name)));
		return Redirect::back();
	}

	/**
	 * Handling action to add language for app.
	 *
	 * @return Response
	 */
	public function add() {
		$newLang = Input::get('language');
		if (!empty($newLang)) {
			return Redirect::route('admin.language.translation', array('to' => $newLang));
		} else {
			return Redirect::back();
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
