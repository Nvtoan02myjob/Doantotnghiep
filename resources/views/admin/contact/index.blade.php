@extends('admin.partials.master')

@section('title', 'Danh sách liên hệ')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Danh Sách Liên Hệ</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Người gửi</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>
                        {{ $contact->user->name ?? 'Khách' }}
                    </td>
                    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.contact.show', $contact->id) }}" class="btn btn-info btn-sm">Xem</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
</div>
@endsection
