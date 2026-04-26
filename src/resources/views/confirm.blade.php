    @extends('layouts.app')
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  @endsection

  @section('content')
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="/contacts" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
　　　　　　　　　　<input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
　　　　　　　　　　</td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
  　　　　　　　　<th class="confirm-table__header">性別</th>
  　　　　　　　　<td class="confirm-table__text">
    　　　　　　　　<input type="text" value="{{ ['1'=>'男性','2'=>'女性','3'=>'その他'][$contact['gender']] }}" readonly />
  　　　　　　　</td>
 　　　　　　 </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
  <th class="confirm-table__header">住所</th>
  <td class="confirm-table__text">
    <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
  </td>
</tr>

<tr class="confirm-table__row">
  <th class="confirm-table__header">建物名</th>
  <td class="confirm-table__text">
    <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
  </td>
</tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
              </td>
            </tr>
          </table>
        </div>
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
　　　　　<input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
　　　　　<input type="hidden" name="gender" value="{{ $contact['gender'] }}">
　　　　　<input type="hidden" name="email" value="{{ $contact['email'] }}">
　　　　　<input type="hidden" name="tel" value="{{ $contact['tel'] }}">
　　　　　<input type="hidden" name="address" value="{{ $contact['address'] }}">
　　　　　<input type="hidden" name="building" value="{{ $contact['building'] }}">
　　　　　<input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
　　　　　<input type="hidden" name="detail" value="{{ $contact['detail'] }}">
　　　　<div class="form__button-group">
  <button class="form__button-correction" type="submit" formaction="/contacts" formmethod="get">修正</button>
  <button class="form__button-submit" type="submit">送信</button>
</div>
</form>
</div>
@endsection