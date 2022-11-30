<div class="bg-secondary rounded h-100 p-4">
    <h6 class="mb-4" data>Hoverable Table</h6>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 1%">#</th>
                <th scope="col" style="width: 60%">Option</th>
                <th scope="col" style="width:4%">Correct?</th>
                <th scope="col" style="width:35%" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody class="bodyTableOptions">
            <?php $num = 0; ?>
            @foreach ($options as $option)
                <?php $num++; ?>
                <tr>
                    <th scope="row">{{ $num }}</th>
                    <td>
                        <div class="form-floating">
                            <textarea class="form-control option-{{ $option->id }}" placeholder="Leave a comment here" id="floatingTextarea"
                                style="height: 70px" required>{{ $option->value }}</textarea>
                            <label for="floatingTextarea">Comments</label>
                        </div>
                    </td>
                    <td class="text-center"> <input class="form-check-input" type="radio" name="correct"
                            id="exampleRadios1" value="{{ $option->id }}}"
                            {{ $option->iscorrect == 1 ? 'checked' : '' }}>
                    </td>
                    <td class="text-center ">
                        <button type="button" class=" updateOption btn btn-sm btn-info m-2"
                            data-questionId={{ $option->question->id }}
                            data-optitonId="{{ $option->id }}}">UPDATE</button>
                        <button data-questionId={{ $option->question->id }} data-optitonId="{{ $option->id }}}"
                            type="button" class="btn-sm deleteQuestion btn btn-danger m-2">DELETE</button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" style="border-radius:20px;" class="btn btn-success" id="button-add-row">Add
        option</button>
    <button type="button" style="border-radius:20px;" class="btn btn-secondary float-right"
        data-dismiss="modal">Close</button>

</div>
