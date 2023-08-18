<div class="modal fade" id="delete_exam{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('questionDelete')}}" method="post">
            @csrf
            @method("POST")
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف سؤال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('classroom_list.warning_delete_classroom') }} <br/> {{$question->title}}</p>
                    <input type="hidden" name="id" value="{{$question->id}}">
                </div>
                <div class="modal-footer">
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('grades_list.cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('grades_list.submit_delete_grade')}}</button>
                    </div>
                </div>
            </div>
        </form>    
    </div> 
</div>