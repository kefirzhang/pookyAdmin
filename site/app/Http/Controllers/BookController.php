<?php
/**
 * @desc 示例流程 Controller Model view curd
 */
namespace App\Http\Controllers;

use App\Model\Chapter;
use Illuminate\Http\Request;
use App\Model\Book;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:128',
        ]);
        $book = new Book;
        $book->name         = $request->name;
        $book->category     = $request->category??'';
        $book->author       = $request->author??'';
        $book->intro        = $request->intro??'';
        $book->cover        = $request->cover??'';
        $book->tags         = $request->tags??'';
        $book->last_chapter = $request->last_chapter??'';
        $book->bs_id        = $request->bs_id??'0';
        $book->finished     = $request->finished??'0';

        if ($book->save()) {
            return redirect()->back()->withInput()->withErrors('保存成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function index()
    {
        $records = Book::paginate(env('LIST_PAGE_SIZE'));
        return view('module.book.index', ['records' => $records]);
    }

    public function create(Request $request)
    {
        return view('module.book.create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
        ]);
        $book = Book::find($id);
        $book->name         = $request->name;
        $book->category     = $request->category??'';
        $book->author       = $request->author??'';
        $book->intro        = $request->intro??'';
        $book->cover        = $request->cover??'';
        $book->tags         = $request->tags??'';
        $book->last_chapter = $request->last_chapter??'';
        $book->bs_id        = $request->bs_id??'0';
        $book->finished     = $request->finished??'0';

        if ($book->save()) {
            return redirect()->back()->withInput()->withErrors('更新成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function show($id)
    {

        $record = Book::find($id);

        return view('module.book.show',['record'=>$record]);
    }

    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }

    public function edit($id)
    {
        $record = Book::find($id);
        return view('module.book.edit', ['record' => $record]);
    }

    function reset($id)
    {
        Chapter::where('b_id',$id)->delete();

        $book = Book::find($id);
        $book->last_chapter = '';
        $book->bs_id        = '0';
        if ($book->save()) {
            return redirect()->back()->withInput()->withErrors('成功！');
        } else {
            return redirect()->back()->withInput()->withErrors('失败！');
        }
    }
}
