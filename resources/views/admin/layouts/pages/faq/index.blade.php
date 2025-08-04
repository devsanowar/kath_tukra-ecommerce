@extends('admin.layouts.app')
@section('title', 'FAQ')
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-select/css/bootstrap-select.css" />
@endpush
@section('admin_content')
    <div class="container-fluid">
        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-uppercase"> All FAQ
                            <span>
                                <button type="button" class="btn btn-primary right" data-bs-toggle="modal"
                                    data-bs-target="#addFaqModal">
                                    Add FAQ
                                </button>
                            </span>
                        </h4>
                    </div>


                    <div class="body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($faqs as $key => $faq)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning editFaqBtn"
                                                data-id="{{ $faq->id }}" data-question="{{ $faq->question }}"
                                                data-answer="{{ $faq->answer }}">
                                                <i class="material-icons text-white">edit</i>
                                            </a>

                                            <form class="d-inline-block" action="{{ route('faq.destroy', $faq->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-raised bg-pink waves-effect show_confirm"> <i
                                                        class="material-icons">delete</i> </button>
                                            </form>
                                        </td>

                                    <tr>
                                    @empty
                                        <table>
                                            <thead>
                                                <tr>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    FAQ Not Found! Please Add FAQ. Thank you
                                                </tr>
                                            </tbody>
                                        </table>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!--Add Category Modal -->
                    <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add FAQ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="zmdi zmdi-close"></i> </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('faq.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="faq_question" class="form-label">Question</label>
                                            <input type="text" id="faq_question" name="question" class="form-control"
                                                placeholder="Enter Faq Question">
                                        </div>

                                        <div class="mb-3">
                                            <label for="faq_answer" class="form-label">Answer</label>
                                            <input type="text" id="faq_answer" name="answer" class="form-control"
                                                placeholder="Enter Faq Answer">
                                        </div>

                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Edit FAQ Modal -->
                    <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="editFaqForm" method="POST" action="{{ route('faq.update', 0) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editFaqModalLabel">Edit FAQ</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="zmdi zmdi-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="editFaqId">

                                        <div class="mb-3">
                                            <label for="editFaqQuestion" class="form-label">Question</label>
                                            <input type="text" class="form-control" name="question" id="editFaqQuestion">
                                        </div>

                                        <div class="mb-3">
                                            <label for="editFaqAnswer" class="form-label">Answer</label>
                                            <textarea class="form-control" name="answer" id="editFaqAnswer" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">UPDATE FAQ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--End  Faq Modal -->

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/sweetalert2.all.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.editFaqBtn');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const question = this.getAttribute('data-question');
                    const answer = this.getAttribute('data-answer');

                    // Fill modal inputs
                    document.getElementById('editFaqId').value = id;
                    document.getElementById('editFaqQuestion').value = question;
                    document.getElementById('editFaqAnswer').value = answer;

                    // Set form action
                    const form = document.getElementById('editFaqForm');
                    form.action = form.action.replace(/faq\/\d+/, `faq/${id}`);

                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editFaqModal'));
                    modal.show();
                });
            });
        });
    </script>


    <script>
        $('.show_confirm').click(function(event) {
            let form = $(this).closest('form');
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });

        });
    </script>
@endpush
