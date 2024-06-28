<?php

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Permission;

function reCache($array = ['pages', 'permissions']): void
{
    if (in_array('pages', $array)) {
        getCachedPages(true);
    }
    if (in_array('permissions', $array)) {
        getCachedPermissions(true);
    }
}

function getCachedPages($recache = false)
{
    if ($recache) {
        Cache::forget('Pages');
    }

    if (!Cache::has('Pages')) {
        Cache::rememberForever('Pages', function () {
            return Page::with('relatedPage.child', 'childPage')->get()->each(function ($item, int $key) {
                $item['permissions'] = Permission::where('name', 'like', $item->route . '-%')->get();
            });
        });
    }
    return Cache::get('Pages');
}

function getCachedPermissions($recache = false)
{
    if ($recache) {
        Cache::forget('permissions');
    }
    if (!Cache::has('permissions')) {
        Cache::rememberForever('permissions', function () {
            return Permission::get();
        });
    }
    return Cache::get('permissions');
}

/**
 * @param array $filesInputsNames
 * @param Request $request
 * @param string $folder
 * @return array
 */
function storeFilesAndReturnRequestData(array $filesInputsNames, Request $request, string $folder): array
{
    $data = method_exists($request, 'validated') ? $request->validated() : $request->all();
    foreach ($filesInputsNames as $inputName) {
        if ($request->hasFile($inputName)) {
            $files = $request->file($inputName);

            foreach (Arr::wrap($files) as $key => $file) {
                if (is_array($files)) {
                    $data[$inputName][$key] = storeFileAndReturnItsPath($file, $folder);
                } else {
                    $data[$inputName] = storeFileAndReturnItsPath($file, $folder);
                }
            }
        } else {
            unset($data[$inputName]);
        }
    }
    return $data;
}

/**
 * @param UploadedFile $file
 * @param $folder
 * @param $storingName
 * @return string
 */
function storeFileAndReturnItsPath(UploadedFile $file, $folder, $storingName = null): string
{
    $destinationPath = "/public/uploads/$folder/";
    $pathForDB = "/storage/uploads/$folder/";

    $savedFilename = $storingName ?? Str::random(5) . "_" . time() . "_" . $file->getClientOriginalName();

    Storage::putFileAs($destinationPath, $file, $savedFilename);
    return $pathForDB . $savedFilename;
}

function sendResponseSuccess($message, $data = [], $include_data = true)
{
    $response = [
        "success" => true,
        "message" => $message,
        "data" => $data,
    ];

    if (!$include_data) unset($response['data']);

    return response($response, 200)->header('Content-Type', 'application/json');
}

function sendResponseFailed($message, $errors = [], $code = 422)
{
    return response([
        "success" => false,
        "message" => $message,
        "errors" => $errors,
    ], $code);
}

function sendResponseError($message, $status = 422)
{
    return response([
        "success" => false,
        "message" => $message,
    ], $status)->header('Content-Type', 'application/json');
}

if (!function_exists('getLangFromHeader')) {
    function getLangFromHeader()
    {
        $lang = strtolower(request()->header('Accept-Language'));
        return !empty($lang) && in_array($lang, ['en', 'ar']) ? $lang : config('app.locale');
    }
}

if (!function_exists('deleteFiles')) {
    /**
     * @param array|string $files
     * @return void
     */
    function deleteFiles($files)
    {
        if (is_array($files)) {
            foreach ($files as $fileToDelete) {
                if (!empty($fileToDelete) && File::exists(public_path($fileToDelete))) {
                    File::delete(public_path($fileToDelete));
                }
            }
        } else {
            if (!empty($files) && File::exists(public_path($files))) {
                File::delete(public_path($files));
            }
        }
    }
}

function Dropdown($name, $link): string
{
    if ($link)
        return '<div class="dropdown">
                      <button class="btn btn-light btn-active-light-primary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ' . $name . '
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                      </button>
                      <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4">
                        ' . $link . '
                      </ul>
                </div>';
    return "";
}

function btnEdit($id): string
{
    return '<li class="menu-item px-3">
                        <a class="menu-link px-3" href="javascript:;" onclick="table__1.fill_portlet(`' . $id . '`,`#form_add__1`,`#form_reset__1`,`#modal_button__1`,custom_before,custom_after)">' . __('app.Edit') . '</a>
                    </li>';
}

function btnView($route, $id): string
{
    return '<li class="menu-item px-3">
                        <a class="menu-link px-3" href="' . $route . '/' . $id . '">' . __('app.View') . '</a>
                    </li>';
}

function btnDelete($id): string
{
    return '<li class="menu-item px-3">
                      <a class="menu-link px-3" onclick="table__1.delete_item(`' . $id . '`,`#kt_table_1`, `#delete_form__1`,`delete`)" href="javascript:;"> &nbsp;' . __('app.Delete') . '</a>
                  </li>';
}

function btnApprove($id): string
{
    return '<li class="menu-item px-3">
                      <a class="menu-link px-3" onclick="table__1.delete_item(`' . $id . '`,`#kt_table_1`, `#delete_form__1`,`approve`)" href="javascript:;">' . __('app.Approve') . '</a>
                  </li>';
}

function btnSuspend($id): string
{
    return '<li class="menu-item px-3">
                      <a class="menu-link px-3" onclick="table__1.delete_item(`' . $id . '`,`#kt_table_1`, `#delete_form__1`,`suspend`)" href="javascript:;">' . __('app.Suspend') . '</a>
                  </li>';
}

function additionalExtraBtnPagesInSideActions($route, $name): string
{
    return '<li class="menu-item px-3">
                      <a class="menu-link px-3" href="/' . $route . '">' . $name . '</a>
                  </li>';
}

function additionalExtraBtnPagesOutSideActions($route, $name, $color): string
{
    return '<a href="/' . $route . '" class="btn btn-sm btn-' . $color . ' mx-2">' . $name . '</a>';
}
