<div id="load" style="position: relative;">
@foreach($questions as $question)
    <div>
        <h4>
           {{$question->number_order}}. {{$question->question}}
           <input type="hidden"  name="id" value="{{$question->id}}">
            <input type="hidden"  name="number" value="{{$question->number_order}}">
        </h4>
        @if(!empty($question->choiches))
        <input type="radio" name="ans_{{$question->id}}" value="A" > A. {{$question->choiches["answer1"] }} </br>
        <input type="radio" name="ans_{{$question->id}}" value="B"> B. {{$question->choiches["answer2"] }} </br>
        <input type="radio" name="ans_{{$question->id}}" value="C"> C. {{$question->choiches["answer3"] }} </br>
        <input type="radio" name="ans_{{$question->id}}" value="D"> D. {{$question->choiches["answer4"] }} </br>
        <input type="hidden"  name="is_essay" value="{{$question->is_essay}}">
        @else
        	<input type="text" name="ans_{{$question->id}}"  class="form-control" placeholder="jawab disini..">	
        	<input type="hidden"  name="is_essay" value="{{$question->is_essay}}">
        @endif
    </div>
@endforeach
</div>
{{ $questions->links() }}