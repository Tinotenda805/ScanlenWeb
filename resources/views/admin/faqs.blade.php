@extends('admin.app')

@section('content')

<div class="ps-3">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Frequently Asked Questions</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i> Add New FAQ
            </button>
            

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add FAQ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('admin.storeFaq')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="col">
                                    <label for="name" class="form-label">Question</label>
                                    <input type="text" name="question" class="form-control" placeholder="Question">
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col">
                                        <label for="description" class="form-label">Answer</label>
                                        <textarea class="form-control" name="answer" placeholder="Answer goes here......." id="floatingTextarea"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($faqs->isNotEmpty())
                        @foreach ($faqs as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->question ?? ''}}</td>
                                <td>{{$item->answer ?? ''}}</td>
                                {{-- <td>{{$item->status_text  ?? ''}}</td> --}}
                                <td style="width: 100px">
                                    <button class="btn btn-sm btn-outline-warning action-btn" type="button"  data-bs-toggle="modal" data-bs-target="#updateFaq{{$item->id}}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger action-btn" type="button"  data-bs-toggle="modal" data-bs-target="#deleteSystem-{{$item->id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteSystem-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete System</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('admin.deleteFaq', $item->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            Are you sure you want to delete this FAQ!!! This can not be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>

                                    </form>
                                    </div>
                                </div>
                            </div>

                            {{-- update faq --}}
                            <div class="modal fade" id="updateFaq{{$item->id}}" tabindex="-1" aria-labelledby="updateFaqLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateFaqLabel">Update "{{$item->question ?? ''}}"</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('admin.updateFaq', $item->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="col">
                                                    <label for="name" class="form-label">Question</label>
                                                    <input type="text" name="question" class="form-control" placeholder="Question" value="{{$item->question}}">
                                                </div>
                                                <div class="row g-3 mt-1">
                                                    <div class="col">
                                                        <label for="description" class="form-label">Answer</label>
                                                        <textarea class="form-control" name="answer" placeholder="Answer goes here......." id="floatingTextarea">
                                                            {{$item->answer}}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <td colspan="12" class="text-danger">No FAQs</td>
                    @endif
                    
                </tbody>
            </table>
        </div>
        
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- {{ $Systems->links() }} --}}
            </ul>
        </nav>
    </div>
</div>

@endsection