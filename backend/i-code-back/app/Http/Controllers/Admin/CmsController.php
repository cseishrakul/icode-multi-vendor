<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Session;

class CmsController extends Controller
{
    public function cmsPages()
    {
        Session::put('page', 'cmspages');
        $cms_pages = CmsPage::get()->toArray();
        return view('admin.pages.cms_pages', compact('cms_pages'));
    }
    public function updateCmsStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            CmsPage::where('id', $data['cms_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'cms_id' => $data['cms_id']]);
        }
    }
    public function deleteCms($id)
    {
        CmsPage::where('id', $id)->delete();
        $message = "Page has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditCmsPage(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add CMS Page";
            $cmsPage = new CmsPage;
            $message = "CMS Page Added Successfully!";
        } else {
            $title = "Edit CMS Page";
            $cmsPage = CmsPage::find($id);
            $message = "CMS Page Edited Successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
            ];

            $customMessage = [
                'title.required' => 'Title is required',
                'url.required' => 'URL is required',
                'description.required' => 'Description is required',
            ];

            $this->validate($request, $rules, $customMessage);


            // Save cms details in cms table
            $cmsPage->title = $data['title'];
            $cmsPage->url = $data['url'];
            $cmsPage->description = $data['description'];
            $cmsPage->meta_title = $data['meta_title'];
            $cmsPage->meta_description = $data['meta_description'];
            $cmsPage->meta_keywords = $data['meta_keywords'];

            $cmsPage->status = 1;
            $cmsPage->save();
            return redirect('admin/cms-pages')->with('success_message', $message);
        }
        return view('admin.pages.add_edit-cms-page', compact('cmsPage',"title"));
    }
}
