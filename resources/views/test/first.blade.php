@extends('layouts.admin')
@section('content')
      <form action="" id="first-test">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="input">Input</label>
                    <input class="form-control" type="number" name="input" id="input">
                </div>
                <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit"> Submit </button>
            </div>
        </div>
      </form>

      <div id="answer"></div>
      
   </div>
@endsection

@section('addafterjs')
<script>
    $(document).ready(function(){
        var $form = $('#first-test');

        $form.on('submit', handleSubmit);

        function handleSubmit(event){
            event.preventDefault();
            let input = $('#input').val();
            let space = Math.round((input+1)/2);
            
            var output = '<div class="mt-2">';
            for(let i=0; i<input; i++){
                
                output += '<div class="d-flex" style="font-size:32px">';
                for(let j=0; j<space; j++){
                    output += '&nbsp;&nbsp';
                 }
                for(let k=0; k<i+1; k++){
                    output += '<span class="mx-2">*&nbsp</span>';
                 }
                output += '</div>';
                output += '</br>';
                space --;              
            }    
            output += '</div>';

            $('#answer').empty().append(output);
        }
    })
</script>
@endsection