@extends('layouts.app')

@section('content')
    <div id="app"></div>
    Приложение генератор документов поможет вам добавлять шаблоны в формате docx и готовить документы на их основе
    <table>
        <thead>
            <th>ID</th>
            <th>Название</th>
            <th>Статус</th>
            <th>Стоимость</th>
        </thead>
        <tbody>
            @foreach($deals as $deal)
                <tr>
                    <td>{{ $deal->deal_id }}</td>
                    <td>{{ $deal->name }}</td>
                    <td>{{ $deal->status }}</td>
                    <td>{{ $deal->opportunity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
