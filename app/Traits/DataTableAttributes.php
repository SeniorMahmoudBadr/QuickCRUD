<?php

namespace App\Traits;

use App\Models\RelatedPage;
use App\Providers\RouteServiceProvider;

trait DataTableAttributes
{
    public function actions($data, $extraBtnInSideActions = '', $extraBtnOutSideActions = '')
    {
        $currentPage = getCachedPages()->where('route', request()->segment(2))->first();
        // Handler Basics Button in Datatable ( Edit - Status - Delete )
        $statusShowBtnEdit = auth()->user()->can([$currentPage->route . '-edit', $currentPage->route . '-show']);
        $statusShowBtnDelete = auth()->user()->can($currentPage->route . '-delete');
        $statusShowBtnStatus = auth()->user()->can($currentPage->route . '-status');
        $statusShowBtnView = auth()->user()->can($currentPage->route . '-view');

        // Handler Button Pages in Action Button
        // $relatedPages = RelatedPage::where('parent_id', $currentPage->id)->with('child')->get();
        $relatedPages = $currentPage->relatedPage;
        $btnPagesArr = [];
        foreach ($relatedPages as $relatedPage) {
            if (auth()->user()->can($relatedPage->child->route . '-list'))
                $btnPagesArr[] = $relatedPage;
        }

        $additionalExtraBtnActions = '';
        $additionalExtraBtnOutSideActions = '';
        $additionalExtraBtnActions .= $statusShowBtnEdit ? btnEdit($data->id) : "";
        $additionalExtraBtnActions .= $statusShowBtnDelete ? btnDelete($data->id) : "";
        $additionalExtraBtnActions .= $statusShowBtnView ? btnView('/admin/' . $currentPage->route . '/view', $data->id) : "";
        if ($statusShowBtnStatus) {
            if ($data->active) {
                $additionalExtraBtnActions .= $statusShowBtnStatus ? btnSuspend($data->id) : "";
            } else {
                $additionalExtraBtnActions .= $statusShowBtnStatus ? btnApprove($data->id) : "";
            }
        }

        foreach ($btnPagesArr as $value) {
            if ($value->into_btn_action)
                $additionalExtraBtnActions .= additionalExtraBtnPagesInSideActions(RouteServiceProvider::ADMIN_PANEL_PREFIX . '/' . $value->child->route . '/index?row_id=' . $data->id, $value->child->{'name_' . \App::getLocale()});
            else
                $additionalExtraBtnOutSideActions .= additionalExtraBtnPagesOutSideActions(RouteServiceProvider::ADMIN_PANEL_PREFIX . '/' . $value->child->route . '/index?row_id=' . $data->id, $value->child->{'name_' . \App::getLocale()}, $value->btn_color);
        }


        $additionalExtraBtnActions .= $extraBtnInSideActions;

        $additionalExtraBtnOutSideActions .= $extraBtnOutSideActions;


        return $additionalExtraBtnOutSideActions . Dropdown(__('app.Actions'), $additionalExtraBtnActions);
    }

    public function status($data)
    {
        if ($data->active)
            return '<span class="badge badge-light-success me-2">' . __('app.Activated') . '</span>';
        else
            return '<span class="badge badge-light-danger me-2">' . __('app.Suspended') . '</span>';
    }
}
