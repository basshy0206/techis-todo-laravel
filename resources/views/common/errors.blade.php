@if (count($errors) > 0)
<!-- フォームのエラーリスト -->
<div class="alert alert-danger">
    <strong>エラーが起こっています。</strong>

    <br><br>

    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif