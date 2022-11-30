<div class="bg-secondary rounded h-100 p-4 position-relative">
    <h6 class="mb-4 text-center">TABLE QUESTIONS & OPTIONS</h6>
    <button type="button" id="button-filter" class="btn btn-light position-absolute"
        style="top: 18px;right: 1.5rem;">Button filter</button>
    <div class="row">
        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded pb-4">
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="btnradio" id="all" autocomplete="off"
                        {{ request()->get('filter') == '' || 'all' ? 'checked=""' : '' }}>
                    <label class="btn btn-outline-primary" for="all">All ({{ $data->total() }})</label>

                    <input type="radio" class="btn-check" name="btnradio" id="no-correct-answer" autocomplete="off"
                        {{ request()->get('filter') == 'no-correct-answer' ? 'checked=""' : '' }}>
                    <label class="btn btn-outline-primary" for="no-correct-answer">No correct answer
                        ({{ $noHasCorrect }})</label>
                    <input type="radio" class="btn-check" name="btnradio" id="no-options" autocomplete="off"
                        {{ request()->get('filter') == 'no-options' ? 'checked=""' : '' }}>
                    <label class="btn btn-outline-primary" for="no-options">No options
                        ({{ $noOptions }})</label>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded pb-4">
                <select class="form-select mb-3" name="quizid" id="quizid" onchange="quizRedirect($(this).val())"
                    aria-label="Default select example">
                    <option value="" selected="">Choose Quiz</option>
                    @if (isset($quizs)){
                        @foreach ($quizs as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                        @endforeach
                        }
                    @endif
                </select>
            </div>
        </div>

    </div>


    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 1%">#</th>
                <th style="width: 3%">Category</th>
                <th style="width: 40%">Question</th>
                <th style="width: 1%">Options</th>
                <th style="width: 40%">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                <?php $i = ($data->currentpage() - 1) * $data->perpage(); ?>
                @foreach ($data as $key => $item)
                    <?php $i++; ?>
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $item->name }}</td>
                        <td> {!! html_entity_decode($item->question) !!}</td>
                        <td>{{ count($item->options) }}</td>
                        <td>
                            <button type="button" data-id="{{ $item->id }}"
                                class="view-button btn btn-square btn-outline-info m-2">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" data-id="{{ $item->id }}"
                                class="edit-button btn btn-square btn-outline-warning m-2">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button type="button" onclick="deleteQuestion({{ $item->id }})"
                                data-id="{{ $item->id }}"
                                class="delete-button btn btn-square btn-outline-primary m-2">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button id="two" type="button" data-id="{{ $item->id }}"
                                class="options-buton btn btn-outline-light m-2">
                                <i class="fas fa-plus me-2"></i>
                                options
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="5"> No data found</th>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $data->appends($_GET)->links() }}
    </div>
</div>
