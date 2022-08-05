<?php
namespace App\Http\Controllers\Admin;

use App\Models\Incident;
use App\Models\Message;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $messagesQuery = Message::query();
        $searchKeyword = $request->get('search_keyword');
        if ($searchKeyword) {
            $messagesQuery->whereLike(['message' => $searchKeyword]);
        }

        $messages = $messagesQuery->orderBy('_id', 'desc')
            ->paginate();
        
        $data = [
            'messages' => $messages
        ];
        return view('admin.messages.index', $data);
    }
}
