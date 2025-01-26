@extends('layouts.admin')

@section('title', '管理者トップページ')

@section('content')

<main class="admin-dashboard-main">
    <div class="admin-dashboard-container">
        <div class="admin-dashboard-buttons">
            <button class="admin-dashboard-button">商品管理</button>
            <button class="admin-dashboard-button">注文管理</button>
        </div>
        <div class="admin-dashboard-search">
            <label for="furigana">フリガナ</label>
            <input type="text" id="furigana" class="admin-dashboard-input" placeholder="フリガナ">
            <label for="phone">電話番号</label>
            <input type="text" id="phone" class="admin-dashboard-input" placeholder="電話番号">
            <button class="search-button">検索</button>
        </div>
    </div>
    <section class="admin-dashboard-orders">
        <h3 class="admin-dashboard-section-title">注文状況一覧</h3>
        <table class="admin-dashboard-table">
            <thead>
                <tr>
                    <th>注文日時</th>
                    <th>注文者</th>
                    <th>フリガナ</th>
                    <th>発送状況</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024/12/15 00:00</td>
                    <td>山田 太郎</td>
                    <td>ヤマダ タロウ</td>
                    <td>発送済み</td>
                    <td><button class="admin-dashboard-detail-button">詳細</button></td>
                </tr>
                <tr>
                    <td>2024/12/15 00:00</td>
                    <td>山田 次郎</td>
                    <td>ヤマダ ジロウ</td>
                    <td>未発送</td>
                    <td><button class="admin-dashboard-detail-button">詳細</button></td>
                </tr>
                <tr>
                    <td>2024/12/15 00:00</td>
                    <td>山田 三郎</td>
                    <td>ヤマダ サブロウ</td>
                    <td>発送準備中</td>
                    <td><button class="admin-dashboard-detail-button">詳細</button></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>

@endsection