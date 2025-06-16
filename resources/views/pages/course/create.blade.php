@extends('layout.app')

@section('content')
    <div class="">
        <h2 class="mb-4">Create New Course</h2>

        <form id="courseForm" enctype="multipart/form-data">
            @csrf
            <div class="card mb-4">
                <div class="card-header fw-bold">Course Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-control-sm">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control form-control-sm">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Intro Video URL</label>
                            <input type="url" name="video_url" class="form-control form-control-sm">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Level <span class="text-danger">*</span></label>
                            <select name="level" class="form-select">
                                <option value="">Select Level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thumbnail (Image File)</label>
                            <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modulesWrapper"></div>

            <div class="invalid-modules"></div>
            <button type="button" class="btn btn-outline-primary mb-4" id="addModuleBtn">➕ Add Module</button>
            <button type="submit" class="btn btn-success w-100">📅 Submit Course</button>
        </form>
    </div>

    <template id="moduleTemplate">
        <div class="card module-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>📦 Module</span>
                <button type="button" class="btn-close btn-sm remove-module-btn"></button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Module Title <span class="text-danger">*</span></label>
                    <input type="text" name="modules[][title]" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="contentsWrapper"></div>
                <div class="invalid-content"></div>
                <button type="button" class="btn btn-sm btn-outline-secondary addContentBtn">➕ Add Content</button>
            </div>
        </div>
    </template>

    <template id="contentTemplate">
        <div class="card content-card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>📝 Content</span>
                    <button type="button" class="btn-close btn-sm remove-content-btn"></button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Content Type <span class="text-danger">*</span></label>
                    <select name="modules[][contents][][type]" class="form-select content-type-select">
                        <option value="text">Text</option>
                        <option value="image">Image URL</option>
                        <option value="video">Video URL</option>
                        <option value="link">External Link</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-2">
                    <label class="form-label">Value <span class="text-danger">*</span></label>
                    <input type="text" name="modules[][contents][][value]" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
    </template>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const modulesWrapper = $('#modulesWrapper');
            const moduleTemplate = $('#moduleTemplate').html();
            const contentTemplate = $('#contentTemplate').html();

            function updateNames() {
                modulesWrapper.children('.module-card').each(function(moduleIndex) {
                    $(this).find('input[name$="[title]"]').attr('name', `modules[${moduleIndex}][title]`);

                    $(this).find('.content-card').each(function(contentIndex) {
                        $(this).find('select[name$="[type]"]').attr('name',
                            `modules[${moduleIndex}][contents][${contentIndex}][type]`);
                        $(this).find('input[name$="[value]"]').attr('name',
                            `modules[${moduleIndex}][contents][${contentIndex}][value]`);
                    });
                });
            }

            $('#addModuleBtn').on('click', function() {
                let module = $(moduleTemplate);
                modulesWrapper.append(module);
                updateNames();
            });

            $(document).on('click', '.remove-module-btn', function() {
                $(this).closest('.module-card').remove();
                updateNames();
            });

            $(document).on('click', '.addContentBtn', function() {
                const contentsWrapper = $(this).siblings('.contentsWrapper');
                contentsWrapper.append(contentTemplate);
                updateNames();
            });

            $(document).on('click', '.remove-content-btn', function() {
                $(this).closest('.content-card').remove();
                updateNames();
            });

            function clearValidationErrors() {
                $('.form-control, .form-select').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('.invalid-modules').removeClass('text-danger').text('');
                $('.invalid-content').removeClass('text-danger').text('');
            }

            function showValidationErrors(errors) {
                $.each(errors, function(field, messages) {
                    console.log(field, messages);

                    if (field === 'modules') {
                        $('.invalid-modules').addClass('text-danger').text(messages);
                        return;
                    }

                    if (field === 'modules.0.contents') {
                        $('.invalid-content').addClass('text-danger').text(messages);
                        return;
                    }

                    let nameAttr = field.replace(/\.(\d+)/g, '[$1]').replace(/\.(\w+)/g, '[$1]');
                    const $input = $('[name="' + nameAttr + '"]');

                    if ($input.length) {
                        $input.addClass('is-invalid');
                        let $feedback = $input.siblings('.invalid-feedback');
                        if ($feedback.length === 0) {
                            $feedback = $input.parent().find('.invalid-feedback');
                        }
                        $feedback.text(messages[0]);
                    }
                });

                const firstErrorField = Object.keys(errors)[0];

                if (firstErrorField === 'modules') {
                    $('html, body').animate({
                        scrollTop: $('.invalid-modules').offset().top - 100
                    }, 600);
                    return;
                }

                let firstErrorName = firstErrorField.replace(/\.(\d+)/g, '[$1]').replace(/\.(\w+)/g, '[$1]');
                const firstErrorInput = $('[name="' + firstErrorName + '"]');
                if (firstErrorInput.length) {
                    $('html, body').animate({
                        scrollTop: firstErrorInput.offset().top - 100
                    }, 600);
                }
            }


            $('#courseForm').on('submit', function(e) {
                e.preventDefault();

                clearValidationErrors();
                let formData = new FormData(this);

const $submitBtn = $('#courseForm button[type="submit"]');

// Clear existing content and add spinner + text
$submitBtn.prop('disabled', true)
    .html(`
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        Submitting...
    `);


                $.ajax({
                    url: "{{ route('courses.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // alert('✅ Course created successfully!');
                        $submitBtn.prop('disabled', false).html('📅 Submit Course');
                        $('#courseForm')[0].reset();
                        $('#modulesWrapper').empty();
                        window.location.href = "{{ route('course') }}";

                    },
                    error: function(xhr) {
                        $submitBtn.prop('disabled', false).html('📅 Submit Course');
                        console.log(xhr.responseJSON);

                        if (xhr.status === 422) {
                            console.log(xhr.responseJSON.errors);

                            showValidationErrors(xhr.responseJSON.errors);
                        } else {
                            alert("Something went wrong.".xhr);
                        }
                    }
                });
            });
        });
    </script>
@endsection
