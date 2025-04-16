<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class DetailController extends Controller
{
    public function cmt_delete($id){
        try {
            $cmt = Comment::find($id);
          
            foreach($cmt->image as $image_item){
                if (Storage::disk('public')->exists($image_item)) {
                    Storage::disk('public')->delete($image_item);
                }
            }

            if($cmt->delete()){
                return redirect()->back()->with('delete_success', 'Xóa thành công bình luận');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
