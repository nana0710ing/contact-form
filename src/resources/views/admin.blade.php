@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">
  <h2 class="admin__heading">Admin</h2>

  <form method="get" action="/admin" class="search-form">
  <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください"
         value="{{ request('keyword') }}">

  <select name="gender">
    <option value="">性別</option>
    <option value="1" {{ request('gender')=='1' ? 'selected' : '' }}>男性</option>
    <option value="2" {{ request('gender')=='2' ? 'selected' : '' }}>女性</option>
    <option value="3" {{ request('gender')=='3' ? 'selected' : '' }}>その他</option>
  </select>

  <select name="category_id">
    <option value="">お問い合わせの種類</option>
    @foreach($categories as $category)
      <option value="{{ $category->id }}"
        {{ request('category_id')==$category->id ? 'selected' : '' }}>
        {{ $category->content }}
      </option>
    @endforeach
  </select>

  <input type="date" name="date" value="{{ request('date') }}">

  <button type="submit">検索</button>
  <a href="/admin">リセット</a>
</form>

<a href="{{ url('/admin/export') . '?' . http_build_query(request()->except('page')) }}" class="export-btn">エクスポート</a>

<div class="pagination-wrap">
    <!-- 前へ -->
    @if ($contacts->currentPage() > 1)
    <a class="pagination-link" href="{{ $contacts->previousPageUrl() }}">＜</a>
    @endif
<!-- 数字 -->
  @for ($i = 1; $i <= $contacts->lastPage(); $i++)
    <a class="pagination-link {{ $contacts->currentPage() == $i ? 'active' : '' }}"href="{{ $contacts->appends(request()->query())->url($i) }}">
      {{ $i }}
    </a>
  @endfor

  <!-- 次へ -->
   @if ($contacts->hasMorePages())
   <a class="pagination-link" href="{{ $contacts->nextPageUrl() }}">＞</a>
  @endif
</div>

  <table class="admin__table">
    <tr>
      <th>お名前</th>
      <th>性別</th>
      <th>メールアドレス</th>
      <th>お問い合わせの種類</th>
      <th></th>
    </tr>

    @foreach ($contacts as $contact)
    <tr>
      <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
      <td>
        @if($contact->gender == 1) 男性
        @elseif($contact->gender == 2) 女性
        @else その他
        @endif
      </td>
      <td>{{ $contact->email }}</td>
      <td>{{ $contact->category->content ?? '' }}</td>
      
<td>
<button type="button" class="open-modal">詳細</button>    
</td>
    </tr>

    <div class="modal">
  <div class="modal__content">
    <button type="button" class="modal__close">×</button>

    <div class="modal__row">
  <span class="modal__label">お名前</span>
  <span class="modal__value">{{ $contact->last_name }} {{ $contact->first_name }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">性別</span>
  <span class="modal__value">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">メールアドレス</span>
  <span class="modal__value">{{ $contact->email }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">電話番号</span>
  <span class="modal__value">{{ $contact->tel }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">住所</span>
  <span class="modal__value">{{ $contact->address }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">建物名</span>
  <span class="modal__value">{{ $contact->building }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">お問い合わせの種類</span>
  <span class="modal__value">{{ $contact->category->content }}</span>
</div>

<div class="modal__row">
  <span class="modal__label">お問い合わせ内容</span>
  <span class="modal__value">{{ $contact->detail }}</span>
</div>
    <form method="POST" action="/delete/{{ $contact->id }}">
  @csrf
  @method('DELETE')
  <button type="submit" class="delete-button">削除</button>
</form>
  </div>
</div>
    @endforeach
  </table>
</div>

<script>
  const buttons = document.querySelectorAll('.open-modal');
  const modals = document.querySelectorAll('.modal');
  const closeButtons = document.querySelectorAll('.modal__close');

  buttons.forEach((button, index) => {
    button.addEventListener('click', () => {
      modals[index].style.display = 'block';
    });
  });

  closeButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
      modals[index].style.display = 'none';
    });
  });

  modals.forEach((modal) => {
    modal.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  });

  document.querySelectorAll('.modal__content').forEach((content) => {
    content.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  });
</script>

@endsection
