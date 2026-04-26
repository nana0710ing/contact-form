<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
{
    $contact = $request->only([
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
    ]);
    session(['contact' => $contact]);

    return view('confirm', compact('contact'));
}
   public function store(Request $request)
{
    $contact = session('contact');

    Contact::create($contact);

    return redirect('thanks');
}
public function thanks()
{
    return view('thanks');
}
public function admin(Request $request)
{
    $query = Contact::query();

    // キーワード（名前・メール）
    if ($request->filled('keyword')) {
    $kw = $request->keyword;
    $kwNoSpace = str_replace([' ', '　'], '', $kw);

    $query->where(function ($q) use ($kw, $kwNoSpace) {
        $q->where('first_name', 'like', "%{$kw}%")
          ->orWhere('last_name', 'like', "%{$kw}%")
          ->orWhere('email', 'like', "%{$kw}%")
          ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$kwNoSpace}%"])
          ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$kw}%"])
          ->orWhereRaw("CONCAT(last_name, '　', first_name) LIKE ?", ["%{$kw}%"]);
    });
}

    // 性別
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // 種類
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付（created_atの“日”で一致）
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->with('category')
                      ->paginate(7)
                      ->appends($request->query()); // ページネーション時に条件維持

    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
}
public function destroy($id)
{
    Contact::findOrFail($id)->delete();
    return redirect('/admin');
}
public function export(Request $request)
{
    $query = Contact::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    $csv = "\xEF\xBB\xBF";
    $csv .= "名前,性別,メール,電話,住所\n";

    foreach ($contacts as $contact) {
        $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');

        $csv .= '"' . $contact->last_name . ' ' . $contact->first_name . '",';
        $csv .= '"' . $gender . '",';
        $csv .= '"' . $contact->email . '",';
        $csv .= '"' . $contact->tel . '",';
        $csv .= '"' . $contact->address . '"' . "\n";
    }

    return response($csv, 200, [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="contacts.csv"',
    ]);
}
}
