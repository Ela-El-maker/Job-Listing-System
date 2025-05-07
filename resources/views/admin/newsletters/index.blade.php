@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Newsletter Subscribers</h1>
        </div>

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
    </section>

    <div class="col-12">
        {{-- Newsletter Send Form --}}
        <div class="card mb-4">
            <div class="card-header">
                <h4>Send Newsletter</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.newsletter.send-mail') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter newsletter subject">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" rows="6" id="editor"
                            placeholder="Write your newsletter content here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Newsletter</button>
                </form>
            </div>
        </div>

        {{-- Subscribers Table --}}
        <div class="card">
            <div class="card-header">
                <h4>All Subscribers</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.newsletter.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by email"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" style="height: 42px" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Subscribed At</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subscribers as $subscriber)
                                <tr>
                                    <td>{{ ($subscribers->currentPage() - 1) * $subscribers->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $subscriber?->email }}</td>
                                    <td>{{ $subscriber?->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.newsletter.destroy', $subscriber?->id) }}" class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No subscribers found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($subscribers->hasPages())
                        {{ $subscribers->withQueryString()->links() }}
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endsection
